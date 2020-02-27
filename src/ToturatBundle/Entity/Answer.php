<?php

namespace ToturatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity(repositoryClass="ToturatBundle\Repository\AnswerRepository")
 */
class Answer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="ToturatBundle\Entity\Question", inversedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;

    /**
     * @var int
     *
     * @ORM\Column(name="vote", type="integer", nullable=true, options={"default":0})
     */
    private $vote = 0;

    /**
     * @var bool
     *
     * @ORM\Column(name="valid", type="boolean", options={"default":false})
     */
    private $valid = false;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="answers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $created_at;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Answer
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set vote
     *
     * @param integer $vote
     *
     * @return Answer
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get vote
     *
     * @return int
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set valid
     *
     * @param boolean $valid
     *
     * @return Answer
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * @return \TutoratBundle*\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param \ToturatBundle\Entity\Question $question
     * @return \TutoratBundle\Entity\Answer
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \UserBundle\Entity\User $user
     * @return \TutoratBundle\Entity\Answer
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     * @return \TutoratBundle\Entity\Answer
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * Get valid
     *
     * @return bool
     */
    public function getValid()
    {
        return $this->valid;
    }
}

