<?php

namespace Automatiz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AutomatizAppBundle:Default:index.html.twig');
    }

    public function appAction()
    {
        return $this->render('AutomatizAppBundle::index.html.twig');
    }

    public function adminAction()
    {
        return new Response("load the admin app");
    }
}
