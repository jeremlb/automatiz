<?php
namespace Automatiz\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Automatiz\UserBundle\Entity\User;

class UserApiController extends Controller
{
    /**
     * @param Request $request
     * @return array
     *
     * @Rest\View(serializerGroups={"user_info"})
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method",
     *  views = { "default", "defaultuser" }
     * )
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
     * @Rest\View(serializerGroups={"user_detail"})
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method",
     *  views = { "default", "defaultuser" }
     * )
     */
    public function getAction(Request $request, $id)
    {
        $userManager = $this->get("fos_user.user_manager");
        $user = $userManager->findUserBy(array("id" => $id));
        return(array("user" => $user));
    }
}