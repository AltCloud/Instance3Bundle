<?php

namespace AltCloud\Instance3Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AltCloud\Instance3Bundle\Entity\Site
 */
class Site
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var string $deftemp
     */
    private $deftemp;

    protected $nodes;

    public function __construct()
    {
        $this->nodes = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set deftemp
     *
     * @param string $deftemp
     */
    public function setDeftemp($deftemp)
    {
        $this->deftemp = $deftemp;
    }

    /**
     * Get deftemp
     *
     * @return string 
     */
    public function getDeftemp()
    {
        return $this->deftemp;
    }

    /**
     * Add nodes
     *
     * @param AltCloud\Instance3Bundle\Entity\Node $nodes
     */
    public function addNode(\AltCloud\Instance3Bundle\Entity\Node $nodes)
    {
        $this->nodes[] = $nodes;
    }

    /**
     * Get nodes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getNodes()
    {
        return $this->nodes;
    }
    /**
     * @var AltCloud\Instance3Bundle\Entity\Node
     */
    private $entrynode;


    /**
     * Set entrynode
     *
     * @param AltCloud\Instance3Bundle\Entity\Node $entrynode
     */
    public function setEntrynode(\AltCloud\Instance3Bundle\Entity\Node $entrynode)
    {
        $this->entrynode = $entrynode;
    }

    /**
     * Get entrynode
     *
     * @return AltCloud\Instance3Bundle\Entity\Node 
     */
    public function getEntrynode()
    {
        return $this->entrynode;
    }
}