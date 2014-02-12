<?php
/*
 * Flowchart: Bundle for wrapping and encapsulate the behaviour of the one flow chart
 * http://symfony.com/doc/current/cookbook/doctrine/resolve_target_entity.html
 *
 * ChartInterface
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

interface FlowchartInterface
{

    /**
     * return the name of the flowchart
     *
     */
    public function getName();

	/**
	*
	* Set the name of the flowchart
 	*/    
    public function setName($name);

    /**
     * return all elements in the flowchart
     *
     */
    public function getElements();

	/**
	*
	* add a new item to the elements array
 	*/
	public function addElement(Element $element);

	/**
	*
	* remove an item from the elements array
 	*/
	public function removeElement(Element $element);

    /**
     * return all entry elements in the chart
     *
     */
    public function getEntries();

	/**
	*
	* add a new item to the enties array
 	*/
	public function addEntry(Entry $entry);

	/**
	*
	* remove an item from the entries array
 	*/
	public function removeEntry(Entry $entry);

    /**
     * return all ending elements in the chart
     *
     */
    public function getEndings();    

	/**
	*
	* add a new item to the endings array
 	*/
    public function addEnding(Ending $ending);

	/**
	*
	* remove an item from the nodes array
 	*/
	public function removeNode(Node $ending);

    /**
     * return all node elements in the chart
     *
     */
    public function getNodes();    

	/**
	*
	* add a new item to the nodes array
 	*/
    public function addNode(Node $ending);

	/**
	*
	* remove an item from the endings array
 	*/
	public function removeEnding(Ending $ending);

    /**
    *
    * set connection between two elements
    */
    public function addConnection(Connection $connection);

    /**
    *
    * remove connection between two elements
    */
    public function removeConnection(Connection $connection);

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Entry
	*/
	public function getEntryByName($name);

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Entry
	*/
	public function getEntryById($id);

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Ending
	*/
	public function getEndingByName($name);

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Ending
	*/
	public function getEndingById($id);

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Node
	*/
	public function getNodeByName($name);

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Node
	*/
	public function getNodeById($id);

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Connection
	*/
	public function getConnectionByName($name);

	/**
	*
	* returns an instance of Juceveju\FlowchartBundle\Model\Connection
	*/
	public function getConnectionById($id);


    /**
     * return all possible itineraries in the chart
     *
     */
    //public function getItineraries();   

}