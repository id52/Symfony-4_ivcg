<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\Geo;


/**
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="App\Repository\GeoRepository")
 */
class Article
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
    private $text;


    public function __toString()
    {
        return $this->title;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Geo")
     * @ORM\JoinTable(name="geo_article",
     *      joinColumns={@ORM\JoinColumn(name="geo_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")}
     *      )
     */
    private $geos;

    /**
     * @return mixed
     */
    public function getGeos()
    {
        return $this->geos;
    }

    /**
     * @param mixed $geos
     */
    public function setGeos($geos): void
    {
        $this->geos = $geos;
    }

    public function addGeo(Geo $geo)
    {
        $geo->addArticle($this); // synchronously updating inverse side
        $this->geos[] = $geo;
    }

    public function __construct()
    {
      //  $this->geos = new ArrayCollection();
    }



}