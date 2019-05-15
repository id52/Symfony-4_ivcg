<?php
namespace App\Controller;

use App\Entity\Article;
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

/** @Route("/admin/article") */
class ArticleController extends Controller
{

    /**
     * @Route("/")
     * @Route("/list/", name="admin_article_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:Article')->createQueryBuilder('a');

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/article/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_article_create")
     * @Route("/edit-{id}/", name="admin_article_edit")
     */
    public function create_or_edit(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $article = $em->getRepository('App:Article')->find($id); /** @var $user \App\Entity\User */

            if (!$article) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $article = new Article();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($article);

        $fb->add('title', TextType::class, [
            'label'       => 'Заголовок',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('text', TextareaType::class, [
            'label'       => 'Текст',
            'constraints' => new Assert\NotBlank(['message' => 'Поле не должно быть пустым']),
            'attr'        => ['class' => 'form-group form-control'],
        ]);

        $fb->add('geos', EntityType::class, [
            'expanded'      => true,
            'multiple'      => true,
            'label'         => 'Гео',
            'class'         => 'App:Geo',
            'placeholder'   => ' - Выберите гео - ',

        ]);


        $fb->add('add', SubmitType::class, [
            'label' => 'Сохранить',
            'attr'  => ['class' => 'btn btn-success mt-4'],
        ]);

        $form = $fb->getForm();
        $form->handleRequest($request);
        if ($request->isMethod('post') and $form->isSubmitted()) {
            if ($form->isValid()) {
                $geo_ids = $form->get('geos')->getData();
                $geos = $em->getRepository('App:Geo')->createQueryBuilder('g')
                    ->andWhere('g.id IN (:ids)')->setParameter('ids', $geo_ids)
                    ->getQuery()->getResult();



                $article->setTitle($form->get('title')->getData());
                $article->setText($form->get('text')->getData());
                $article->setGeos($geos);



                $em->persist($article);
                $em->flush();

                $this->addFlash('success', 'Добавлено');
                return $this->redirectToRoute('admin_article_list');
            }
        }

        return $this->render('admin/article/item.html.twig', [
            'form'   => $form->createView(),
            'action' => $action,
        ]);

    }


    /**
     * @Route("/delete-{id}/", name="admin_article_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $article = $em->getRepository('App:Article')->find($id);
            if (!$article) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($article);
            $em->flush();
            $this->addFlash('success', 'Статья удалена');
        }
        return $this->redirect($request->headers->get('referer'));
    }


}
