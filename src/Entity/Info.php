<?php

namespace App\Entity;




use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use App\Entity\Geo;
use App\Entity\Visa;

/**
 * @ORM\Table(name="info")
 * @ORM\Entity(repositoryClass="App\Repository\InfoRepository")
 */
class Info
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
     * @ORM\Column(type="string")
     */
    private $fees;

    /**
     * @ORM\Column(type="string")
     */
    private $term;

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
    public function getFees()
    {
        return $this->fees;
    }

    /**
     * @param mixed $fees
     */
    public function setFees($fees): void
    {
        $this->fees = $fees;
    }

    /**
     * @return mixed
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param mixed $term
     */
    public function setTerm($term): void
    {
        $this->term = $term;
    }

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
     * @ORM\Column(type="string")
     */
    private $price;





    /**
     * @ORM\ManyToOne(targetEntity="Visa", inversedBy="infos")
     * @ORM\JoinColumn(name="visa_id", referencedColumnName="id")
     */
    private $visa;

    /**
     * @return mixed
     */
    public function getVisa()
    {
        return $this->visa;
    }

    /**
     * @param mixed $visa
     */
    public function setVisa($visa): void
    {
        $this->visa = $visa;
    }







}