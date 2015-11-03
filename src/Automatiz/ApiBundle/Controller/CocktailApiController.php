<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 06/10/15
 * Time: 14:07
 */

namespace Automatiz\ApiBundle\Controller;

use Automatiz\ApiBundle\Entity\Cocktail;
use Automatiz\ApiBundle\Entity\Step;
use Automatiz\ApiBundle\Form\CocktailType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CocktailApiController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"default", "defaultuser"})
     */
    public function allAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();

        $logger = $this->get("logger");

        if($request->query->get('name') !== null) {
            $cocktails = $em->getRepository('AutomatizApiBundle:Cocktail')->findAllByName($request->query->get('name'));
        } else {
            $cocktails = $em->getRepository('AutomatizApiBundle:Cocktail')->findAll();
        }

        return array('cocktails' => $cocktails);
    }

    /**
     * @Rest\View(serializerGroups={"details", "steps"})
     */
    public function getAction(Request $request, $id) {

        $cocktail = $this->getCocktail($id);

        $this->get("logger")->info($cocktail->getUser());

        return array('cocktail' => $cocktail);
    }

    /**
     * @Rest\View(serializerGroups={"details", "steps"})
     * @param Request $request
     * @return array|Response
     * @internal param $
     */
    public function newAction(Request $request)
    {
        return $this->processForm($request, new Cocktail($this->getUser()));
    }

    public function editAction(Request $request, $id)
    {
        $cocktail = $this->getCocktail($id);

        return $this->processForm($request, $cocktail);
    }

    /**
     * @Rest\View(statusCode=204)
     */
    public function removeAction(Request $request, $id)
    {
        $cocktail = $this->getCocktail($id);

        $em = $this->get('doctrine')->getManager();
        $em->remove($cocktail);
        $em->flush();
    }

    /**
     * @param Request $request
     * @param Cocktail $cocktail
     * @return View|Response
     */
    private function processForm(Request $request, Cocktail $cocktail)
    {
        $form = $this->createForm(new CocktailType(), $cocktail, array('method' => $request->getMethod()));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($cocktail);
            $em->flush();

            $statusCode = ($cocktail->isNew())? 201: 204;
            $response = new Response();
            $response->setStatusCode($statusCode);

            if ($cocktail->isNew()) {
                $response->headers->set(
                    'Location',
                    $this->generateUrl('cocktail_get', array('id' => $cocktail->getId()), true));
            }

            return $response;
        }

        return View::create($form, 400);
    }

    private function getCocktail($id)
    {
        $em = $this->get('doctrine')->getManager();
        $cocktail = $em->getRepository('AutomatizApiBundle:Cocktail')->find($id);

        if (!$cocktail instanceof Cocktail) {
            throw new NotFoundHttpException('Cocktail not found');
        }

        return $cocktail;
    }
}