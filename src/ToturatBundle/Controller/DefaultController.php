<?php

namespace ToturatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ToturatBundle:Default:index.html.twig');
    }
}
