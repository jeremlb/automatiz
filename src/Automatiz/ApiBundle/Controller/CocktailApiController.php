<?php
namespace Automatiz\ApiBundle\Controller;

use Automatiz\ApiBundle\Entity\Cocktail;
use Automatiz\ApiBundle\Entity\Note;
use Automatiz\ApiBundle\Form\CocktailType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CocktailApiController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"default", "defaultuser"})
     * @param Request $request
     * @return array|Response
     * @internal param $
     */
    public function allAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        if($request->query->get('name') !== null) {
            $cocktails = $em->getRepository('AutomatizApiBundle:Cocktail')->findAllByName($request->query->get('name'));
        } else {
            $cocktails = $em->getRepository('AutomatizApiBundle:Cocktail')->findAll();
        }

        return array('cocktails' => $cocktails);
    }

    /**
     * @Rest\View(serializerGroups={"details", "steps", "cocktails"})
     * @param Request $request
     * @param string $id
     * @return array
     */
    public function getAction(Request $request, $id)
    {
        $cocktail = $this->get("automatiz.cocktail_manager")->getCocktail($id);
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

    /**
     * @Rest\View(statusCode=204)
     * @param Request $request
     * @param string $id
     * @return Response
     * @internal param $
     */
    public function editAction(Request $request, $id)
    {
        $cocktail = $this->get("automatiz.cocktail_manager")->getCocktail($id);
        return $this->processForm($request, $cocktail);
    }

    /**
     * @Rest\View(statusCode=204)
     * @param Request $request
     * @param string $id
     * @internal param $
     */
    public function removeAction(Request $request, $id)
    {
        $cocktail = $this->get("automatiz.cocktail_manager")->getCocktail($id);
        $em = $this->get('doctrine')->getManager();
        $em->remove($cocktail);
        $em->flush();
    }

    /**
     * @Rest\View(serializerGroups={"details"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function newNoteAction(Request $request, $id)
    {
        $content = $request->getContent();

        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
            $noteParam = $params["note"];

            $user = $this->getUser();
            $cocktail = $this->get("automatiz.cocktail_manager")->getCocktail($id);

            $note = new Note($user, $cocktail, $noteParam);
            $cocktail->addNote($note);

            $em = $this->get("doctrine")->getManager();
            $em->persist($cocktail);
            $em->flush();
        }

        $response = new Response();
        $response->setStatusCode(201);
        return $response;
    }

    public function getNoteAction(Request $request, $id)
    {
        $cocktail = $this->get("automatiz.cocktail_manager")->getCocktail($id);

        return array("notes" => $cocktail->getNotes());
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
}