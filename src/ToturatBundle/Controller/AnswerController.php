<?php

namespace ToturatBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use ToturatBundle\Entity\Answer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ToturatBundle\Service\HandleVote;
use ToturatBundle\Service\VoteChecker;

class
AnswerController extends Controller
{
    /**
     * @Route("/answer/{id}/edit", name="edit_answer")
     * @Method({"GET", "POST"})
     * @security("is_granted('edit', answer)")
     * @ParamConverter("answer", class="ToturatBundle:Answer")
     */
    public function editAnswerAction(Request $request, Answer $answer, ObjectManager $em)
    {
        $edit_answer_form = $this->createForm('ToturatBundle\Form\AnswerType', $answer);
        $edit_answer_form->handleRequest($request);

        if ($edit_answer_form->isSubmitted() && $edit_answer_form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Answer edited');
            return $this->redirectToRoute('view_question', array('id' => $answer->getQuestion()->getId()));
        }

        return $this->render('ToturatBundle::answer/edit_answer.html.twig', [
            'answer'            => $answer,
            'edit_answer_form'  => $edit_answer_form->createView(),
        ]);
    }

    /**
     * @Route("/answer/{id}/delete", name="delete_answer")
     * @Security("is_granted('delete', answer)")
     * @ParamConverter("answer", class="ToturatBundle:Answer")
     */
    public function deleteAnswerAction(ObjectManager $em, $id, Answer $answer)
    {
        $rep = $this->getDoctrine()->getRepository('ToturatBundle:Answer');
        $answer = $rep->find($id);

        $question_id = $answer->getQuestion()->getId();

        $em->remove($answer);
        $em->flush();

        $this->addFlash('success', 'Answer deleted');

        return $this->redirectToRoute('view_question', [
            'id' => $question_id,
        ]);
    }

    /**
     * @Route("/answer/{id}/vote/{vote}", name="answer_vote", requirements={"vote": "▲|▼"})
     * @Security("has_role('ROLE_USER')")
     * @ParamConverter("answer", class="ToturatBundle:Answer")
     */
    public function voteAction(Answer $answer, $vote, HandleVote $voteHandler, VoteChecker $checker)
    {
        if ($checker->check($answer, $this->getUser())) {
            $voteHandler->handle($answer, $vote);
        } else {
            $this->addFlash(
                'error',
                'You can\'t vote for your own answer'
            );
        }

        return $this->redirectToRoute('view_question', [
            'id' => $answer->getQuestion()->getId(),
        ]);
    }


}
