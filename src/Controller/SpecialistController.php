<?php
namespace App\Controller;

use App\Entity\Specialist;
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


/** @Route("/admin/specialist") */
class SpecialistController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_specialist_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:Specialist')->createQueryBuilder('a')
            ->addOrderBy('a.position', 'DESC')
            ->addOrderBy('a.id', 'DESC')

        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/specialist/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_specialist_create")
     * @Route("/edit-{id}/", name="admin_specialist_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $specialist = $em->getRepository('App:Specialist')->find($id); /** @var $fact \App\Entity\Specialist */

            if (!$specialist) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $specialist = new Specialist();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($specialist);

        $fb->add('geo', EntityType::class, [
//            'expanded'      => true,
//            'multiple'      => false,
            'label'         => 'Гео',
            'class'         => 'App:Geo',
            'placeholder'   => ' - Выберите гео - ',
            'attr'          => ['class' => 'form-group form-control'],
        ]);


        $fb->add('name', TextType::class, [
            'label'       => 'Имя',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('photo_uri', UrlType::class, [
            'label'       => 'Фото URI',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('video_uri', UrlType::class, [
            'label'       => 'Видео URI',
            'attr'        => ['class' => 'form-group form-control'],
            'required'    => false,
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

                $specialist->setGeo($form->get('geo')->getData());
                $specialist->setName($form->get('name')->getData());
                $specialist->setPhotoUri($form->get('photo_uri')->getData());
                $specialist->setVideoUri($form->get('video_uri')->getData());
                $specialist->setPosition((int)$form->get('position')->getData());

                $em->persist($specialist);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_specialist_list');
            }
        }

        return $this->render('admin/specialist/item.html.twig', [
            'specialist' => $specialist,
            'form'       => $form->createView(),
            'action'     => $action,
        ]);

    }


    /**
     * @Route("/delete-{id}/", name="admin_specialist_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $specialist = $em->getRepository('App:Specialist')->find($id);
            if (!$specialist) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($specialist);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }


}
