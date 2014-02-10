<?php
/*
 * Flowchart: Bundle for wrapping and encapsulate the behaviour of the one flow chart
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
     * return all elements in the flowchart
     *
     * @return array of Elements
     */
    public function getElements();

    /**
     * return all entry elements in the chart
     *
     * @return array of Elements
     */
    public function getEntries();

    /**
     * return all ending elements in the chart
     *
     * @return array of Elements
     */
    public function getEndings();    

    /**
     * return all possible itineraries in the chart
     *
     * @return array of Itineraries
     */
    public function getItineraries();   

}