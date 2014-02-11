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

interface FlowchartInterface
{

    /**
     * return the name of the flowchart
     *
     * @return string
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
     * @return array of Elements
     */
    public function getElements();

	/**
	*
	* add a new item to the elements array
 	*/
	public function addElement($element);

	/**
	*
	* remove an item from the elements array
 	*/
	public function removeElement($element);

    /**
     * return all entry elements in the chart
     *
     * @return array of Elements
     */
    public function getEntries();

	/**
	*
	* add a new item to the enties array
 	*/
	public function addEntry($entry);

	/**
	*
	* remove an item from the entries array
 	*/
	public function removeEntry($entry);

    /**
     * return all ending elements in the chart
     *
     * @return array of Elements
     */
    public function getEndings();    

	/**
	*
	* add a new item to the endings array
 	*/
    public function addEnding($ending);

	/**
	*
	* remove an item from the endings array
 	*/
	public function removeEnding($ending);

    /**
    *
    * set connection between two elements
    */
    public function setConnection($connectionId, $element1, $element2);

    /**
    *
    * remove connection between two elements
    */
    public function removeConnection();


    /**
     * return all possible itineraries in the chart
     *
     * @return array of Itineraries
     */
    //public function getItineraries();   

}