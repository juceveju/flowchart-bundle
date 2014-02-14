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
}