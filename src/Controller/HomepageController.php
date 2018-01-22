<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{

    public function indexAction()
    {
        return $this->render('homepage/index.html.twig');
    }

}
