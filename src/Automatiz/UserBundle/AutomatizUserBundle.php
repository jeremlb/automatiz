<?php

namespace Automatiz\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AutomatizUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
