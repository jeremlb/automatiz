<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 26/12/2015
 * Time: 09:05
 */

namespace Automatiz\ApiBundle\Controller;

use Automatiz\ApiBundle\Entity\Liquid;
use Automatiz\ApiBundle\Form\LiquidType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;


class LiquidApiController extends Controller
{
    public function allAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $liquids = $em->getRepository('AutomatizApiBundle:Cocktail')->findAll();
        return array('liquids' => $liquids);
    }

    public function newAction(Request $request)
    {
        return $this->processForm($request, new Liquid());
    }

    /**
     * @param Request $request
     * @param Liquid $liquid
     * @return View|Response
     */
    private function processForm(Request $request, Liquid $liquid)
    {
        $form = $this->createForm(new LiquidType(), $liquid, array('method' => $request->getMethod()));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($liquid);
            $em->flush();

            $response = new Response();
            $response->setStatusCode(201);

            return $response;
        }

        return View::create($form, 400);
    }
}