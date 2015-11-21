<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 11/11/2015
 * Time: 19:59
 */

namespace Automatiz\ApiBundle\Controller;
use Automatiz\ApiBundle\Entity\CocktailImage;
use Automatiz\ApiBundle\Form\CocktailImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CocktailImageApiController extends Controller
{
    /**
     * @Rest\View(statusCode=201)
     * @param Request $request
     * @return Response
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method",
     *  views = { "default", "defaultuser" }
     * )
     */
    public function newAction(Request $request, $id)
    {
        $cocktail = $this->get("automatiz.cocktail_manager")->getCocktail($id);
        return $this->processForm($request, new CocktailImage(), $cocktail);
    }

    /**
     * @param Request $request
     * @param CocktailImage $cocktailImage
     * @return View|Response
     */
    private function processForm(Request $request, CocktailImage $cocktailImage, $cocktail)
    {
        $form = $this->createForm(new CocktailImageType(), $cocktailImage);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $file = $cocktailImage->getFile();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
            $file->move($imageDir, $fileName);

            $cocktailImage->setFile($fileName);
            $cocktailImage->setPath($imageDir);
            $cocktailImage->setUrl("/web/uploads/cocktails_pictures/".$fileName);


            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($cocktailImage);

            $cocktail->setImage($cocktailImage);
            $em->flush();

            $response = new Response();
            $response->setStatusCode(201);
            return $response;
        }

        return View::create($form, 400);
    }
}