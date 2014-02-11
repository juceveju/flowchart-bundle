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

use Juceveju\FlowchartBundle\Model\Connection;

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
}