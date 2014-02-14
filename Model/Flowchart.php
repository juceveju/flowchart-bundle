<?php

/*
 * Flowchart: Bundle for wrapping and encapsulate the behaviour of the one flow chart
 * http://symfony.com/doc/current/cookbook/doctrine/resolve_target_entity.html
 *
 * Flowchart
 *
 * @author: Julio César Velasco <juceveju@gmail.com>
 *
 */

namespace Juceveju\FlowchartBundle\Model;

use Juceveju\FlowchartBundle\Model\Element;
use Juceveju\FlowchartBundle\Model\Entry;
use Juceveju\FlowchartBundle\Model\Ending;
use Juceveju\FlowchartBundle\Model\Node;
use Juceveju\FlowchartBundle\Model\Connection;

class Flowchart implements FlowchartInterface
{

	protected $name;
	protected $elements = array();
	//protected $itineraries  = array();

	public function __construct($name, $elements=array(), $connections=array())
	{
		$this->setName($name);
		foreach ($elements as $element) 
			$this->addElement($element);
		foreach ($connections as $connections) 
			$this->addConnection($connection);		
	}

	/**
	*
	* returns the name of the flowchart
	*
	* @return string
	*/
	public function getName()
	{
		return $this->name;
	}

	/**
	*
	* Set the name of the flowchart
 	*
	* @param string $name
	*/
	public function setName($name)
	{
		if(empty($name))
			throw new \Exception("The Flowchart name cannot be empty", 500);
		else
			$this->name = $name;
	}

	/**
	*
	* returns an array of Juceveju\FlowchartBundle\Model\Element
	*
	* @return array
	*/
	public function getElements()
	{
		return $this->elements;
	}

	/**
	*
	* add a new item to the elements array
 	*
	* @param Element $element
	*/
	public function addElement(Element $element)
	{
		// @TODO: check that name and id are uniques
		switch (get_class($element)) {
			case 'Juceveju\FlowchartBundle\Model\Node':
				$this->addNode($element);
				break;
			case 'Juceveju\FlowchartBundle\Model\Entry':
				$this->addEntry($element);
				break;
			case 'Juceveju\FlowchartBundle\Model\Ending':
				$this->addEnding($element);
				break;			
			default:
				throw new \Exception("Error while adding the element: The Element has an invalid type", 500);
				break;
		}
	}

	/**
	*
	* remove an item from the elements array. If the element is removed returnstrue, if the element does not
	* exists remove false and if the type of element is invalid an exception is thrown
	*
	* @param Element $element
 	*/
	public function removeElement(Element $element)
	{
		switch (get_class($element)) {
			case 'Juceveju\FlowchartBundle\Model\Node':
				return $this->removeNode($element);
				break;
			case 'Juceveju\FlowchartBundle\Model\Entry':
				return $this->removeEntry($element);
				break;
			case 'Juceveju\FlowchartBundle\Model\Ending':
				return $this->removeEnding($element);
				break;
			default:
				throw new \Exception("Error while removing the element: The Element has an invalid type", 500);
				break;
		}		
	}

	/**
	*
	* returns an array of Juceveju\FlowchartBundle\Model\Entry
	*
	* @return array
	*/
	public function getEntries()
	{
		return $this->elements['entries'];
	}

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Entry
	*
	* @return Juceveju\FlowchartBundle\Model\Entry
	*/
	public function getEntryByName($name)
	{
		foreach ($this->elements['entries'] as $key => $entry) {
			if ($entry->getName() == $name)
				return $entry;
		}

		throw new \Exception("Entry not found", 404);
	}

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Entry
	*
	* @return Juceveju\FlowchartBundle\Model\Entry
	*/
	public function getEntryById($id)
	{
		foreach ($this->elements['entries'] as $key => $entry) {
			if ($entry->getId() == $id)
				return $entry;
		}

		throw new \Exception("Entry not found", 404);		
	}

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Ending
	*
	* @return Juceveju\FlowchartBundle\Model\Ending
	*/
	public function getEndingByName($name)
	{
		foreach ($this->elements['endings'] as $key => $ending) {
			if ($ending->getName() == $name)
				return $ending;
		}

		throw new \Exception("Ending not found", 404);
	}

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Ending
	*
	* @return Juceveju\FlowchartBundle\Model\Node
	*/
	public function getEndingById($id)
	{
		foreach ($this->elements['endings'] as $key => $ending) {
			if ($ending->getId() == $id)
				return $ending;
		}

		throw new \Exception("Ending not found", 404);		
	}

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Node
	*
	* @return Juceveju\FlowchartBundle\Model\Node
	*/
	public function getNodeByName($name)
	{
		foreach ($this->elements['nodes'] as $key => $node) {
			if ($node->getName() == $name)
				return $node;
		}

		throw new \Exception("Node not found", 404);		
	}

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Node
	*
	* @return Juceveju\FlowchartBundle\Model\Node
	*/
	public function getNodeById($id)
	{
		foreach ($this->elements['nodes'] as $key => $node) {
			if ($node->getId() == $id)
				return $node;
		}

		throw new \Exception("Node not found", 404);			
	}

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Connection
	*
	* @return Juceveju\FlowchartBundle\Model\Connection
	*/
	public function getConnectionByName($name)
	{
		foreach ($this->elements['connections'] as $key => $conn) {
			if ($conn->getName() == $name)
				return $conn;
		}

		throw new \Exception("Connection not found", 404);			
	}

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Connection
	*
	* @return Juceveju\FlowchartBundle\Model\Connection
	*/
	public function getConnectionById($id)
	{
		foreach ($this->elements['connections'] as $key => $conn) {
			if ($conn->getId() == $id)
				return $conn;
		}

		throw new \Exception("Connection not found", 404);				
	}

