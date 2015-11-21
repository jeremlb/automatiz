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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class MeApiController extends Controller
{
    /**
     * @param Request $request
     * @return array
     *
     * @Rest\View(serializerGroups={"me"})
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method",
     *  views = { "default", "defaultuser" }
     * )
     */
    public function getAction(Request $request)
    {
        $me = $this->getUser();

        return array("me" => $me);
    }

    /**
     * @param Request $request
     * @return array
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method",
     *  views = { "default", "defaultuser" }
     * )
     */
    public function getStatsAction(Request $request)
    {
        $me = $this->getUser();

        return array("stats" => $me->getStats());
    }
}