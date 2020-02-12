<?php

namespace PiBundle\Controller;

use AppBundle\Service\UtilsService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('base.html.twig');
        $utilsService->sendMail('bonjour','nouha.noreply@gmail.com','Bienvenu dans notre page');
    }
    public function helloMailAction(UtilsService $utilsService ){


    }
}
