<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 06/10/15
 * Time: 14:07
 */

namespace Automatiz\ApiBundle\Controller;

use Automatiz\ApiBundle\Entity\Cocktail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CocktailApiController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"default"})
     */
    public function allAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $cocktails = $em->getRepository('AutomatizApiBundle:Cocktail')->findAll();

        return array('cocktails' => $cocktails,
                     'status' => array(
                         'code'=> 200,
                         'message' => "OK"
                     )
        );
    }

    /**
     * @Rest\View(serializerGroups={"details", "steps"})
     */
    public function getAction($id) {

        $em = $this->get('doctrine')->getManager();
        $cocktail = $em->getRepository('AutomatizApiBundle:Cocktail')->find($id);

        if (!$cocktail instanceof Cocktail) {
            throw new NotFoundHttpException('User not found');
        }

        return array('cocktail' => $cocktail,
                     'status' => array(
                         'code'=> 200,
                         'message' => "OK"
                     )
        );
    }
}