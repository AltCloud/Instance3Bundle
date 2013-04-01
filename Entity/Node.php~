<?php

namespace AltCloud\Instance3Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AltCloud\Instance3Bundle\Entity\Node
 */
class Node
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $machine_name
     */
    private $machine_name;

    /**
     * @var string $mode
     */
    private $mode;

    /**
     * @var string $target_entity
     */
    private $target_entity;

    /**
     * @var string $target_view
     */
    private $target_view;

    /**
     * @var array $target_params
     */
    private $target_params;

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var AltCloud\Instance3Bundle\Entity\Node
     */
    private $children;

    /**
     * @var AltCloud\Instance3Bundle\Entity\Node
     */
    private $parent;

    /**
     * @var AltCloud\Instance3Bundle\Entity\Site
     */
    private $site;

    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set machine_name
     *
     * @param string $machineName
     */
    public function setMachineName($machineName)
    {
        $this->machine_name = $machineName;
    }

    /**
     * Get machine_name
     *
     * @return string 
     */
    public function getMachineName()
    {
        return $this->machine_name;
    }

    /**
     * Set mode
     *
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * Get mode
     *
     * @return string 
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set target_entity
     *
     * @param string $targetEntity
     */
    public function setTargetEntity($targetEntity)
    {
        $this->target_entity = $targetEntity;
    }

    /**
     * Get target_entity
     *
     * @return string 
     */
    public function getTargetEntity()
    {
        return $this->target_entity;
    }

    /**
     * Set target_view
     *
     * @param string $targetView
     */
    public function setTargetView($targetView)
    {
        $this->target_view = $targetView;
    }

    /**
     * Get target_view
     *
     * @return string 
     */
    public function getTargetView()
    {
        return $this->target_view;
    }

    /**
     * Set target_params
     *
     * @param array $targetParams
     */
    public function setTargetParams($targetParams)
    {
        $this->target_params = $targetParams;
    }

    /**
     * Get target_params
     *
     * @return array 
     */
    public function getTargetParams()
    {
        return $this->target_params;
    }

    /**
     * Set label
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add children
     *
     * @param AltCloud\Instance3Bundle\Entity\Node $children
     */
    public function addNode(\AltCloud\Instance3Bundle\Entity\Node $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param AltCloud\Instance3Bundle\Entity\Node $parent
     */
    public function setParent(\AltCloud\Instance3Bundle\Entity\Node $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return AltCloud\Instance3Bundle\Entity\Node 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set site
     *
     * @param AltCloud\Instance3Bundle\Entity\Site $site
     */
    public function setSite(\AltCloud\Instance3Bundle\Entity\Site $site)
    {
        $this->site = $site;
    }

    /**
     * Get site
     *
     * @return AltCloud\Instance3Bundle\Entity\Site 
     */
    public function getSite()
    {
        return $this->site;
    }
    
    /**
     * @var string $target_controller
     */
    private $target_controller;

    /**
     * Set target_controller
     *
     * @param string $targetController
     */
    public function setTargetController($targetController)
    {
    	$targetparams_array = explode(':',$targetController);
    	
        $this->target_entity = $targetparams_array[0].':'.$targetparams_array[1];
        $this->target_view = $targetparams_array[2];
    }

    /**
     * Get target_controller
     *
     * @return string 
     */
    public function getTargetController()
    {
    	if($this->target_entity && $this->target_entity != null)
	        return $this->target_entity.':'.$this->target_view;
	    else
	        return $this->target_view;
    }
    

    /**
     * Add children
     *
     * @param \AltCloud\Instance3Bundle\Entity\Node $children
     * @return Node
     */
    public function addChildren(\AltCloud\Instance3Bundle\Entity\Node $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \AltCloud\Instance3Bundle\Entity\Node $children
     */
    public function removeChildren(\AltCloud\Instance3Bundle\Entity\Node $children)
    {
        $this->children->removeElement($children);
    }
}