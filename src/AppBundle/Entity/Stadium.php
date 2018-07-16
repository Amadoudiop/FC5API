<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AdminBundle\Entity\AbstractEntity;

/**
 * Stadium
 *
 * @ORM\Table(name="stadium")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DefaultRepository")
 */
class Stadium extends AbstractEntity
{
    public static $defaultFieldOrder = "name";
    public static $defaultDirOrder = "asc";
    public static $fieldsOrder = [
        'id',
        'name',
    ];
    public static $fieldsApi = [
        'id',
        'name',
        'currentCapacity',
        'maximumCapacity',
        'costPerGame',
    ];
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=125)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="current_capacity", type="integer", length=6)
     */
    private $currentCapacity;

    /**
     * @var int
     *
     * @ORM\Column(name="maximum_capacity", type="integer", length=6)
     */
    private $maximumCapacity;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_per_game", type="integer", length=6)
     */
    private $costPerGame;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Stadium
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
     * Set currentCapacity
     *
     * @param integer $currentCapacity
     *
     * @return Stadium
     */
    public function setCurrentCapacity($currentCapacity = 15000)
    {
        $this->currentCapacity = $currentCapacity;

        return $this;
    }

    /**
     * Get currentCapacity
     *
     * @return int
     */
    public function getCurrentCapacity()
    {
        return $this->currentCapacity;
    }

    /**
     * Set maximumCapacity
     *
     * @param integer $maximumCapacity
     *
     * @return Stadium
     */
    public function setMaximumCapacity($maximumCapacity = 60000)
    {
        $this->maximumCapacity = $maximumCapacity;

        return $this;
    }

    /**
     * Get maximumCapacity
     *
     * @return int
     */
    public function getMaximumCapacity()
    {
        return $this->maximumCapacity;
    }

    /**
     * Set costPerGame.
     *
     * @param int $costPerGame
     *
     * @return Stadium
     */
    public function setCostPerGame($costPerGame = 60)
    {
        $this->costPerGame = $costPerGame;

        return $this;
    }

    /**
     * Get costPerGame.
     *
     * @return int
     */
    public function getCostPerGame()
    {
        return $this->costPerGame;
    }

    /**
     * Set club.
     *
     * @param \AppBundle\Entity\Stadium|null $club
     *
     * @return Stadium
     */
    public function setClub(\AppBundle\Entity\Stadium $club = null)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club.
     *
     * @return \AppBundle\Entity\Stadium|null
     */
    public function getClub()
    {
        return $this->club;
    }
}
