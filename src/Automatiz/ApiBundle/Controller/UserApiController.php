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
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

use Automatiz\UserBundle\Entity\User;

class UserApiController extends Controller
{
    /**
     * @param Request $request
     * @return array
     *
     * @Rest\View(serializerGroups={"list"})
     */
    public function allAction(Request $request)
    {
        $currentUser = $this->getUser();

        if($currentUser->hasRole("ROLE_ADMIN")) {
            $em = $this->getDoctrine()->getEntityManager();
            $users = $em->getRepository('AutomatizUserBundle:User')->findAll();

            return array('users' => $users);
        } else {
            throw new UnauthorizedHttpException("not admin", "Resources not allowed.");
        }
    }
}