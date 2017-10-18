<?php

namespace LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * @ORM\Entity
 * GRID\Source(filterable=false)
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @GRID\Column(primary=true, visible=false)
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     * @GRID\Column(filterable=true, operatorsVisible=false, title="First Name")
     *
     * @var string
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     * @GRID\Column(filterable=true, operatorsVisible=false, title="Last Name")
     *
     * @var string
     */
    private $lastName;

    /**
     * @ORM\OneToMany(
     *     targetEntity="LibraryBundle\Entity\Book",
     *     cascade={"persist"},
     *     mappedBy="author",
     *     orphanRemoval=true
     * )
     * GRID\Column(visible=false, filterable=false)
     *
     * @var ArrayCollection
     */
    private $books;

    protected $shortenedName;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getShortenedName();
    }

    public function getShortenedName()
    {
        return sprintf("%s. %s", $this->firstName[0], $this->lastName);
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Author
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Author
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Add book
     *
     * @param Book $book
     *
     * @return Author
     */
    public function addBook(Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param Book $book
     */
    public function removeBook(Book $book)
    {
        $this->books->removeElement($book);
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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}
