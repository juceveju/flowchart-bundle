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

interface ElementInterface
{

    /**
     * return the name of the flowchart
     *
     * @return string
     */
    public function getName();

    /**
     * return all incoming connections in the element
     *
     * @return array of Connections
     */
    public function getIncomingConnections(); 

    /**
     * return all outgoing connections in the element
     *
     * @return array of Connections
     */
    public function getOutgoingConnections(); 
    
}