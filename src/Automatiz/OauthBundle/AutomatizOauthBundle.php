<?php

namespace Automatiz\OauthBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AutomatizOauthBundle extends Bundle
{
    public function getParent()
    {
        return "FOSOAuthServerBundle";
    }
}
