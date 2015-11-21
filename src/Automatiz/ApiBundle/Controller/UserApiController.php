<?php
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
        $em = $this->getDoctrine()->getEntityManager();
        $users = $em->getRepository('AutomatizUserBundle:User')->findAll();
        return array('users' => $users);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @Rest\View(serializerGroups={"details_user"})
     */
    public function getAction(Request $request, $id)
    {
        $userManager = $this->get("fos_user.user_manager");
        $user = $userManager->findUserBy(array("id" => $id));
        return(array("user" => $user));
    }
}