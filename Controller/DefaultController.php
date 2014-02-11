<?php

namespace Juceveju\FlowchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Juceveju\FlowchartBundle\Model\Element;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$elm = new Element('name', 'id');
    	ladybug_dump($elm);
        return $this->render('JucevejuFlowchartBundle:Default:index.html.twig', 
        						array('jsplumb_path' => $this->container->getParameter('juceveju_flowchart.jsplumb_path')));
    }
}
