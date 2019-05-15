<?php
namespace App\Controller;

use App\Entity\PassportPhoto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
use Gmagick;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use App\Utils;

/** @Route("/admin/passport-photo") */
class PassportPhotoController extends Controller
{

    /**
     * @Route("/list/generate-image/", name="admin_passport_photo_generate_image")
     */
    public function generate_image()
    {
        $path_img  = getcwd() . '/img/';
        $path_file = getcwd() . '/upload/';
        $filename = "faces.png";
        $filepath = $path_file.$filename;

        $filename_m = "faces-m.png";
        $filepath_m = $path_file.$filename_m;

        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */
        $passport_photos = $em->getRepository('App:PassportPhoto')->findAll();

        $photo_paths = [];
        foreach($passport_photos as $passport_photo) { /** @var $passport_photo \App\Entity\PassportPhoto */
            $photo_paths[] = $passport_photo->getPath();
        }

        $heights = [];

        $image = new Gmagick($path_img.'1x1.png');
        $image->resizeimage(1920, 550, null, 0);
        $total_width = 0;
        $total_height = 0;

        while($total_height <= $image->getimageheight()+500) {
            $k = 0.03125 * random_int(1, 16);
            $image2 = new Gmagick($photo_paths[array_rand($photo_paths)]);
            $image3 = new Gmagick($photo_paths[array_rand($photo_paths)]);
            $image2->resizeimage($image2->getimagewidth()*$k, 0, null, 0);
            $heights[] = $image2->getimageheight();

            if (max($heights) > $image2->getimageheight() * 2) {
                $image->compositeimage($image2, gmagick::COMPOSITE_OVER, $total_width, $total_height+max($heights)-$image2->getimageheight());
                $image->compositeimage($image3->thumbnailimage($image2->getimagewidth(), $image2->getimageheight(), 1), gmagick::COMPOSITE_OVER, $total_width, $total_height);
            }
            else {
                $delta = max($heights) - $image2->getimageheight();
                $image->compositeimage($image2, gmagick::COMPOSITE_OVER, $total_width, $total_height+random_int($delta-$delta/2, $delta));
            }

            $total_width  = $total_width + $image2->getimagewidth();
            if ($total_width >= $image->getimagewidth()) {
                $total_width  = 0;
                $total_height += max($heights);
                $heights = [];
            }
        }

        $image->write($filepath);

        $image_m = new Gmagick($filepath);
        $image_m->cropimage(480, 415, 0, 0);
        $image_m->write($filepath_m);

        $response = new Response();
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename);
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', 'image/png');
        $response->setContent(file_get_contents($filepath));

        return $response;
    }


    /**
     * @Route("/list/generate-image/return/", name="admin_passport_photo_generate_image_and_return")
     */
    public function generate_image_and_return()
    {
        $this->generate_image();
        return $this->redirectToRoute('admin_passport_photo_list');
    }


    /**
     * @Route("/")
     * @Route("/list/", name="admin_passport_photo_list")
     */
    public function listAction(Request $request)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->getRepository('App:PassportPhoto')->createQueryBuilder('p')
            ->addOrderBy('p.id', 'desc')
        ;

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('admin/passport_photo/list.html.twig', [
            'pagerfanta' => $pagerfanta,
        ]);
    }

    /**
     * @Route("/create/", name="admin_passport_photo_create")
     * @Route("/edit-{id}/", name="admin_passport_photo_edit")
     */
    public function create_or_edit(Request $request)
    {
        $file = false;

        if (isset($_FILES['photo'])) {
            $file = Utils\Tool::uploadPhoto();
        }

        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $passport_photo = $em->getRepository('App:PassportPhoto')->find($id); /** @var $passport_photo \App\Entity\PassportPhoto */

            if (!$passport_photo) {
                throw $this->createNotFoundException('Not found');
            }
            $action  = 'edit';
        } else {
            $passport_photo = new PassportPhoto();
            $action  = 'add';
        }

        $fb = $this->createFormBuilder($passport_photo, ['csrf_protection' => false,]);

        $fb->add('save', SubmitType::class, [
            'label' => 'Сохранить',
            'attr'  => ['class' => 'btn btn-success mt-4'],
        ]);

        $form = $fb->getForm();
        $form->handleRequest($request);
        if ($request->isMethod('post')) {
            if ($file) {
                $passport_photo->setUri($file);
                $em->persist($passport_photo);
                $em->flush();

                $this->addFlash('success', 'Сохранено');
                return $this->redirectToRoute('admin_passport_photo_list');
            }
        }

        return $this->render('admin/passport_photo/item.html.twig', [
            'form'           => $form->createView(),
            'action'         => $action,
            'passport_photo' => $passport_photo,
        ]);
    }


    /**
     * @Route("/delete-{id}/", name="admin_passport_photo_delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */

        if ($id) {
            $passport_photo = $em->getRepository('App:PassportPhoto')->find($id);

            unlink($passport_photo->getPath());

            if (!$passport_photo) {
                throw $this->createNotFoundException('Not found');
            }

            $em->remove($passport_photo);
            $em->flush();
            $this->addFlash('success', 'Удалено');
        }
        return $this->redirect($request->headers->get('referer'));
    }


}
