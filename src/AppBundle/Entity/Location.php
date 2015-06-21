<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(
     *      targetEntity="Book",
     *      mappedBy="location",
     *      orphanRemoval=true
     * )
     * @ORM\OrderBy({"title" = "ASC"})
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getBooks()
    {
        return $this->books;
    }

    public function addBook(Book $book)
    {
        $this->books->add($book);
        $book->setLocation($this);
    }

    public function removeBook(Book $book)
    {
        $this->books->removeElement($book);
        $book->setLocation(null);
    }
}
