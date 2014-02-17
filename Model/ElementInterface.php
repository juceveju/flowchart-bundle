<?php
/*
 * Flowchart: Bundle for wrapping and encapsulate the behaviour of one flow chart
 *
 * ElementInterface
 *
 * @author: Julio César Velasco <juceveju@gmail.com>
 *
 */

namespace Juceveju\FlowchartBundle\Model;

use Juceveju\FlowchartBundle\Model\Element;

interface ElementInterface
{

    /**
     *
     * return the name of the element
     */
    public function getName();

	/**
	*
	* Set the name of the element
 	*/
	public function setName($name);

    /**
     *
     * return the id of the element
     */
	public function getId();

	/**
	*
	* Set the id of the element
 	*/
	public function setId($id);

	/**
	*
	* returns all the outgoing connections in the element
	*/
	public function getOutgoingConnections();

	/**
	*
	* returns all the incoming connections in the element
	*/
	public function getIncomingConnections();

	/**
	*
	* Add an incoming connection to the element
	*/
	public function addIncomingConnection(Connection $conn);

	/**
	*
	* Add an outgoing connection to the element
	*/
	public function addOutgoingConnection(Connection $conn);	

	/**
	*
	* Remove an outgoing connection from the element
	*/
	public function removeOutgoingConnection(Connection $conn);		

	/**
	*
	* Remove an incoming connection from the element
	*/
	public function removeIncomingConnection(Connection $conn);		
}