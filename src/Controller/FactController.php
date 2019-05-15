<?php
namespace App\Controller;

use App\Entity\Fact;
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

/** @Route("/admin/fact") */
class FactController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_fact_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:Fact')->createQueryBuilder('a')
            ->addOrderBy('a.position', 'DESC')
            ->addOrderBy('a.id', 'DESC')

        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/fact/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_fact_create")
     * @Route("/edit-{id}/", name="admin_fact_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $fact = $em->getRepository('App:Fact')->find($id); /** @var $fact \App\Entity\Fact */

            if (!$fact) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $fact = new Fact();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($fact);

        $fb->add('client', TextType::class, [
            'label'       => 'Клиент',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('photo_uri', UrlType::class, [
            'label'       => 'Фото URI',
            'attr'        => ['class' => 'form-group form-control'],
            'required'    => false,
        ]);

        $fb->add('vk_uri', UrlType::class, [
            'label'       => 'Вконтакте URI',
            'attr'        => ['class' => 'form-group form-control'],
            'required'    => false,
        ]);

        $fb->add('problem', TextareaType::class, [
            'label'       => 'Задачи',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('solution', TextareaType::class, [
            'label'       => 'Решение',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);





        $fb->add('number1', NumberType::class, [
            'label'       => 'Число 1',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('measure1', TextType::class, [
            'label'       => 'Измерение 1',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'measures'],
        ]);

        $fb->add('option1', TextType::class, [
            'label'       => 'Текст 1',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'options'],
        ]);





        $fb->add('number2', NumberType::class, [
            'label'       => 'Число 2',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('measure2', TextType::class, [
            'label'       => 'Измерение 2',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'measures'],
        ]);

        $fb->add('option2', TextType::class, [
            'label'       => 'Текст 2',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'options'],
        ]);





        $fb->add('number3', NumberType::class, [
            'label'       => 'Число 3',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('measure3', TextType::class, [
            'label'       => 'Измерение 3',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'measures'],
        ]);

        $fb->add('option3', TextType::class, [
            'label'       => 'Текст 3',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'options'],
        ]);






        $fb->add('number4', TextType::class, [
            'label'       => 'Число 4',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('measure4', TextType::class, [
            'label'       => 'Измерение 4',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'measures'],
        ]);

        $fb->add('option4', TextType::class, [
            'label'       => 'Текст 4',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'options'],
        ]);






        $fb->add('number5', TextType::class, [
            'label'       => 'Число 5',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('measure5', TextType::class, [
            'label'       => 'Измерение 5',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'measures'],
        ]);

        $fb->add('option5', TextType::class, [
            'label'       => 'Текст 5',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control', 'list' => 'options'],
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

                $fact->setClient($form->get('client')->getData());
                $fact->setPhotoUri($form->get('photo_uri')->getData());
                $fact->setVkUri($form->get('vk_uri')->getData());
                $fact->setProblem($form->get('problem')->getData());
                $fact->setSolution($form->get('solution')->getData());

                $fact->setNumber1($form->get('number1')->getData());
                $fact->setNumber2($form->get('number2')->getData());
                $fact->setNumber3($form->get('number3')->getData());
                $fact->setNumber4($form->get('number4')->getData());
                $fact->setNumber5($form->get('number5')->getData());

                $fact->setMeasure1($form->get('measure1')->getData());
                $fact->setMeasure2($form->get('measure2')->getData());
                $fact->setMeasure3($form->get('measure3')->getData());
                $fact->setMeasure4($form->get('measure4')->getData());
                $fact->setMeasure5($form->get('measure5')->getData());

                $fact->setOption1($form->get('option1')->getData());
                $fact->setOption2($form->get('option2')->getData());
                $fact->setOption3($form->get('option3')->getData());
                $fact->setOption4($form->get('option4')->getData());
                $fact->setOption5($form->get('option5')->getData());

                $fact->setPosition((int)$form->get('position')->getData());

                $em->persist($fact);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_fact_list');
            }
        }

        $options = $em->getRepository('App:Fact')->createQueryBuilder('f')
            ->select('f.option1')
            ->addSelect('f.option2')
            ->addSelect('f.option3')
            ->addSelect('f.option4')
            ->addSelect('f.option5')
            ->getQuery()
            ->getResult()
        ;

        $options_arr = [];

        foreach ($options as $option) {
            $options_arr[] = $option['option1'];
            $options_arr[] = $option['option2'];
            $options_arr[] = $option['option3'];
            $options_arr[] = $option['option4'];
            $options_arr[] = $option['option5'];
        }

        $options_arr = array_unique($options_arr);
        asort($options_arr);

        $measures = $em->getRepository('App:Fact')->createQueryBuilder('f')
            ->select('f.measure1')
            ->addSelect('f.measure2')
            ->addSelect('f.measure3')
            ->addSelect('f.measure4')
            ->addSelect('f.measure5')
            ->getQuery()
            ->getResult()
        ;

        $measures_arr = [];

        foreach ($measures as $measure) {
            $measures_arr[] = $measure['measure1'];
            $measures_arr[] = $measure['measure2'];
            $measures_arr[] = $measure['measure3'];
            $measures_arr[] = $measure['measure4'];
            $measures_arr[] = $measure['measure5'];
        }

        $measures_arr = array_unique($measures_arr);
        asort($measures_arr);




        return $this->render('admin/fact/item.html.twig', [
            'form'     => $form->createView(),
            'action'   => $action,
            'options'  => $options_arr,
            'measures' => $measures_arr,
        ]);

    }


    /**
     * @Route("/delete-{id}/", name="admin_fact_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $fact = $em->getRepository('App:Fact')->find($id);
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
