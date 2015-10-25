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
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class CocktailApiController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"default"})
     */
    public function allAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();

        $cocktails = $em->getRepository('AutomatizApiBundle:Cocktail')->findAll();

        return array('cocktails' => $cocktails);
    }

    /**
     * @Rest\View(serializerGroups={"details", "steps"})
     */
    public function getAction(Request $request, $id) {

        $em = $this->get('doctrine')->getManager();
        $cocktail = $em->getRepository('AutomatizApiBundle:Cocktail')->find($id);

        if (!$cocktail instanceof Cocktail) {
            throw new NotFoundHttpException('User not found');
        }

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
        $logger = $this->get('logger');

        $logger->info($request->getContent());

        return $this->processForm($request, new Cocktail());
    }

    private function processForm(Request $request, Cocktail $cocktail)
    {
        $logger = $this->get('logger');

        $form = $this->createForm(new CocktailType(), $cocktail);
        $form->handleRequest($request);

        $logger->info($form->getName());
        $logger->info($form->isValid());
        $logger->info($cocktail);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            $em->persist($cocktail);
            $em->flush();
            return array('cocktail' => $cocktail);
        }

        return View::create($form, 400);

    }

    /**
     * @param Request $request
     * @return array
     * @Rest\View(serializerGroups={"default"})
     */
    public function findbynameAction(Request $request)
    {
        $logger = $this->get('logger');
        $logger->info($request->query->get('name'));

        $em = $this->get('doctrine')->getManager();
        $cocktails = $em->getRepository('AutomatizApiBundle:Cocktail')->findAllByName($request->query->get('name'));

        return array('cocktails' => $cocktails);
    }
}