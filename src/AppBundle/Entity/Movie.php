<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="synoptic", type="text", nullable=false)
     */
    private $synoptic;

    /**
     * @var \DateTime
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Person")
     * @ORM\JoinTable(name="movie_actors",
     *      joinColumns={@ORM\JoinColumn(name="movie_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")}
     *      )
     **/
    private $actors;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Person")
     * @ORM\JoinTable(name="movie_directors",
     *      joinColumns={@ORM\JoinColumn(name="movie_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")}
     *      )
     **/
    private $directors;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->directors = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSynoptic()
    {
        return $this->synoptic;
    }

    /**
     * @param string $synoptic
     *
     * @return $this
     */
    public function setSynoptic($synoptic)
    {
        $this->synoptic = $synoptic;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTime $publishedAt
     *
     * @return $this
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param Person $actor
     *
     * @return $this
     */
    public function addActor(Person $actor)
    {
        $this->actors->add($actor);

        return $this;
    }

    /**
     * @param Person $actor
     *
     * @return $this
     */
    public function removeActor(Person $actor)
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * @param Person $director
     *
     * @return $this
     */
    public function addDirector(Person $director)
    {
        $this->directors->add($director);

        return $this;
    }

    /**
     * @param Person $director
     *
     * @return $this
     */
    public function removeDirector(Person $director)
    {
        $this->directors->removeElement($director);

        return $this;
    }
}
