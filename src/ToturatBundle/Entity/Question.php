<?php

namespace ToturatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="ToturatBundle\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\Column(name="title", type="text", length=255)
     *  @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     *  @Assert\NotBlank()
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="ToturatBundle\Entity\Answer", mappedBy="question", cascade={"remove"})
     */
    private $answers;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="questions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $created_at;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }



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
     * Set title
     *
     * @param string $title
     *
     * @return Question
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Question
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
     * Add answer
     *
     * @param \ToturatBundle\Entity\Answer $answer
     *
     * @return \ToturatBundle\Entity\Question
     */
    public function addAnswer(\ToturatBundle\Entity\Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \ToturatBundle\Entity\Answer $answer
     */
    public function removeAnswer(\ToturatBundle\Entity\Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }
    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return \ToturatBundle\Entity\Question
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return \ToturatBundle\Entity\Question
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setTags( $tags)
    {
        foreach ($tags as $tag) {
            $this->add($tag);
        }
        return $this;
    }



}

