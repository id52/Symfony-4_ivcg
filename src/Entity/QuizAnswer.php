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
 * @ORM\Table(name="quiz_answer")
 * @ORM\Entity(repositoryClass="App\Repository\QuizAnswerRepository")
 */
class QuizAnswer
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
    public function getQuizQuestion()
    {
        return $this->quizQuestion;
    }

    /**
     * @param mixed $quizQuestion
     */
    public function setQuizQuestion($quizQuestion): void
    {
        $this->quizQuestion = $quizQuestion;
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
     * @ORM\Column(type="integer", options={"defaults"=0})
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="QuizQuestion", inversedBy="quizAnswers", cascade={"persist"})
     * @ORM\JoinColumn(name="quiz_question_id", referencedColumnName="id", onDelete="set null")
     */
    public $quizQuestion;
}