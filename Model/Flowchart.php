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
use Juceveju\FlowchartBundle\Model\Connection;

class Flowchart implements FlowchartInterface
{

	protected $name;
	protected $elements = array();
	protected $entries  = array();
	protected $endings  = array();
	protected $connections = array();
	//protected $itineraries  = array();

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
		$this->elements[] = $element;
	}

	/**
	*
	* remove an item from the elements array
	*
	* @param Element $element
 	*/
	public function removeElement($element)
	{
		if ($element instanceof Juceveju\FlowchartBundle\Model\Entry)
			return $this->removeEntry($element);
		elseif ($element instanceof Juceveju\FlowchartBundle\Model\Ending)
			return $this->removeEnding($element);
		else {
			foreach ($this->elements as $key => $elm) {
				if ($elm->getId() == $element->getId()){
					unset($this->elements[$key]);
					return true;
				}
			}	
			return false;		
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
		return $this->entries;
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
		$this->entries[] = $entry;
	}

	/**
	*
	* remove an item from the entries array
	*
	* @param Entry $entry
 	*/
	public function removeEntry($entry)
	{
		foreach ($this->entries as $key => $ent) {
			if ($ent->getId() == $entry->getId()){
				unset($this->entries[$key]);
				return true;
			}
		}
		return false;
	}

	/**
	*
	* returns an array of Juceveju\FlowchartBundle\Model\Ending
	*
	* @return array
	*/
	public function getEndings()
	{
		return $this->endings;
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
		$this->endings[] = $ending;
	}

	/**
	*
	* remove an item from the endings array
	*
	* @param Ending $ending
 	*/
	public function removeEnding($ending)
	{
		foreach ($this->endings as $key => $end) {
			if ($end->getId() == $ending->getId()){
				unset($this->endings[$key]);
				return true;
			}
		}

		return false;
	}

	/**
	*
	* establish a connection between two elements
	*
	* @param Element $startElement
	* @param Element $endingElement
	* @param string $name
	* @param string $id
	*/
	public function setConnection(Element $startElement, Element $endingElement, $name, $id=null)
	{
		// @TODO: check that name and id are uniques
		$conn = new Connection($startElement, $endingElement, $name, $id);
		$this->connections[$conn];
	}

	/**
	*
	* remove a connection between elements
	*
	* @param Connection $connection
	*/
	public function removeConnection($connection)
	{
		foreach ($this->connections as $key => $conn) {
			if ($conn->getId() == $connection->getId()){
				unset($this->connections[$key]);
				return true;
			}
		}
		return false;
	}

	/**
	*
	* Return the connections in the flowchart
	*
	* @return array
	*/
	public function getConnections()
	{
		return $this->connections;
	}

	/*
	public function getItineraries()
	{

	}

	public function addItinerary()
	{

	}*/
}
