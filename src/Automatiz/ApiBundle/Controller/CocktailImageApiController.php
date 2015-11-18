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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CocktailImageApiController extends Controller
{
    /**
     * @Rest\View(statusCode=201)
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request, $id)
    {
        $cocktail = $this->getCocktail($id);
        return $this->processForm($request, new CocktailImage(), $cocktail);
    }

    /**
     * @param Request $request
     * @param CocktailImage $cocktailImage
     * @return View|Response
     */
    private function processForm(Request $request, CocktailImage $cocktailImage, $cocktail)
    {
        $logger = $this->get("logger");

        //print_r($request->files->all());//Prints All files

        $form = $this->createForm(new CocktailImageType(), $cocktailImage);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $file = $cocktailImage->getFile();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $imageDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/cocktails_pictures';
            $file->move($imageDir, $fileName);

            $cocktailImage->setFile($fileName);
            $cocktailImage->setPath($imageDir);


            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($cocktailImage);

            $cocktail->setImage($cocktailImage);
            $em->flush();

            $response = new Response();
            $response->setStatusCode(201);
            return $response;
        }

        return View::create($form, 400);
/*        return $this->render('AutomatizApiBundle:Default:upload.html.twig', array(
            'form' => $form->createView(),
        ));*/
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