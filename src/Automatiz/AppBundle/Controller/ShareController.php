<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 30/11/2015
 * Time: 10:04
 */

namespace Automatiz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShareController extends Controller
{
    public function shareAction(Request $request, $id) {
        $securityContext = $this->container->get('security.authorization_checker');

        $logger = $this->get('logger');
        /*$logger->info($securityContext)*/
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $logger->info("logged");
            return $this->redirect("/#/cocktails/". $id);
        } else {
            $logger->info("not logged");
            $cocktail = $this->get("automatiz.cocktail_manager")->getCocktail($id);
            return $this->render("AutomatizAppBundle::share.html.twig", array("cocktail" => $cocktail));
        }
    }
}