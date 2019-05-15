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
 * @ORM\Table(name="fact")
 * @ORM\Entity(repositoryClass="App\Repository\FactRepository")
 */
class Fact
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
    private $client;

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getProblem()
    {
        return $this->problem;
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
    public function getVkUri()
    {
        return $this->vk_uri;
    }

    /**
     * @param mixed $vk_uri
     */
    public function setVkUri($vk_uri): void
    {
        $this->vk_uri = $vk_uri;
    }

    /**
     * @param mixed $problem
     */
    public function setProblem($problem): void
    {
        $this->problem = $problem;
    }

    /**
     * @return mixed
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * @param mixed $solution
     */
    public function setSolution($solution): void
    {
        $this->solution = $solution;
    }

    /**
     * @param mixed $registration_cost
     */
    public function setRegistrationCost($registration_cost): void
    {
        $this->registration_cost = $registration_cost;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $photo_uri;

    /**
     * @ORM\Column(type="string")
     */
    private $sex;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $vk_uri;

    /**
     * @ORM\Column(type="text")
     */
    private $problem;

    /**
     * @ORM\Column(type="text")
     */
    private $solution;

    /**
     * @ORM\Column(type="integer", options={"defaults"=0})
     */
    private $position;

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param mixed $option
     */
    public function setOption($option): void
    {
        $this->option = $option;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }

    /**
     * @ORM\Column(type="float", options={"defaults"=0})
     */
    private $number1;

    /**
     * @ORM\Column(type="text", length=10)
     */
    private $measure1;

    /**
     * @ORM\Column(type="text", length=30)
     */
    private $option1;

    /**
     * @ORM\Column(type="float", options={"defaults"=0})
     */
    private $number2;

    /**
     * @return mixed
     */
    public function getNumber1()
    {
        return $this->number1;
    }

    /**
     * @param mixed $number1
     */
    public function setNumber1($number1): void
    {
        $this->number1 = $number1;
    }

    /**
     * @return mixed
     */
    public function getMeasure1()
    {
        return $this->measure1;
    }

    /**
     * @param mixed $measure1
     */
    public function setMeasure1($measure1): void
    {
        $this->measure1 = $measure1;
    }

    /**
     * @return mixed
     */
    public function getOption1()
    {
        return $this->option1;
    }

    /**
     * @param mixed $option1
     */
    public function setOption1($option1): void
    {
        $this->option1 = $option1;
    }

    /**
     * @return mixed
     */
    public function getNumber2()
    {
        return $this->number2;
    }

    /**
     * @param mixed $number2
     */
    public function setNumber2($number2): void
    {
        $this->number2 = $number2;
    }

    /**
     * @return mixed
     */
    public function getMeasure2()
    {
        return $this->measure2;
    }

    /**
     * @param mixed $measure2
     */
    public function setMeasure2($measure2): void
    {
        $this->measure2 = $measure2;
    }

    /**
     * @return mixed
     */
    public function getOption2()
    {
        return $this->option2;
    }

    /**
     * @param mixed $option2
     */
    public function setOption2($option2): void
    {
        $this->option2 = $option2;
    }

    /**
     * @return mixed
     */
    public function getNumber3()
    {
        return $this->number3;
    }

    /**
     * @param mixed $number3
     */
    public function setNumber3($number3): void
    {
        $this->number3 = $number3;
    }

    /**
     * @return mixed
     */
    public function getMeasure3()
    {
        return $this->measure3;
    }

    /**
     * @param mixed $measure3
     */
    public function setMeasure3($measure3): void
    {
        $this->measure3 = $measure3;
    }

    /**
     * @return mixed
     */
    public function getOption3()
    {
        return $this->option3;
    }

    /**
     * @param mixed $option3
     */
    public function setOption3($option3): void
    {
        $this->option3 = $option3;
    }

    /**
     * @return mixed
     */
    public function getNumber4()
    {
        return $this->number4;
    }

    /**
     * @param mixed $number4
     */
    public function setNumber4($number4): void
    {
        $this->number4 = $number4;
    }

    /**
     * @return mixed
     */
    public function getMeasure4()
    {
        return $this->measure4;
    }

    /**
     * @param mixed $measure4
     */
    public function setMeasure4($measure4): void
    {
        $this->measure4 = $measure4;
    }

    /**
     * @return mixed
     */
    public function getOption4()
    {
        return $this->option4;
    }

    /**
     * @param mixed $option4
     */
    public function setOption4($option4): void
    {
        $this->option4 = $option4;
    }

    /**
     * @return mixed
     */
    public function getNumber5()
    {
        return $this->number5;
    }

    /**
     * @param mixed $number5
     */
    public function setNumber5($number5): void
    {
        $this->number5 = $number5;
    }

    /**
     * @return mixed
     */
    public function getMeasure5()
    {
        return $this->measure5;
    }

    /**
     * @param mixed $measure5
     */
    public function setMeasure5($measure5): void
    {
        $this->measure5 = $measure5;
    }

    /**
     * @return mixed
     */
    public function getOption5()
    {
        return $this->option5;
    }

    /**
     * @param mixed $option5
     */
    public function setOption5($option5): void
    {
        $this->option5 = $option5;
    }

    /**
     * @ORM\Column(type="text", length=10)
     */
    private $measure2;

    /**
     * @ORM\Column(type="text", length=30)
     */
    private $option2;

    /**
     * @ORM\Column(type="float", options={"defaults"=0})
     */
    private $number3;

    /**
     * @ORM\Column(type="text", length=10)
     */
    private $measure3;

    /**
     * @ORM\Column(type="text", length=30)
     */
    private $option3;

    /**
     * @ORM\Column(type="float", options={"defaults"=0})
     */
    private $number4;

    /**
     * @ORM\Column(type="text", length=10)
     */
    private $measure4;

    /**
     * @ORM\Column(type="text", length=30)
     */
    private $option4;

    /**
     * @ORM\Column(type="float", options={"defaults"=0})
     */
    private $number5;

    /**
     * @ORM\Column(type="text", length=10)
     */
    private $measure5;

    /**
     * @ORM\Column(type="text", length=30)
     */
    private $option5;








}