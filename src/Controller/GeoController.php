<?php
namespace App\Controller;

use App\Entity\Geo;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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

/** @Route("/admin/geo") */
class GeoController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_geo_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:Geo')->createQueryBuilder('a')
        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/geo/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_geo_create")
     * @Route("/edit-{id}/", name="admin_geo_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id', false);
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $geo = $em->getRepository('App:Geo')->find($id); /** @var $fact \App\Entity\Geo */

            if (!$geo) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $geo = new Geo();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($geo);

        $fb->add('city', TextType::class, [
            'label'       => 'Город',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('region', TextType::class, [
            'label'       => 'Регион',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'regions'],
        ]);

        $fb->add('genitive_case', TextType::class, [
            'label'       => 'Родительный падеж',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('phone', TextType::class, [
            'label'       => 'Телефон',
            'attr'        => ['class' => 'form-group form-control'],
            'required'    => false,
        ]);
		
		$fb->add('email', TextType::class, [
            'label'       => 'Почта сайта',
			'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('host', TextType::class, [
            'label'       => 'Хост',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('video_uri', UrlType::class, [
            'label'       => 'Видео URI',
            'attr'        => ['class' => 'form-group form-control'],
            'required'    => false,
        ]);

        $fb->add('is_visible', CheckboxType::class, [
            'label'       => 'Отображаем?',
            'attr'        => ['class' => 'mb-4 form-group form-control'],
            'required'    => false,
        ]);

        $fb->add('geos', EntityType::class, [
            'expanded'      => true,
            'multiple'      => true,
            'label'         => 'Гео',
            'class'         => 'App:Geo',
            'placeholder'   => ' - Выберите гео - ',
            'attr'        => ['class' => 'form-group form-control'],
            'query_builder' => function (EntityRepository $er) use ($id) {
                return $er->createQueryBuilder('g')
                    ->andWhere('g.id != :id')->setParameter('id', $id);
            },

        ]);

        $fb->add('jivosite_code', TextareaType::class, [
            'label'       => 'Код живосайт',
            'required'    => false,
            'attr'        => ['class' => 'form-group form-control'],
        ]);


		$fb->add('vk_link', TextType::class, [
            'label'       => 'Ссылка на VK',
	    'required'    => false,
            'attr'        => ['class' => 'form-group form-control'],
        ]);
		
		$fb->add('fb_link', TextType::class, [
            'label'       => 'Ссылка на Facebook',
			'required'    => false,
            'attr'        => ['class' => 'form-group form-control'],
        ]);
		
		$fb->add('inst_link', TextType::class, [
            'label'       => 'Ссылка на Instagram',
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

                $geo->setCity($form->get('city')->getData());
                $geo->setRegion($form->get('region')->getData());
                $geo->setHost($form->get('host')->getData());
				$geo->setVkLink($form->get('vk_link')->getData());
				$geo->setFbLink($form->get('fb_link')->getData());
				$geo->setInstLink($form->get('inst_link')->getData());
                $geo->setVideoUri($form->get('video_uri')->getData());
                $geo->setIsVisible($form->get('is_visible')->getData());

                $geo_ids = $form->get('geos')->getData();
                $geos = $em->getRepository('App:Geo')->createQueryBuilder('g')
                    ->andWhere('g.id IN (:ids)')->setParameter('ids', $geo_ids)
                    ->getQuery()->getResult();
                $geo->setGeos($geos);

                $em->persist($geo);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_geo_list');
            }
        }

        return $this->render('admin/geo/item.html.twig', [
            'form'   => $form->createView(),
            'action' => $action,
            'geo'    => $geo,
        ]);
    }

    /**
     * @Route("/delete-{id}/", name="admin_geo_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $geo = $em->getRepository('App:Geo')->find($id);
            if (!$geo) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($geo);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }
}
