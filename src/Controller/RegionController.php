<?php
namespace App\Controller;

use App\Entity\Region;
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

/** @Route("/admin/region") */
class RegionController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_region_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:Region')->createQueryBuilder('v')
            ->addOrderBy('v.id', 'DESC')

        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/region/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_region_create")
     * @Route("/edit-{id}/", name="admin_region_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $region = $em->getRepository('App:Region')->find($id); /** @var $region \App\Entity\Region */

            if (!$region) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $region = new Region();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($region);

        $fb->add('title', TextType::class, [
            'label'       => 'Страна',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('intro_title', TextType::class, [
            'label'       => 'Заголовок (синий фон)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('flag_main_title', TextType::class, [
            'label'       => 'Заголовок (флаги)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('flag_sub_title', TextType::class, [
            'label'       => 'Подзаголовок (флаги)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('ten_advantages_main_title', TextType::class, [
            'label'       => 'Заголовок (10 преимуществ)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('ten_advantages_sub_title', TextType::class, [
            'label'       => 'Подзаголовок (10 преиимуществ)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('text_main_title', TextType::class, [
            'label'       => 'Заголовок (текст)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('text_sub_title', TextType::class, [
            'label'       => 'Подзаголовок (текст)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('text', TextareaType::class, [
            'label'       => 'Текст',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('consultation_form_direction_2', TextareaType::class, [
            'label'       => 'Текст',
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
                $region->setTitle($form->get('title')->getData());
                $region->setIntroTitle($form->get('intro_title')->getData());

                $region->setFlagMainTitle($form->get('flag_main_title')->getData());
                $region->setFlagSubTitle($form->get('flag_sub_title')->getData());

                $region->setTenAdvantagesMainTitle($form->get('ten_advantages_main_title')->getData());
                $region->setTenAdvantagesSubTitle($form->get('ten_advantages_sub_title')->getData());

                $region->setTextMainTitle($form->get('text_main_title')->getData());
                $region->setTextSubTitle($form->get('text_sub_title')->getData());
                $region->setText($form->get('text')->getData());

                $region->setConsultationFormDirection2($form->get('consultation_form_direction_2')->getData());

                $em->persist($region);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_region_list');
            }
        }

        return $this->render('admin/region/item.html.twig', [
            'form'   => $form->createView(),
            'action' => $action,
            'region'   => $region,
        ]);

    }

    /**
     * @Route("/delete-{id}/", name="admin_region_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $region = $em->getRepository('App:Region')->find($id);
            if (!$region) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($region);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }


}
