<?php
namespace App\Controller;

use App\Entity\Visa;
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

/** @Route("/admin/visa") */
class VisaController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_visa_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:Visa')->createQueryBuilder('v')
            ->addOrderBy('v.id', 'DESC')

        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/visa/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_visa_create")
     * @Route("/edit-{id}/", name="admin_visa_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $visa = $em->getRepository('App:Visa')->find($id); /** @var $visa \App\Entity\Visa */

            if (!$visa) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $visa = new Visa();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($visa);

        $fb->add('title', TextType::class, [
            'label'       => 'Страна',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('img', TextType::class, [
            'label'       => 'Флаг',
            'required'    => false,
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('price', NumberType::class, [
            'label'       => 'Цена',
            'required'    => false,
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('intro_title', TextType::class, [
            'label'       => 'Заголовок (синий фон)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('info_main_title', TextType::class, [
            'label'       => 'Заголовок (слайдер)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('info_sub_title', TextType::class, [
            'label'       => 'Подзаголовок (слайдер)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('documents_title', TextType::class, [
            'label'       => 'Заголовок (документы)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('five_circles_main_title', TextType::class, [
            'label'       => 'Заголовок (5 кругов)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('five_circles_sub_title', TextType::class, [
            'label'       => 'Подзаголовок (5 кругов)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('ten_advantages_main_title', TextType::class, [
            'label'       => 'Заголовок (Виза - 10 преимуществ)',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('ten_advantages_sub_title', TextType::class, [
            'label'       => 'Подзаголовок (Виза - 10 преимуществ)',
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

        $fb->add('consultation_form_2', TextType::class, [
            'label'       => 'Форма 2',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('text', TextareaType::class, [
            'label'       => 'Текст [ {{ geo_preposition_case_with_preposition }} - тег филиала (" в Барнауле") ]',
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

                $visa->setTitle($form->get('title')->getData());
                $visa->setImg($form->get('img')->getData());
                $visa->setPrice($form->get('price')->getData());
                $visa->setIntroTitle($form->get('intro_title')->getData());
                $visa->setInfoMainTitle($form->get('info_main_title')->getData());
                $visa->setInfoSubTitle($form->get('info_sub_title')->getData());

                $visa->setDocumentsTitle($form->get('documents_title')->getData());
                $visa->setFiveCirclesMainTitle($form->get('five_circles_main_title')->getData());
                $visa->setFiveCirclesSubTitle($form->get('five_circles_sub_title')->getData());
                $visa->setTenAdvantagesMainTitle($form->get('ten_advantages_main_title')->getData());
                $visa->setTenAdvantagesSubTitle($form->get('ten_advantages_sub_title')->getData());

                $visa->setTextMainTitle($form->get('text_main_title')->getData());
                $visa->setTextSubTitle($form->get('text_sub_title')->getData());
                $visa->setConsultationForm2($form->get('consultation_form_2')->getData());

                $em->persist($visa);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_visa_list');
            }
        }


        return $this->render('admin/visa/item.html.twig', [
            'form'   => $form->createView(),
            'action' => $action,
            'visa'   => $visa,
        ]);

    }


    /**
     * @Route("/delete-{id}/", name="admin_visa_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $visa = $em->getRepository('App:Visa')->find($id);
            if (!$visa) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($visa);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }


}
