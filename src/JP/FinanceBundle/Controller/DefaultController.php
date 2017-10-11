<?php

namespace JP\FinanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JPFinanceBundle:Default:index.html.twig');
    }
}
