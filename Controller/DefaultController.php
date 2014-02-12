<?php

namespace Juceveju\FlowchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Juceveju\FlowchartBundle\Model\Element;
use Juceveju\FlowchartBundle\Model\Flowchart;
use Juceveju\FlowchartBundle\Model\Node;
use Juceveju\FlowchartBundle\Model\Entry;
use Juceveju\FlowchartBundle\Model\Ending;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$elm = new Element('name', 'id');

    	// $entries = $elements = $endings = $connections =array();
    	// $newChart = new Flowchart('my new chart', $entries, $elements, $endings, $connections);
    	// ladybug_dump($newChart);
    	$node1 = new Node('my node 1', 'node1');
    	$node2 = new Node('my node 2', 'node2');
    	$ending1 = new Ending('my ending 1', 'ending1');
    	$ending2 = new Ending('my ending 2', 'ending2');
    	$entry1  = new Entry('my entry 1', 'entry1');
    	$entry2  = new Entry('my entry 2', 'entry2');
    	$elements    = array($node1, $node2, $ending1, $ending2, $entry1, $entry2);
    	$connections = array();
    	$newChart    = new Flowchart('my new chart', $elements, $connections);

    	ladybug_dump($newChart->getElements());
		$entry3  = new Entry('my entry 3', 'entry3');
    	$newChart->removeElement($entry3);

    	ladybug_dump($newChart->getElements());

        return $this->render('JucevejuFlowchartBundle:Default:index.html.twig', 
        						array('jsplumb_path' => $this->container->getParameter('juceveju_flowchart.jsplumb_path')));
    }
}
