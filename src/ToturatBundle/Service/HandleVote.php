<?php
namespace ToturatBundle\Service;

use ToturatBundle\Entity\Answer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HandleVote 
{

    private $em;

    public function __construct(ObjectManager $em, UrlGeneratorInterface $router)
    {
        $this->em = $em;
    }

    public function handle(Answer $answer, $vote) {
        $current_vote = $answer->getVote();
        $new_vote = $vote == "▲" ? ++$current_vote : --$current_vote ;
        $answer->setVote($new_vote);
        
        $this->em->persist($answer);
        $this->em->flush();
    }

}