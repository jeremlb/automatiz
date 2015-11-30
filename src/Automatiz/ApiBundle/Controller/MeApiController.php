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
     * @Rest\View(serializerGroups={"user_detail"})
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
     * @Rest\View(serializerGroups={"stat_info"})
     * @param Request $request
     * @return array
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method",
     *  views = { "stat_info" }
     * )
     */
    public function getStatsAction(Request $request)
    {
        $me = $this->getUser();

        return array("stats" => $me->getStats());
    }
}