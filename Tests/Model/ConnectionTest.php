<?php

/*
 * This file is part of the Flowchart bundle.
 *
 * ConnectionTest
 *
 * @author: Julio César Velasco <juceveju@gmail.com>
 */

namespace Juceveju\FlowchartBundle\Tests\Model;

use Juceveju\FlowchartBundle\Model\Connection;
use Juceveju\FlowchartBundle\Model\Element;
use Juceveju\FlowchartBundle\Model\Ending;
use Juceveju\FlowchartBundle\Model\Entry;

/**
 * Tests the connection class
 * 
 */
class ConnectionTest extends \PHPUnit_Framework_TestCase
{

	public function testCreation()
	{
		$startElement = new Element('startElement');
		$endElement   = new Element('endElement');
		// create connection without passing id
		$conn1 = new Connection($startElement, $endElement, 'my first connection');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Connection', $conn1);
		$this->assertEquals('my first connection', $conn1->getName());
		$this->assertEquals(md5('my first connection'), $conn1->getId());

		// create connection passing id
		$conn2 = new Connection($startElement, $endElement, 'my second connection', 'connection2Id');
		$this->assertInstanceOf('Juceveju\FlowchartBundle\Model\Connection', $conn2);		
		$this->assertEquals('my second connection', $conn2->getName());
		$this->assertEquals('connection2Id', $conn2->getId());		
	}

	/**
	*
	* @expectedException Exception
	* @expectedExceptionMessage The Connection name cannot be empty
	*/
	public function testConnectionNameException()
	{
		$conn1 = new Connection(new Element('startElement'), new Element('endElement'), '');
	}

	/**
	*
	* @expectedException Exception
	* @expectedExceptionMessage Ending element cannot be the origin of the connection
	*/
	public function testStartElementException()
	{
		$conn1 = new Connection(new Ending('startElement'), new Element('endElement'), 'new connection');
	}

	/**
	*
	* @expectedException Exception
	* @expectedExceptionMessage Entry element cannot be the end of the connection
	*/
	public function testEndElementException()
	{
		$conn1 = new Connection(new Element('startElement'), new Entry('endElement'), 'new connection');
	}	
}