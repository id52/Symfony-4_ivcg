<?php
namespace App\Controller;

use App\Entity\Map;
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

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/** @Route("/admin/map") */
class MapController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_map_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:Map')->createQueryBuilder('m')
            ->orderBy('m.city')

        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/map/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_map_create")
     * @Route("/edit-{id}/", name="admin_map_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $map = $em->getRepository('App:Map')->find($id); /** @var $map \App\Entity\Map */

            if (!$map) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $map = new Map();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($map);


        $fb->add('city', TextType::class, [
            'label'       => 'Город',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('latitude', TextType::class, [
            'label'       => 'Широта',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('longitude', TextType::class, [
            'label'       => 'Долгота',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('phone', TextType::class, [
            'label'       => 'Телефон',
            'required'    => false,
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('address', TextType::class, [
            'label'       => 'Адрес',
            'required'    => false,
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('photo_uri', TextType::class, [
            'label'       => 'Фото URI',
            'attr'        => ['class' => 'form-group form-control'],
            'required'    => false,
        ]);


        $fb->add('save', SubmitType::class, [
            'label' => 'Сохранить',
            'attr'  => ['class' => 'btn btn-success mt-4'],
        ]);

        $form = $fb->getForm();
        $form->handleRequest($request);
        if ($request->isMethod('post') and $form->isSubmitted()) {
            if ($form->isValid()) {

                $map->setCity($form->get('city')->getData());
                $map->setLatitude($form->get('latitude')->getData());
                $map->setLongitude($form->get('longitude')->getData());
                $map->setPhone($form->get('phone')->getData());
                $map->setAddress($form->get('address')->getData());
                $map->setPhotoUri($form->get('photo_uri')->getData());

                $em->persist($map);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_map_list');
            }
        }

        return $this->render('admin/map/item.html.twig', [
            'form'   => $form->createView(),
            'action' => $action,
        ]);

    }


    /**
     * @Route("/delete-{id}/", name="admin_map_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $map = $em->getRepository('App:Map')->find($id);
            if (!$map) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($map);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }


}
