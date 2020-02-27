<?php

namespace ToturatBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Paginator;
use ToturatBundle\Entity\Answer;
use ToturatBundle\Form\TagType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AdminController extends Controller
{

    /**
     * @Route("/admin/add/tag", name="add_tag")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addTagAction(Request $request, ObjectManager $em)
    {
        $add_tag_form = $this->createForm(TagType::class);
        $add_tag_form->handleRequest($request);

        if ($add_tag_form->isSubmitted() && $add_tag_form->isValid()) {

            $tag = $add_tag_form->getData();
            $em->persist($tag);
            $em->flush();

            $this->addFlash('success', 'Tag created');
            return $this->redirectToRoute('view_tags');
        }

        return $this->render('ToturatBundle::admin/add_tag.html.twig', [
            'add_tag_form' => $add_tag_form->createView(),
        ]);
    }

    /**
     * @Route("/admin/answer/{id}/valid", name="answer_valid")
     * @Security("has_role('ROLE_ADMIN')")
     * @ParamConverter("answer", class="ToturatBundle:Answer")
     */
    public function validAnswerAction(Answer $answer, ObjectManager $em)
    {

        if ($answer->getValid() == 1) {
            $answer->setValid(false);
            $em->flush();

            $this->addFlash('info', 'Answer disabled');
        } else {
            $answer->setValid(true);
            $em->flush();

            $this->addFlash('info', 'Answer enabled');
        }

        return $this->redirectToRoute('answers_listing_admin');
    }

    /**
     * @Route("/admin/answers/", name="answers_listing_admin")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function answersListingAdminAction(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request)
    {

        $dql = "SELECT a FROM ToturatBundle:Answer a ORDER BY a.content ASC";
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            10
        );


        return $this->render('ToturatBundle::admin/answers_listing_admin.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
