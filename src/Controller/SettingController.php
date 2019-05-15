<?php
namespace App\Controller;

use App\Entity\Setting;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

/** @Route("/admin/setting") */
class SettingController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_setting_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:Setting')->createQueryBuilder('a');

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/setting/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_setting_create")
     * @Route("/edit-{id}/", name="admin_setting_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $setting = $em->getRepository('App:Setting')->find($id); /** @var $user \App\Entity\User */

            if (!$setting) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $setting = new Setting();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($setting);

        $fb->add('title', TextType::class, [
            'label'       => 'Заголовок',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('name', TextType::class, [
            'label'       => 'Имя',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);


        $fb->add('value', TextType::class, [
            'label'       => 'Значение',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('add', SubmitType::class, [
            'label' => 'Сохранить',
            'attr'  => ['class' => 'btn btn-success mt-4'],
        ]);

        $form = $fb->getForm();
        $form->handleRequest($request);
        if ($request->isMethod('post') and $form->isSubmitted()) {
            if ($form->isValid()) {

                $setting->setTitle($form->get('title')->getData());
                $setting->setName($form->get('name')->getData());
                $setting->setValue($form->get('value')->getData());

                $em->persist($setting);
                $em->flush();

                $this->addFlash('success', 'Добавлено');
                return $this->redirectToRoute('admin_setting_list');
            }
        }

        return $this->render('admin/setting/item.html.twig', [
            'form'   => $form->createView(),
            'action' => $action,
        ]);

    }


    /**
     * @Route("/delete-{id}/", name="admin_setting_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $setting = $em->getRepository('App:Setting')->find($id);
            if (!$setting) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($setting);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }


}
