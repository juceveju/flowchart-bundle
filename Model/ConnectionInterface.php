<?php
/*
 * Flowchart: Bundle for wrapping and encapsulate the behaviour of the one flow chart
 * http://symfony.com/doc/current/cookbook/doctrine/resolve_target_entity.html
 *
 * ConnectionInterface
 *
 * @author: Julio César Velasco <juceveju@gmail.com>
 *
 */

namespace Juceveju\FlowchartBundle\Model;

use Juceveju\FlowchartBundle\Model\Element;

interface ConnectionInterface
{

    /**
     *
     * return the id of the connection
     */
	public function getId();

	/**
	*
	* Set the id of the connection
 	*/
	public function setId($id);

    /**
     *
     * return the name of the connection
     */
    public function getName();

	/**
	*
	* Set the name of the connection
 	*/
	public function setName($name);

	/**
	*
	* set the intitial point of the connection
	*
	* @param Element $element
	*/
	public function setStartElement(Element $element);

	/**
	*
	* returns the initial point of the connection
	*/
	public function getStartElement();

	/**
	*
	* set the ending point of the connection
	*
	* @param Element $element	
	*/
	public function setEndElement(Element $element);

	/**
	*
	* returns the ending point of the connection
	*/
	public function getEndElement();
}
