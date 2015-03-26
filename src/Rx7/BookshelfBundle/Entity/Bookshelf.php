<?php

namespace Rx7\BookshelfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bookshelf
 *
 * @ORM\Table(name="bookshelf")
 * @ORM\Entity(repositoryClass="Rx7\BookshelfBundle\Entity\BookshelfRepository")
 */
class Bookshelf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255)
     */
    private $localisation;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Rx7\BookshelfBundle\Entity\Shelf", mappedBy="bookshelf")
     */
    private $shelfs;

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
     * Set localisation
     *
     * @param string $localisation
     * @return Bookshelf
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string 
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Bookshelf
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Bookshelf
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Constructor
     */
    public function __construct()
    {
        $this->shelfs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add shelfs
     *
     * @param \Rx7\BookshelfBundle\Entity\Shelf $shelfs
     * @return Bookshelf
     */
    public function addShelf(\Rx7\BookshelfBundle\Entity\Shelf $shelfs)
    {
        $this->shelfs[] = $shelfs;

        return $this;
    }

    /**
     * Remove shelfs
     *
     * @param \Rx7\BookshelfBundle\Entity\Shelf $shelfs
     */
    public function removeShelf(\Rx7\BookshelfBundle\Entity\Shelf $shelfs)
    {
        $this->shelfs->removeElement($shelfs);
    }

    /**
     * Get shelfs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShelfs()
    {
        return $this->shelfs;
    }
    
    public function getNumberOfShelf()
    {
    	return count($this->shelfs);
    }
}
