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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CocktailApiController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"cocktail_info"})
     * @param Request $request
     * @return array|Response
     * @internal param $
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Retrieve all cocktails",
     *  filters={
     *      {"name"="name", "dataType"="string"}
     *  }
     * )
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
     * @Rest\View()
     * @param Request $request
     * @return array|Response
     * @internal param $
     * @ApiDoc(
     *  resource=true,
     *  statusCodes={
     *      201="cocktail created",
     *      400="somethings was wrong"
     *  },
     *  parameters={
     *      {"name"="name", "dataType"="dtring", "required"=true, "description"="category id"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="category id"},
     *      {"name"="steps", "dataType"="array<Step>", "required"=true, "description"="category id"},
     *      {"name"="Step.description", "dataType"="string", "required"=true, "description"="category id"},
     *      {"name"="Step.liquid", "dataType"="string", "required"=true, "description"="category id"},
     *      {"name"="Step.addIce", "dataType"="boolean", "required"=true, "description"="category id"},
     *  },
     *  description="Create a new cocktail",
     * )
     */
    public function newAction(Request $request)
    {
        return $this->processForm($request, new Cocktail($this->getUser()));
    }

    /**
     *  @Rest\View(serializerGroups={"cocktail_detail"})
     * @param Request $request
     * @param string $id
     * @return array
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Retrieve a cocktail",
     * )
     */
    public function getAction(Request $request, $id)
    {
        $cocktail = $this->get("automatiz.cocktail_manager")->getCocktail($id);
        return array('cocktail' => $cocktail);
    }

    /**
     * @Rest\View(statusCode=204)
     * @param Request $request
     * @param string $id
     * @return Response
     * @internal param $
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Update a cocktail",
     * )
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
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Delete a cocktail",
     * )
     */
    public function removeAction(Request $request, $id)
    {
        $cocktail = $this->get("automatiz.cocktail_manager")->getCocktail($id);
        $em = $this->get('doctrine')->getManager();
        $em->remove($cocktail);
        $em->flush();
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Add a note to a cocktail",
     * )
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

    /**
     * @Rest\View(serializerGroups={"cocktail_detail"})
     * @param Request $request
     * @param $id
     * @return array
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Retrieve the cocktail note",
     * )
     */
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