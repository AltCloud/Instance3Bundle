<?php

namespace AltCloud\Instance3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('ACInst3Bundle:Default:index.html.twig', array('name' => $name));
    }
}
