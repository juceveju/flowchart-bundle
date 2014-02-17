<?php

/*
 * This file is part of the Flowchart bundle.
 *
 * ElementTest
 *
 * @author: Julio César Velasco <juceveju@gmail.com>
 */

namespace Juceveju\FlowchartBundle\Tests\Model;

use Juceveju\FlowchartBundle\Model\Element;
use Juceveju\FlowchartBundle\Model\Connection;

/**
 * Tests the element class
 * 
 */
class ElementTest extends \PHPUnit_Framework_TestCase
{

	public function setUp()
	{ 
		// executed before each test is executed
	}
  	public function tearDown()
  	{ 
  		// executed after each test is executed
  	}


	public function testCreation()
	{
		// passing all params
		$element1 = new Element('My amazing element', 'elementId');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Element', $element1);
		$this->assertEquals('My amazing element', $element1->getName());
		$this->assertEquals('elementId', $element1->getId());

		// without passing id
		$element2 = new Element('My amazing element2');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Element', $element2);
		$this->assertEquals(md5('My amazing element2'), $element2->getId());	
		$this->assertEquals('My amazing element2', $element2->getName());
	} 

	/**
	*
	* @expectedException Exception
	* @expectedExceptionMessage The Element name cannot be empty
	*/
	public function testElementNameException()
	{
		$element1 = new Element('', 'elementId');
	}

	/**
	*
	* Test add incoming connection
	*/
	public function testAddIncomingConnection()
	{
		$startEl = new Element('El1', 'E1');
		$endEl   = new Element('El2', 'E2');
		$conn = new Connection($startEl, $endEl, 'conn1', 'c1');
		$endEl->addIncomingConnection($conn);
		$incommingConns = $endEl->getIncomingConnections();
		$this->assertCount(1, $incommingConns);
		$this->assertEquals($endEl, $incommingConns[0]->getEndElement());

		return $endEl;
	}

	/**
	*
	* Test add existing incoming connection
	*
	* @depends testAddIncomingConnection	
	* @expectedException Exception
	* @expectedExceptionMessage Incomming connection already exists		
	*/	
	public function testAddExistingIncomingConnection($endEl)
	{ 
		$conns = $endEl->getIncomingConnections();
		$endEl->addIncomingConnection($conns[0]);
	}

	/**
	*
	* Test remove incoming connection
	*
	* @depends testAddIncomingConnection		
	*/
	public function testRemoveIncommingConnection($endEl)
	{
		$incommingConns = $endEl->getIncomingConnections();
		$endEl->removeIncomingConnection($incommingConns[0]);
		$this->assertCount(0, $endEl->getIncomingConnections());
		return $endEl;
	}

	/**
	*
	* Test remove not existing incomig connection
	*
	* @depends testRemoveIncommingConnection
	* @expectedException Exception
	* @expectedExceptionMessage Incoming connection does not exist		
	*/		
	public function testRemoveNotExistingIncommingConnection($endEl)
	{
		$conn = new Connection(new Element('El5', 'E5'), new Element('El6', 'E6'), 'conn3', 'c3');
		$endEl->removeIncomingConnection($conn);
	}

	/**
	*
	* Test add outgoing connection
	*/
	public function testAddOutgoingConnection()
	{
		$startEl = new Element('El7', 'E7');
		$endEl   = new Element('El8', 'E8');
		$conn = new Connection($startEl, $endEl, 'conn4', 'c4');
		$startEl->addOutgoingConnection($conn);
		$outgoingConns = $startEl->getOutgoingConnections();
		$this->assertCount(1, $outgoingConns);
		$this->assertEquals($startEl, $outgoingConns[0]->getStartElement());
		return $startEl;
	}

	/**
	*
	* Test add existing outgoing connection
	*
	* @depends testAddOutgoingConnection	
	* @expectedException Exception
	* @expectedExceptionMessage Outgoing connection already exists			
	*/	
	public function testAddExistingOutgoingConnection($startEl)
	{ 
		$conns = $startEl->getOutgoingConnections();
		$startEl->addOutgoingConnection($conns[0]);
	}

	/**
	*
	* Test remove outgoing connection
	*
	* @depends testAddOutgoingConnection
	*/
	public function testRemoveOutgoingConnection($startEl)
	{
		$conns = $startEl->getOutgoingConnections();
		$startEl->removeOutgoingConnection($conns[0]);
		$this->assertCount(0, $startEl->getOutgoingConnections());
		return $startEl;
	}	

	/**
	*
	* Test remove not existing outgoing connection
	* @depends testAddOutgoingConnection	
	* @expectedException Exception
	* @expectedExceptionMessage Outgoing connection does not exist		
	*/	
	public function testRemoveNotExistingOutgoingConnection($startEl)
	{
		$newConn = new Connection(new Element('El9', 'E9'), new Element('El10', 'E10'), 'conn5', 'c5');
		$startEl->removeOutgoingConnection($newConn);
	}

}