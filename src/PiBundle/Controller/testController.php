<?php

namespace PiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class testController extends Controller
{
    public function funAction()
    {
        return $this->render('@Pi/test/fun.html.twig', array(
            // ...
        ));
    }
    public function forumAction()
    {
        return $this->render('@Pi/test/form_index.html.twig', array(
            // ...
        ));
    }


}
