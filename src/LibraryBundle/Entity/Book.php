<?php

namespace LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * @ORM\Entity(repositoryClass="BookRepository")
 * @ORM\HasLifecycleCallbacks
 * @GRID\Source(filterable=false)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @GRID\Column(primary=true, visible=false)
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="LibraryBundle\Entity\Author",
     *     inversedBy="books",
     *     cascade={"persist"}
     * )
     * @GRID\Column(field="author.lastName", title="Author", filterable=true, operatorsVisible=false)
     *
     * @var Author
     */
    protected $author;

    /**
     * @ORM\Column(type="string", length=128, unique=true)
     * @Assert\NotBlank()
     * @Assert\LessThanOrEqual(128)
     * @GRID\Column(filterable=true, operatorsVisible=false, title="Title")
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="text", length=1000)
     * @Assert\NotBlank()
     * @Assert\LessThanOrEqual(1000)
     * @GRID\Column(visible=false)
     *
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     * @GRID\Column(title="Added",format="d/m/Y (H:i:s)")
     *
     * @var \DateTime
     */
    private $created;

    public function __toString()
    {
        return sprintf("%s by %s", $this->title, $this->author);
    }

    /**
     * Установить дату создания, если она не задана
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        if (!$this->created) {
            $this->created = new \DateTime('now');
        }
    }

    /**
     * Установить дату создания, если она не задана
     *
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->onPreUpdate();
    }

    /**
     * Set title
     *
     * @param string $title
     *
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
     * Set description
     *
     * @param string $description
     *
     * @return Book
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set author
     *
     * @param Author $author
     *
     * @return Book
     */
    public function setAuthor(Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
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

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

}
