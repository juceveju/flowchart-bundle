<?php
/*
 * Flowchart: Bundle for wrapping and encapsulate the behaviour of the one flow chart
 * http://symfony.com/doc/current/cookbook/doctrine/resolve_target_entity.html
 *
 * Element
 *
 * @author: Julio César Velasco <juceveju@gmail.com>
 *
 */

namespace Juceveju\FlowchartBundle\Model;

use Juceveju\FlowchartBundle\Model\ElementInterface;

class Element implements ElementInterface
{

	protected $name;
	protected $id;


	public function __construct($name, $id=null){
		$this->setName($name);
		$this->setId($id);		
	}

    /**
     *
     * returns the id of the element
     *
     * @return string
     */
	public function getId(){
		return $this->id;
	}	

	/**
	*
	* Set the id of the element
 	*
	* @param string $id
	*/
	public function setId($id)
	{
		if (empty($id))	
			$this->id = md5($this->name);
		else 
			$this->id = $id;	}

	/**
	*
	* returns the name of the element
	*
	* @return string
	*/
	public function getName()
	{
		return $this->name;
	}

	/**
	*
	* Set the name of the element
 	*
	* @param string $name
	*/
	public function setName($name)
	{
		if(empty($name))
			throw new \Exception("The Element name cannot be empty", 500);
		else		
			$this->name = $name;
	}

    /**
     * return all incoming connections in the element
     *
     * @return array of Juceveju\FlowchartBundle\Model\Connection
     */
    // public function getIncomingConnections(); // valdría sólo con tener los eltos en las conexiones?????

    /**
     * return all outgoing connections in the element
     *
     * @return array of Juceveju\FlowchartBundle\Model\Connection
     */
    // public function getOutgoingConnections(); // valdría sólo con tener los eltos en las conexiones?????
}