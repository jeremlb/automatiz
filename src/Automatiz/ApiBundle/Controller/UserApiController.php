<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 02/11/2015
 * Time: 23:14
 */

namespace Automatiz\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Automatiz\UserBundle\Entity\User;

class UserApiController extends Controller
{
    /**

     */
    public function allAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $users = $em->getRepository('AutomatizApiBundle:User')->findAll();

        return array('users' => $users[0]);
    }
}