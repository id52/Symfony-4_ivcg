<?php
namespace App\Controller;

use App\Entity\QuizAnswer;
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

/** @Route("/admin/quiz_answer") */
class QuizAnswerController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_quiz_answer_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:QuizAnswer')->createQueryBuilder('a')
            ->leftJoin('a.quizQuestion', 'q')
            ->leftJoin('q.quizType', 't')
            ->addSelect('q')
            ->addSelect('t')
            ->addOrderBy('q.id', 'DESC')
            ->addOrderBy('a.position', 'DESC')

        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/quiz_answer/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_quiz_answer_create")
     * @Route("/edit-{id}/", name="admin_quiz_answer_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $quiz_answer = $em->getRepository('App:QuizAnswer')->find($id); /** @var $quiz_answer \App\Entity\QuizAnswer */

            if (!$quiz_answer) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $quiz_answer = new QuizAnswer();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($quiz_answer);

        $fb->add('title', TextType::class, [
            'label'       => 'Ответ',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('position', NumberType::class, [
            'label'       => 'Сортировка',
            'required'    => false,
            'attr'        => ['class' => 'form-group form-control'],
        ]);


        $fb->add('quizQuestion', EntityType::class, [
            'label'         => 'Вопрос ',
            'attr'        => ['class' => 'form-group form-control'],
            'class'         => 'App:QuizQuestion',
            'placeholder'   => ' - Выберите вопрос - ',
        ]);

        $fb->add('save', SubmitType::class, [
            'label' => 'Сохранить',
            'attr'  => ['class' => 'btn btn-success mt-4'],
        ]);

        $form = $fb->getForm();
        $form->handleRequest($request);
        if ($request->isMethod('post') and $form->isSubmitted()) {
            if ($form->isValid()) {
                $quiz_answer->setTitle($form->get('title')->getData());
                $quiz_answer->setPosition((int)$form->get('position')->getData());

                $em->persist($quiz_answer);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_quiz_answer_list');
            }
        }

        return $this->render('admin/quiz_answer/item.html.twig', [
            'form'   => $form->createView(),
            'action' => $action,
            'quiz_answer'   => $quiz_answer,
        ]);

    }

    /**
     * @Route("/delete-{id}/", name="admin_quiz_answer_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $quiz_answer = $em->getRepository('App:QuizAnswer')->find($id);
            if (!$quiz_answer) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($quiz_answer);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }
}
