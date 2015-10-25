<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 23/10/2015
 * Time: 11:50
 */

namespace Automatiz\ApiBundle\Controller;

use Automatiz\ApiBundle\Entity\Cocktail;
use FOS\RestBundle\Controller\FOSRestController as Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Automatiz\ApiBundle\Form\StepType;
use Symfony\Component\HttpFoundation\Request;


class StepApiController extends Controller
{
    /**
     * @param $cocktailId
     * @return array
     * @Rest\View(serializerGroups={"steps"})
     */
    public function allAction($cocktailId)
    {
        $em = $this->get('doctrine')->getManager();
        $cocktail = $em->getRepository('AutomatizApiBundle:Cocktail')->find($cocktailId);

        return array(
            "steps" => $cocktail->getSteps(),
            'status' => array(
                'code'=> 200,
                'message' => "OK"
            )
        );
    }

    /**
     * @param Request $request
     * @param $cocktailId
     * @return array
     * @Rest\View(serializerGroups={"details", "steps"})
     */
    public function postAction(Request $request, $cocktailId)
    {
        $em = $this->get('doctrine')->getManager();
        $cocktail = $em->getRepository('AutomatizApiBundle:Cocktail')->find($cocktailId);


        return array(
            "steps" => "coucou"
        );
    }


}