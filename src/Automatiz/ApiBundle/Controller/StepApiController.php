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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;


class StepApiController extends Controller
{
    /**
     * @param $cocktailId
     * @return array
     * @Rest\View(serializerGroups={"steps"})
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method",
     *  views = { "default", "defaultuser" }
     * )
     */
    public function allAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $cocktail = $em->getRepository('AutomatizApiBundle:Cocktail')->find($id);

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
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method",
     *  views = {"defaultuser" }
     * )
     */
    public function postAction(Request $request, $id)
    {
        $em = $this->get('doctrine')->getManager();
        $cocktail = $em->getRepository('AutomatizApiBundle:Cocktail')->find($id);

        return array(
            "steps" => "coucou"
        );
    }


}