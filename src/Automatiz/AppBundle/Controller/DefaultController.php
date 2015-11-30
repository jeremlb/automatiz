<?php

namespace Automatiz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');

        $logger = $this->get('logger');
        /*$logger->info($securityContext)*/
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('AutomatizAppBundle::index.html.twig');
        }

        return $this->render('AutomatizAppBundle:Default:index.html.twig');
    }

    public function appAction(Request $request) {
        return $this->render('AutomatizAppBundle::index.html.twig');
    }
}
