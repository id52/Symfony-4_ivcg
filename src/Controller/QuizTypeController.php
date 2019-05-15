<?php
namespace App\Controller;

use App\Entity\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;
use GeoIp2\Database\Reader;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Geo;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Form\Type\VichFileType;

/** @Route("/admin/quiz_type") */
class QuizTypeController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_quiz_type_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:QuizType')->createQueryBuilder('v')
            ->addOrderBy('v.id', 'DESC')

        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/quiz_type/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_quiz_type_create")
     * @Route("/edit-{id}/", name="admin_quiz_type_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $quiz_type = $em->getRepository('App:QuizType')->find($id); /** @var $quiz_type \App\Entity\QuizType */

            if (!$quiz_type) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $quiz_type = new QuizType();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($quiz_type);

        $fb->add('title', TextType::class, [
            'label'       => 'Тип',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('save', SubmitType::class, [
            'label' => 'Сохранить',
            'attr'  => ['class' => 'btn btn-success mt-4'],
        ]);

        $form = $fb->getForm();
        $form->handleRequest($request);
        if ($request->isMethod('post') and $form->isSubmitted()) {
            if ($form->isValid()) {
                $quiz_type->setTitle($form->get('title')->getData());

                $em->persist($quiz_type);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_quiz_type_list');
            }
        }

        return $this->render('admin/quiz_type/item.html.twig', [
            'form'   => $form->createView(),
            'action' => $action,
            'quiz_type'   => $quiz_type,
        ]);

    }

    /**
     * @Route("/delete-{id}/", name="admin_quiz_type_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $quiz_type = $em->getRepository('App:QuizType')->find($id);
            if (!$quiz_type) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($quiz_type);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }
}
