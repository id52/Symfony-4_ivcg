<?php
namespace App\Controller;

use App\Entity\Testimonial;
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

/** @Route("/admin/testimonial") */
class TestimonialController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_testimonial_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:Testimonial')->createQueryBuilder('a')
            ->addOrderBy('a.position', 'DESC')
            ->addOrderBy('a.id', 'DESC')

        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/testimonial/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_testimonial_create")
     * @Route("/edit-{id}/", name="admin_testimonial_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) { /** @var $testimonial \App\Entity\Testimonial */
            $testimonial = $em->getRepository('App:Testimonial')->find($id);

            if (!$testimonial) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $testimonial = new Testimonial();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($testimonial);

        $fb->add('client', TextType::class, [
            'label'       => 'Клиент',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('photo_uri', UrlType::class, [
            'label'       => 'Фото URI',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('uri', UrlType::class, [
            'label'       => 'URI',
            'attr'        => ['class' => 'form-group form-control'],
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'required'    => false,
        ]);

        $fb->add('text', TextareaType::class, [
            'label'       => 'Текст',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('position', NumberType::class, [
            'label'       => 'Сортировка',
            'required'    => false,
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

                $testimonial->setClient($form->get('client')->getData());
                $testimonial->setPhotoUri($form->get('photo_uri')->getData());
                $testimonial->setUri($form->get('uri')->getData());
                $testimonial->setText($form->get('text')->getData());
                $testimonial->setPosition($form->get('position')->getData());

                $em->persist($testimonial);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_testimonial_list');
            }
        }

        return $this->render('admin/testimonial/item.html.twig', [
            'form'   => $form->createView(),
            'action' => $action,
        ]);

    }


    /**
     * @Route("/delete-{id}/", name="admin_testimonial_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $fact = $em->getRepository('App:Testimonial')->find($id);
            if (!$fact) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($fact);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }


}
