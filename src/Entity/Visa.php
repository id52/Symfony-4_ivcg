<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
Use App\Utils\Tool;


/**
 * @ORM\Table(name="visa")
 * @ORM\Entity(repositoryClass="App\Repository\VisaRepository")
 */
class Visa
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @return mixed
     */
    public function getAccusativeTitleWithPreposition()
    {
        return $this->accusative_title_with_preposition;
    }

    /**
     * @param mixed $accusative_title_with_preposition
     */
    public function setAccusativeTitleWithPreposition($accusative_title_with_preposition): void
    {
        $this->accusative_title_with_preposition = $accusative_title_with_preposition;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $accusative_title_with_preposition;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }


    public function __toString()
    {
        return $this->title;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="visas")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    private $region;

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }

    /**
     * @ORM\Column(type="text")
     */
    private $img;

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @return mixed
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * @param mixed $infos
     */
    public function setInfos($infos): void
    {
        $this->infos = $infos;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img): void
    {
        $this->img = $img;
    }

    /**
     * @ORM\OneToMany(targetEntity="Info", mappedBy="visa")
     */
    private $infos;

    public function __construct()
    {
        $this->infos = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string")
     */
    private $intro_title;

    /**
     * @ORM\Column(type="string")
     */
    private $info_main_title;

    /**
     * @ORM\Column(type="string")
     */
    private $info_sub_title;

    /**
     * @ORM\Column(type="string")
     */
    private $documents_title;

    /**
     * @ORM\Column(type="string")
     */
    private $five_circles_main_title;

    /**
     * @ORM\Column(type="string")
     */
    private $five_circles_sub_title;

    /**
     * @ORM\Column(type="string")
     */
    private $ten_advantages_main_title;

    /**
     * @ORM\Column(type="string")
     */
    private $ten_advantages_sub_title;

    /**
     * @return mixed
     */
    public function getConsultationForm2()
    {
        return $this->consultation_form_2;
    }

    /**
     * @param mixed $consultation_form_2
     */
    public function setConsultationForm2($consultation_form_2): void
    {
        $this->consultation_form_2 = $consultation_form_2;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $text_main_title;


    /**
     * @ORM\Column(type="string")
     */
    private $consultation_form_2;

    /**
     * @return mixed
     */
    public function getTenAdvantagesMainTitle()
    {
        return $this->ten_advantages_main_title;
    }

    /**
     * @param mixed $ten_advantages_main_title
     */
    public function setTenAdvantagesMainTitle($ten_advantages_main_title): void
    {
        $this->ten_advantages_main_title = $ten_advantages_main_title;
    }

    /**
     * @return mixed
     */
    public function getTenAdvantagesSubTitle()
    {
        return $this->ten_advantages_sub_title;
    }

    /**
     * @param mixed $ten_advantages_sub_title
     */
    public function setTenAdvantagesSubTitle($ten_advantages_sub_title): void
    {
        $this->ten_advantages_sub_title = $ten_advantages_sub_title;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $text_sub_title;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @return mixed
     */
    public function getIntroTitle()
    {
        return $this->intro_title;
    }

    /**
     * @param mixed $intro_title
     */
    public function setIntroTitle($intro_title): void
    {
        $this->intro_title = $intro_title;
    }

    /**
     * @return mixed
     */
    public function getInfoMainTitle()
    {
        return $this->info_main_title;
    }

    /**
     * @param mixed $info_main_title
     */
    public function setInfoMainTitle($info_main_title): void
    {
        $this->info_main_title = $info_main_title;
    }

    /**
     * @return mixed
     */
    public function getInfoSubTitle()
    {
        return $this->info_sub_title;
    }

    /**
     * @param mixed $info_sub_title
     */
    public function setInfoSubTitle($info_sub_title): void
    {
        $this->info_sub_title = $info_sub_title;
    }

    /**
     * @return mixed
     */
    public function getDocumentsTitle()
    {
        return $this->documents_title;
    }

    /**
     * @param mixed $documents_title
     */
    public function setDocumentsTitle($documents_title): void
    {
        $this->documents_title = $documents_title;
    }

    /**
     * @return mixed
     */
    public function getFiveCirclesMainTitle()
    {
        return $this->five_circles_main_title;
    }

    /**
     * @param mixed $five_circles_main_title
     */
    public function setFiveCirclesMainTitle($five_circles_main_title): void
    {
        $this->five_circles_main_title = $five_circles_main_title;
    }

    /**
     * @return mixed
     */
    public function getFiveCirclesSubTitle()
    {
        return $this->five_circles_sub_title;
    }

    /**
     * @param mixed $five_circles_sub_title
     */
    public function setFiveCirclesSubTitle($five_circles_sub_title): void
    {
        $this->five_circles_sub_title = $five_circles_sub_title;
    }

    /**
     * @return mixed
     */
    public function getTextMainTitle()
    {
        return $this->text_main_title;
    }

    /**
     * @param mixed $text_main_title
     */
    public function setTextMainTitle($text_main_title): void
    {
        $this->text_main_title = $text_main_title;
    }

    /**
     * @return mixed
     */
    public function getTextSubTitle()
    {
        return $this->text_sub_title;
    }

    /**
     * @param mixed $text_sub_title
     */
    public function setTextSubTitle($text_sub_title): void
    {
        $this->text_sub_title = $text_sub_title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @ORM\Column(type="text")
     */
    private $document_list;

    /**
     * @return mixed
     */
    public function getDocumentList()
    {
        return $this->document_list;
    }

    /**
     * @param mixed $document_list
     */
    public function setDocumentList($document_list): void
    {
        $this->document_list = $document_list;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $slug = mb_strtolower($slug);
        $slug = str_replace(')', '', $slug);
        $slug = str_replace('(', '', $slug);
        $slug = Tool::transliterate($slug);
        $slug = preg_replace('~[^-a-z0-9_]+~u', '-', $slug);
        $this->slug = $slug;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $meta_description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $head_title;

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * @param mixed $meta_description
     */
    public function setMetaDescription($meta_description): void
    {
        $this->meta_description = $meta_description;
    }

    /**
     * @return mixed
     */
    public function getHeadTitle()
    {
        return $this->head_title;
    }

    /**
     * @param mixed $head_title
     */
    public function setHeadTitle($head_title): void
    {
        $this->head_title = $head_title;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $meta_description_subdomain;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $head_title_subdomain;

    /**
     * @return mixed
     */
    public function getMetaDescriptionSubdomain()
    {
        return $this->meta_description_subdomain;
    }

    /**
     * @param mixed $meta_description_subdomain
     */
    public function setMetaDescriptionSubdomain($meta_description_subdomain): void
    {
        $this->meta_description_subdomain = $meta_description_subdomain;
    }

    /**
     * @return mixed
     */
    public function getHeadTitleSubdomain()
    {
        return $this->head_title_subdomain;
    }

    /**
     * @param mixed $head_title_subdomain
     */
    public function setHeadTitleSubdomain($head_title_subdomain): void
    {
        $this->head_title_subdomain = $head_title_subdomain;
    }



}