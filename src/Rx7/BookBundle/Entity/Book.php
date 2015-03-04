<?php

namespace Rx7\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Book
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Rx7\BookBundle\Entity\BookRepository")
 */
class Book
{
	/**
	 * @ORM\OneToOne(targetEntity="Rx7\BookBundle\Entity\Image", cascade={"persist", "remove"})
	 */
	private $cover;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Rx7\BookBundle\Entity\Author", inversedBy="books")
	 * @ORM\JoinColumn(nullable=false)
	 * @Assert\Valid()
	 */
	private $author;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Rx7\BookBundle\Entity\Category", cascade={"persist"})
	 */
	private $categories;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchasedate", type="datetime")
     * @Assert\DateTime()
     */
    private $purchaseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\Length(
     * 		min = "3")
     */
    private $title;


    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @ORM\Column(name="bookRead", type="boolean")
     */
    private $bookRead;

    
    
    public function __construct()
    {
    	$this->purchaseDate = new \Datetime();
    	$this->bookRead = false;
    	$this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Set text
     *
     * @param string $text
     * @return Book
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set purchaseDate
     *
     * @param \DateTime $purchaseDate
     * @return Book
     */
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    /**
     * Get purchaseDate
     *
     * @return \DateTime 
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * Set bookRead
     *
     * @param boolean $bookRead
     * @return Book
     */
    public function setBookRead($bookRead)
    {
        $this->bookRead = $bookRead;

        return $this;
    }

    /**
     * Get bookRead
     *
     * @return boolean 
     */
    public function getBookRead()
    {
        return $this->bookRead;
    }

    /**
     * Set cover
     *
     * @param \Rx7\BookBundle\Entity\Image $cover
     * @return Book
     */
    public function setCover(\Rx7\BookBundle\Entity\Image $cover = null)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return \Rx7\BookBundle\Entity\Image 
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set author
     *
     * @param \Rx7\BookBundle\Entity\Author $author
     * @return Book
     */
    public function setAuthor(\Rx7\BookBundle\Entity\Author $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Rx7\BookBundle\Entity\Author 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add category
     *
     * @param \Rx7\BookBundle\Entity\Category $category
     * @return Book
     */
    public function addCategory(\Rx7\BookBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Rx7\BookBundle\Entity\Category $category
     */
    public function removeCategory(\Rx7\BookBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
