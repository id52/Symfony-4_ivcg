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
 * @ORM\Table(name="quiz_question")
 * @ORM\Entity(repositoryClass="App\Repository\QuizQuestionRepository")
 */
class QuizQuestion
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

    /**
     * @return mixed
     */
    public function getQuizAnswers()
    {
        return $this->quizAnswers;
    }

    /**
     * @param mixed $quizAnswers
     */
    public function setQuizAnswers($quizAnswers): void
    {
        $this->quizAnswers = $quizAnswers;
    }

    /**
     * @return mixed
     */
    public function getQuizType()
    {
        return $this->quizType;
    }

    /**
     * @param mixed $quizType
     */
    public function setQuizType($quizType): void
    {
        $this->quizType = $quizType;
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
     * @ORM\Column(type="integer", options={"defaults"=0})
     */
    private $position;


    /**
     * @ORM\OneToMany(targetEntity="QuizAnswer", mappedBy="quizQuestion")
     */
    public $quizAnswers;

    public function __construct()
    {
        $this->quizAnswers = new ArrayCollection();
    }

    /**
     * @ORM\ManyToOne(targetEntity="QuizType", inversedBy="quizQuestions", cascade={"persist"})
     * @ORM\JoinColumn(name="quiz_type_id", referencedColumnName="id", onDelete="set null")
     */
    public $quizType;

    /**
     * @return mixed
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * @param mixed $placeholder
     */
    public function setPlaceholder($placeholder): void
    {
        $this->placeholder = $placeholder;
    }


    /**
     * @ORM\Column(type="string")
     */
    private $emailTitle;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $placeholder;

    /**
     * @return mixed
     */
    public function getEmailTitle()
    {
        return $this->emailTitle;
    }

    /**
     * @param mixed $emailTitle
     */
    public function setEmailTitle($emailTitle): void
    {
        $this->emailTitle = $emailTitle;
    }

}