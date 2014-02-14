<?php

/*
 * This file is part of the Flowchart bundle.
 *
 * FlowchartTest
 * 
 * @TODO: test remove elements: nodes, connections, entries, endings...
 * @author: Julio César Velasco <juceveju@gmail.com>
 */

namespace Juceveju\FlowchartBundle\Tests\Model;

use Juceveju\FlowchartBundle\Model\Flowchart;
use Juceveju\FlowchartBundle\Model\Element;
use Juceveju\FlowchartBundle\Model\Entry;
use Juceveju\FlowchartBundle\Model\Node;
use Juceveju\FlowchartBundle\Model\Ending;
use Juceveju\FlowchartBundle\Model\Connection;

/**
 * Tests the Flowchart class
 * 
 */
class FlowchartTest extends \PHPUnit_Framework_TestCase
{

	/**
	*
	* test for creation method
	*/
	public function testCreation()
	{
		$flowchart = $this->getChart('My new chart');
		// var_dump($flowchart);
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Flowchart', $flowchart);
		$this->assertEquals('My new chart', $flowchart->getName());
		$elements = $flowchart->getElements();
		// check entries 
		$this->assertArrayHasKey('entries', $elements);
        $this->assertNotEmpty($flowchart->getEntries());
        $this->assertContainsOnlyInstancesOf('Juceveju\FlowchartBundle\Model\Entry', $flowchart->getEntries());
        // check nodes
		$this->assertArrayHasKey('nodes', $elements);
		$this->assertNotEmpty($flowchart->getNodes());
		// check endings
		$this->assertArrayHasKey('endings', $elements);
		$this->assertNotEmpty($flowchart->getEndings());

		return $flowchart;
	}

	/**
	*
	* test add connection to chart
	*
	* @depends testCreation
	*/
	public function testAddConnection($flowchart)
	{
		// set connection between Entry and Node
		$entries = $flowchart->getEntries();
		$nodes   = $flowchart->getNodes();
		$endings = $flowchart->getEndings();
		$conn1   =  new Connection($entries[0], $nodes[0], 'connection e0-n0', 'e0-n0'); 
		//$flowchart->setConnection($entries[0], $nodes[0], 'connecton e0-n0', 'e0-n0');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Connection', $conn1);
		$flowchart->addConnection($conn1);
		$this->assertArrayHasKey('connections', $flowchart->getElements());
		$this->assertNotEmpty($flowchart->getConnections());

		return $flowchart;
	}

	/**
	*
	* test add element from chart
	*
	* @depends testAddConnection
	*/
	public function testAddElement($flowchart)
	{
		// add ending
		$flowchart->addElement(new Ending('Ending 3', 'Ending3'));
		$this->assertCount(3, $flowchart->getEndings());

		// add entry
		$flowchart->addElement(new Entry('Entry 3', 'Entry3'));
		$this->assertCount(3, $flowchart->getEntries());

		// add node
		$flowchart->addElement(new Node('Node 3', 'Node3'));
		$this->assertCount(3, $flowchart->getNodes());

		return $flowchart;
	}

	/**
	*
	* @expectedException Exception
	* @expectedExceptionMessage The Element has an invalid type
	*/
	public function testAddElementException()
	{
		$newElement = new Element('Another element');
		$newchart = $this->getChart('Another chart');
		$newchart->addElement($newElement);	
	}

	/**
	*
	* test get elements
	*
	* @depends testAddElement
	*/	
	public function testGetElements($flowchart)
	{
		// get entry by name
		$entry = $flowchart->getEntryByName('Entry 3');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Entry', $entry);
		$this->assertEquals('Entry3', $entry->getId());

		// get entry by id
		$entry = $flowchart->getEntryById('Entry3');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Entry', $entry);
		$this->assertEquals('Entry 3', $entry->getName());		

		// get node by name
		$node = $flowchart->getNodeByName('Node 3');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Node', $node);
		$this->assertEquals('Node3', $node->getId());

		// get node by id
		$node = $flowchart->getNodeById('Node3');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Node', $node);
		$this->assertEquals('Node 3', $node->getName());	

		// get ending by name
		$ending = $flowchart->getEndingByName('Ending 3');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Ending', $ending);
		$this->assertEquals('Ending3', $ending->getId());

		// get ending by id
		$ending = $flowchart->getEndingById('Ending3');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Ending', $ending);
		$this->assertEquals('Ending 3', $ending->getName());	

		// get connection by name
		$conn = $flowchart->getConnectionByName('connection e0-n0');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Connection', $conn);
		$this->assertEquals('e0-n0', $conn->getId());

		// get connection by id	
		$conn = $flowchart->getConnectionById('e0-n0');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Connection', $conn);
		$this->assertEquals('connection e0-n0', $conn->getName());
	}

