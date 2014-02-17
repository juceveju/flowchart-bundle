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
use Juceveju\FlowchartBundle\Model\Connection;

class Element implements ElementInterface
{

	protected $name;
	protected $id;
	protected $outgoingConnections;
	protected $incomingConnections;
	//protected $type;

	public function __construct($name, $id=null){
		$this->setName($name);
		$this->setId($id);	
		$this->outgoingConnections = array();
		$this->incomingConnections = array();
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
    public function getIncomingConnections()
    {
		return $this->incomingConnections;
    }

    /**
    *
    * Add an incoming connection to the element
    * 
    * @param Connection $conn
    */
    public function addIncomingConnection(Connection $conn)
    {
    	// check that the end element of the connection is the current element
    	if ($conn->getEndElement()->getId() == $this->id
    		&& $conn->getEndElement()->getName() == $this->name)
    	{
	    	// check the connection is not already in incomming connections
	    	if (false ===$this->checkConnectionExists('incoming', $conn))
	    		$this->incomingConnections[] = $conn;
	    	else
	    		throw new \Exception("Incomming connection already exists", 500);
    	} else {
    		throw new \Exception("The end element of the connection is not the current element", 500);
    	}	
    }

    /**
    *
    * Add an outgoing connection to the element
    * 
    * @param Connection $conn
    */
    public function addOutgoingConnection(Connection $conn)
    {
    	// check the connection is not already in incomming connections
    	if (false === $this->checkConnectionExists('outgoing', $conn))
    		$this->outgoingConnections[] = $conn;
    	else
    		throw new \Exception("Outgoing connection already exists", 500);
    		
    }

    /**
     * return all outgoing connections in the element
     *
     * @return array of Juceveju\FlowchartBundle\Model\Connection
     */
    public function getOutgoingConnections()
    {
		return $this->outgoingConnections;
    }

    /**
    *
    * check if the connection belongs to the element
    * 
    * @return boolean
    */
    protected function checkConnectionExists($type, $connection)
    {
    	$connections = array();
    	switch ($type) {
    		case 'incoming':
    			$connections = $this->incomingConnections;
    			break;
    		case 'outgoing':
    			$connections = $this->outgoingConnections;
    			break;
    	}

    	foreach ($connections as $key => $conn) {
    		if ($conn->getName() == $connection->getName()
    			|| $conn->getId() == $connection->getId())
    			return true;
    	}

    	return false;
    }

    /**
    *
    * Remove an outgoing connection
    *
	* @param Connection $connection
	* @return true || exception if does not exist
    */
    public function removeOutgoingConnection(Connection $connection)
    {
		foreach ($this->outgoingConnections as $key => $conn) {
			if ($conn->getId() == $connection->getId()){
				unset($this->outgoingConnections[$key]);
				return true;
			}
		}
		
		throw new \Exception("Outgoing connection does not exist", 404);	    	
    }

    /**
    *
    * Remove an incoming connection
    *
	* @param Connection $connection
	* @return true || exception if does not exist
    */
    public function removeIncomingConnection(Connection $connection)
    {
		foreach ($this->incomingConnections as $key => $conn) {
			if ($conn->getId() == $connection->getId()){
				unset($this->incomingConnections[$key]);
				return true;
			}
		}
		
		throw new \Exception("Incoming connection does not exist", 404);	    	
    }    
}