	/**
	*
	* add a new item to the entries array
 	*
	* @param Entry $entry
	*/
	public function addEntry(Entry $entry)
	{
		// @TODO: check that name and id are uniques
		//$this->entries[] = $entry;
		$this->elements['entries'][] = $entry;
	}

	/**
	*
	* remove an item from the entries array
	*
	* @param Entry $entry
 	*/
	public function removeEntry(Entry $entry)
	{
		// TODO: check that it does not belong to any connection
		foreach ($this->elements['entries'] as $key => $ent) {
			if ($ent->getId() == $entry->getId()){
				$conn = $this->belongToConnection($entry);
				if ($conn === false)
				{ 
					//unset($this->entries[$key]);
					unset($this->elements['entries'][$key]);
					return true;
				} else {
					throw new \Exception("The entry cannot be removed because belong to the connection: " . $conn->getId(), 404);
				}				
			}
		}

		throw new \Exception("Entry not found", 404);
	}

	/**
	*
	* returns an array of Juceveju\FlowchartBundle\Model\Ending
	*
	* @return array
	*/
	public function getEndings()
	{
		return $this->elements['endings'];
	}

	/**
	*
	* add a new item to the endings array
 	*
	* @param Entry $ending
	*/
	public function addEnding(Ending $ending)
	{
		// @TODO: check that name and id are uniques
		//$this->endings[] = $ending;
		$this->elements['endings'][] = $ending;
	}

	/**
	*
	* remove an item from the endings array
	*
	* @param Ending $ending
 	*/
	public function removeEnding(Ending $ending)
	{
		// TODO: check that it does not belong to any connection
		foreach ($this->elements['endings'] as $key => $end) {
			if ($end->getId() == $ending->getId()){
				$conn = $this->belongToConnection($ending);
				if ($conn === false)
				{ 
					//unset($this->endings[$key]);
					unset($this->elements['endings'][$key]);
					return true;
				} else {
					throw new \Exception("The ending point cannot be removed because belong to the connection: " . $conn->getId(), 404);
				}			
			}
		}

		throw new \Exception("Ending not found", 404);
	}

	/**
	*
	* returns an array of Juceveju\FlowchartBundle\Model\Node
	*
	* @return array
	*/
	public function getNodes()
	{
		return $this->elements['nodes'];
	}

	/**
	*
	* add a new item to the nodes array
 	*
	* @param Entry $node
	*/
	public function addNode(Node $node)
	{
		// @TODO: check that name and id are uniques
		//$this->nodes[] = $node;
		$this->elements['nodes'][] = $node;
	}

	/**
	*
	* remove an item from the nodes array
	*
	* @param Ending $node
 	*/
	public function removeNode(Node $node)
	{ 
		foreach ($this->elements['nodes'] as $key => $n) {
			if ($node->getId() == $n->getId()){
				$conn = $this->belongToConnection($node);
				if ($conn === false)
				{ 
					//unset($this->nodes[$key]);
					unset($this->elements['nodes'][$key]);
					return true;
				} else {
					throw new \Exception("The node cannot be removed because belong to the connection: " . $conn->getId(), 404);
				}
			}
		}

		throw new \Exception("Node not found", 404);
	}

	/**
	*
	* add a new item to the connections array
 	*
	* @param Connection $connection
	*/
	public function addConnection(Connection $connection)
	{
		// @TODO: check that name and id are uniques
		//$this->connections[] = $connection;
		$this->elements['connections'][] = $connection;
	}

	/**
	*
	* remove a connection between elements
	*
	* @param Connection $connection
	*/
	public function removeConnection(Connection $connection)
	{
		foreach ($this->elements['connections'] as $key => $conn) {
			if ($conn->getId() == $connection->getId()){
				//unset($this->connections[$key]);
				unset($this->elements['connections'][$key]);
				return true;
			}
		}
		
		throw new \Exception("Connection not found", 404);
	}

	/**
	*
	* Return the connections in the flowchart
	*
	* @return array
	*/
	public function getConnections()
	{
		return $this->elements['connections'];
	}

	/**
	*
	* If the element belong to connection returns this connection, in other case throw a not found exception
	*
	* @param Element $element
	* @return Connection
	*/
	public function belongToConnection(Element $element)
	{
		foreach ($this->elements['connections'] as $connection) {
			// check start element
			if ($connection->getStartElement()->getId() == $element->getId())
				return $connection;

			// check end element
			if ($connection->getEndElement()->getId() == $element->getId())
				return $connection;
		}
		
		return false;
	}

	/*
	public function getItineraries()
	{

	}

	public function addItinerary()
	{

	}*/
}
