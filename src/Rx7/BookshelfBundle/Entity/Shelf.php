<?php

namespace Rx7\BookshelfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shelf
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Rx7\BookshelfBundle\Entity\ShelfRepository")
 */
class Shelf
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
     * @ORM\ManyToOne(targetEntity="Rx7\BookshelfBundle\Entity\Bookshelf", inversedBy="shelfs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bookshelf;
    
    /**
     * @ORM\OneToMany(targetEntity="Rx7\BookBundle\Entity\Book", mappedBy="shelf")
     */
    private $books;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;


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
     * Set position
     *
     * @param integer $position
     * @return Shelf
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
     * Set bookshelf
     *
     * @param \Rx7\BookshelfBundle\Entity\Bookshelf $bookshelf
     * @return Shelf
     */
    public function setBookshelf(\Rx7\BookshelfBundle\Entity\Bookshelf $bookshelf)
    {
        $this->bookshelf = $bookshelf;

        return $this;
    }

    /**
     * Get bookshelf
     *
     * @return \Rx7\BookshelfBundle\Entity\Bookshelf 
     */
    public function getBookshelf()
    {
        return $this->bookshelf;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add books
     *
     * @param \Rx7\BookBundle\Entity\Book $books
     * @return Shelf
     */
    public function addBook(\Rx7\BookBundle\Entity\Book $books)
    {
        $this->books[] = $books;

        return $this;
    }

    /**
     * Remove books
     *
     * @param \Rx7\BookBundle\Entity\Book $books
     */
    public function removeBook(\Rx7\BookBundle\Entity\Book $books)
    {
        $this->books->removeElement($books);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBooks()
    {
        return $this->books;
    }
}
