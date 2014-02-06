<?php

namespace Juceveju\FlowchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JucevejuFlowchartBundle:Default:index.html.twig', array('name' => $name));
    }
}
