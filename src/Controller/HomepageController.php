<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomepageController
{
    /**
     * @Template("homepage/index.html.twig")
     */
    public function indexAction()
    {
        return [];
    }
}