	/**
	* Test entry not found
	*
	* @depends testAddElement
	* @expectedException Exception
	* @expectedExceptionMessage Entry not found
	*/
	public function testEntryNotFoundException($flowchart)
	{
		// entry not found
		$entry = $flowchart->getEntryByName('Entry 9999');
	}

	/**
	* Test node not found
	*
	* @depends testAddElement
	* @expectedException Exception
	* @expectedExceptionMessage Node not found
	*/
	public function testNodeNotFoundException($flowchart)
	{
		$node = $flowchart->getNodeByName('Node 9999');
	}	

	/**
	* Test ending not found
	*
	* @depends testAddElement
	* @expectedException Exception
	* @expectedExceptionMessage Ending not found
	*/
	public function testEndingNotFoundException($flowchart)
	{
		$ending = $flowchart->getEndingByName('Ending 9999');
	}	

	/**
	* Test connection not found
	*
	* @depends testAddElement
	* @expectedException Exception
	* @expectedExceptionMessage Connection not found
	*/
	public function testConnectionNotFoundException($flowchart)
	{
		$conn = $flowchart->getConnectionById('co n998-n999');
	}	
	
	/**
	*
	* @expectedException Exception
	* @expectedExceptionMessage The Flowchart name cannot be empty
	*/
	public function testFlowchartNameException()
	{
		$newChart = new Flowchart('', array(), array());
	}

	/**
	*
	* Test remove element that belong to connection -> exception must be thrown
	*
	* @depends testAddElement
	* @expectedException Exception
	* @expectedExceptionMessage cannot be removed because belong to the connection
	*/
	public function testRemoveElementThatBelongToConection($flowchart)
	{
		$entries = $flowchart->getEntries();
		$flowchart->removeEntry($entries[0]);
	}

	/**
	* Test remove an inexistent element -> exception must be trhown
	*
	* @depends testAddElement
	* @expectedException Exception
	* @expectedExceptionMessage Entry not found
	*/
	public function testRemoveEntryNotFound($flowchart)
	{
		$entries = $flowchart->getEntries();
		$flowchart->removeEntry(new Entry('Entry 999', 'E999'));
	}

	/**
	*
	* Test remove elements that does not belong to any connection
	*
	* @depends testAddElement
	*/
	public function testRemoveElements($flowchart)
	{
		// remove entry
		$entries =$flowchart->getEntries();
		$flowchart->removeEntry($entries[2]);
		$this->assertNotContains($entries[2], $flowchart->getEntries());

		// remove ending
		$endings = $flowchart->getEndings();
		$flowchart->removeEnding($endings[2]);
		$this->assertNotContains($endings[2], $flowchart->getEndings());

		// remove node
		$nodes   = $flowchart->getNodes();
		$flowchart->removeNode($nodes[2]);
		$this->assertNotContains($nodes[2], $flowchart->getNodes());
	}

	/**
	*
	* Test remove one connection and its elements
	*
	* @depends testAddElement
	*/
	public function testRemoveConnectionAndItsElements($flowchart)
	{
		$conn = $flowchart->getConnectionById('e0-n0');
		$flowchart->removeConnection($conn);
		$this->assertNotContains($conn, $flowchart->getConnections());

		$entries =$flowchart->getEntries();
		$flowchart->removeEntry($entries[0]);
		$this->assertNotContains($entries[0], $flowchart->getEntries());

		$nodes = $flowchart->getNodes();
		$flowchart->removeNode($nodes[0]);
		$this->assertNotContains($nodes[0], $flowchart->getNodes());
	}


	private function getChart($name)
	{
		$elements = array(new Entry('Entry 1', 'E1'), 
							new Entry('Entry 2', 'E2'),
							new Node('Node 1', 'N1'), 
							new Node('Node 2', 'N2'),
							new Ending('Ending 1', 'Ed1'), 
							new Ending('Ending 2', 'Ed2'));
		$connections = array();
		$newChart    = new Flowchart($name, $elements, $connections);
		return $newChart;
	}
}