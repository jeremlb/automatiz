<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 03/11/2015
 * Time: 10:56
 */

namespace Automatiz\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Request;

class MeApiController extends Controller
{
    /**
     * @param Request $request
     * @return array
     *
     * @Rest\View(serializerGroups={"me"})
     */
    public function getAction(Request $request)
    {
        $me = $this->getUser();

        return array("me" => $me);
    }
}