<?php
namespace App\Controller;

use App\Entity\QuizQuestion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;
use GeoIp2\Database\Reader;
use Symfony\Bridge\Doctrine\Form\Question\EntityQuestion;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Geo;
use Doctrine\ORM\EntityRepository;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Vich\UploaderBundle\Form\Question\VichFileType;

/** @Route("/admin/quiz_question") */
class QuizQuestionController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_quiz_question_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:QuizQuestion')->createQueryBuilder('q')
            ->leftJoin('q.quizType', 't')
            ->addSelect('t')
            ->addOrderBy('q.position', 'DESC')
            ->addOrderBy('q.id', 'DESC')
        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/quiz_question/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_quiz_question_create")
     * @Route("/edit-{id}/", name="admin_quiz_question_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $quiz_question = $em->getRepository('App:QuizQuestion')->find($id); /** @var $quiz_question \App\Entity\QuizQuestion */

            if (!$quiz_question) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $quiz_question = new QuizQuestion();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($quiz_question);

        $fb->add('title', TextType::class, [
            'label'       => 'Вопрос',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('emailTitle', TextType::class, [
            'label'       => 'Поле в письме',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('placeholder', TextType::class, [
            'label'       => 'Placeholder',
            'required'    => false,
            'attr'        => ['class' => 'form-group form-control'],
        ]);


        $fb->add('position', NumberType::class, [
            'label'       => 'Сортировка',
            'required'    => false,
            'attr'        => ['class' => 'form-group form-control'],
        ]);


        $fb->add('quizType', EntityType::class, [
            'label'         => 'Тип ',
            'attr'        => ['class' => 'form-group form-control'],
            'class'         => 'App:QuizType',
            'placeholder'   => ' - Выберите тип - ',
        ]);

        $fb->add('save', SubmitType::class, [
            'label' => 'Сохранить',
            'attr'  => ['class' => 'btn btn-success mt-4'],
        ]);

        $form = $fb->getForm();
        $form->handleRequest($request);
        if ($request->isMethod('post') and $form->isSubmitted()) {
            if ($form->isValid()) {
                $quiz_question->setTitle($form->get('title')->getData());
                $quiz_question->setQuizType($form->get('quizType')->getData());
                $quiz_question->setPosition((int)$form->get('position')->getData());
                $quiz_question->setPlaceholder($form->get('placeholder')->getData());

                $em->persist($quiz_question);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_quiz_question_list');
            }
        }

        return $this->render('admin/quiz_question/item.html.twig', [
            'form'   => $form->createView(),
            'action' => $action,
            'quiz_question'   => $quiz_question,
        ]);

    }

    /**
     * @Route("/delete-{id}/", name="admin_quiz_question_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $quiz_question = $em->getRepository('App:QuizQuestion')->find($id);
            if (!$quiz_question) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($quiz_question);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }
}
