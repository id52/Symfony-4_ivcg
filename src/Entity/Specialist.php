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
 * @ORM\Table(name="specialist")
 * @ORM\Entity(repositoryClass="App\Repository\SpecialistRepository")
 */
class Specialist
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPhotoUri()
    {
        return $this->photo_uri;
    }

    /**
     * @param mixed $photo_uri
     */
    public function setPhotoUri($photo_uri): void
    {
        $this->photo_uri = $photo_uri;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getVideoUri()
    {
        return $this->video_uri;
    }

    /**
     * @param mixed $video_uri
     */
    public function setVideoUri($video_uri): void
    {
        $this->video_uri = $video_uri;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $photo_uri;

    /**
     * @return mixed
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @param mixed $geo
     */
    public function setGeo($geo): void
    {
        $this->geo = $geo;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $video_uri;

    /**
     * @ORM\Column(type="integer", options={"defaults"=0})
     */
    private $position;

    public function getEmbedVideo($width = 420, $height = 315)
    {
        return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"".$width."\" height=\"".$height."\" data-src=\"//www.youtube.com/embed/$1\"  allowfullscreen></iframe>",$this->getVideoUri());
    }

    /**
     * @ORM\ManyToOne(targetEntity="Geo", inversedBy="specialists")
     * @ORM\JoinColumn(name="geo_id", referencedColumnName="id")
     */
    private $geo;

//https://www.youtube.com/watch?v=Lkz03ASeUZw

//<iframe width="560" height="315" src="https://www.youtube.com/embed/Lkz03ASeUZw"  allow="autoplay; encrypted-media" allowfullscreen></iframe>



}