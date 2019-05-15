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
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
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

    public function __construct()
    {
        $this->visas = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Visa", mappedBy="region")
     */
    private $visas;

    /**
     * @return mixed
     */
    public function getVisas()
    {
        return $this->visas;
    }

    /**
     * @param mixed $visas
     */
    public function setVisas($visas): void
    {
        $this->visas = $visas;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $intro_title;

    /**
     * @ORM\Column(type="string")
     */
    private $flag_main_title;

    /**
     * @ORM\Column(type="string")
     */
    private $flag_sub_title;

    /**
     * @ORM\Column(type="string")
     */
    private $text_main_title;

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
     * @ORM\Column(type="string")
     */
    private $text_sub_title;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="string")
     */
    private $consultation_form_direction_2;

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
    public function getFlagMainTitle()
    {
        return $this->flag_main_title;
    }

    /**
     * @param mixed $flag_main_title
     */
    public function setFlagMainTitle($flag_main_title): void
    {
        $this->flag_main_title = $flag_main_title;
    }

    /**
     * @return mixed
     */
    public function getFlagSubTitle()
    {
        return $this->flag_sub_title;
    }

    /**
     * @param mixed $flag_sub_title
     */
    public function setFlagSubTitle($flag_sub_title): void
    {
        $this->flag_sub_title = $flag_sub_title;
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
    public function getConsultationFormDirection2()
    {
        return $this->consultation_form_direction_2;
    }

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
     * @param mixed $consultation_form_direction_2
     */
    public function setConsultationFormDirection2($consultation_form_direction_2): void
    {
        $this->consultation_form_direction_2 = $consultation_form_direction_2;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $ten_advantages_main_title;

    /**
     * @ORM\Column(type="string")
     */
    private $ten_advantages_sub_title;

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
     * @ORM\Column(type="text")
     */
    private $meta_description;

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

    /**
     * @ORM\Column(type="text")
     */
    private $head_title;

    /**
     * @ORM\Column(type="text")
     */
    private $meta_description_subdomain;

    /**
     * @ORM\Column(type="text")
     */
    private $head_title_subdomain;

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
     * @ORM\Column(type="string")
     */
    private $five_steps_main_title;

    /**
     * @return mixed
     */
    public function getFiveStepsMainTitle()
    {
        return $this->five_steps_main_title;
    }

    /**
     * @param mixed $five_steps_main_title
     */
    public function setFiveStepsMainTitle($five_steps_main_title): void
    {
        $this->five_steps_main_title = $five_steps_main_title;
    }

}