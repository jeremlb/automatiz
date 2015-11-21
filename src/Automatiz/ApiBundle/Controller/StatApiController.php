<?php

namespace Automatiz\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Automatiz\ApiBundle\Entity\Stat;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StatApiController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"details"})
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $content = $request->getContent();

        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array

            $user = $this->getUser();
            $cocktail = $this->get("automatiz.cocktail_manager")->getCocktail($params["cocktail"]);

            $stat = new Stat($user, $cocktail);

            $em = $this->get("doctrine")->getManager();
            $em->persist($stat);
            $em->flush();
        }

        $response = new Response();
        $response->setStatusCode(201);
        return $response;
    }
}