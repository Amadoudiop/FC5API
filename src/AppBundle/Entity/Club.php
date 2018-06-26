<?php

namespace AppBundle\Entity;

use AdminBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DefaultRepository")
 */
class Club extends AbstractEntity
{
    public static $defaultFieldOrder = "name";
    public static $defaultDirOrder = "asc";
    public static $fieldsOrder = [
        'id',
        'name',
        'shortName'
    ];
    public static $fieldsApi = [
        'id',
        'name',
        'shortName',
        'owner',
        'blazon',
        'jerseys',
        'clubStats',
        'stadium'
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
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=125)
     */
    private $shortName;

    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=125)
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="blazon", type="string", length=255)
     */
    private $blazon;

    /**
     * One Club have Many Jersey.
     * @ORM\OneToMany(targetEntity="Jersey", mappedBy="club")
     */
    private $jerseys;

    /**
     * One Club has Many ClubStat.
     * @ORM\OneToMany(targetEntity="ClubStat", mappedBy="club")
     */
    private $clubStats;

    /**
     * One Club has One Stadium.
     * @ORM\OneToOne(targetEntity="Stadium", mappedBy="club")
     */
    private $stadium;


    public function __construct()
    {
        $this->clubStats = new ArrayCollection();
        $this->jerseys = new ArrayCollection();
    }

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
     * @return Club
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
     * Set blazon
     *
     * @param string $blazon
     *
     * @return Club
     */
    public function setBlazon($blazon)
    {
        $this->blazon = $blazon;

        return $this;
    }

    /**
     * Get blazon
     *
     * @return string
     */
    public function getBlazon()
    {
        return $this->blazon;
    }

    /**
     * Add clubStat
     *
     * @param \AppBundle\Entity\ClubStat $clubStat
     *
     * @return Club
     */
    public function addClubStat(\AppBundle\Entity\ClubStat $clubStat)
    {
        $this->clubStats[] = $clubStat;

        return $this;
    }

    /**
     * Remove clubStat
     *
     * @param \AppBundle\Entity\ClubStat $clubStat
     */
    public function removeClubStat(\AppBundle\Entity\ClubStat $clubStat)
    {
        $this->clubStats->removeElement($clubStat);
    }

    /**
     * Get clubStats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClubStats()
    {
        return $this->clubStats;
    }

    /**
     * Set shortName.
     *
     * @param string $shortName
     *
     * @return Club
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName.
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set owner.
     *
     * @param string $owner
     *
     * @return Club
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner.
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add jersey.
     *
     * @param \AppBundle\Entity\Jersey $jersey
     *
     * @return Club
     */
    public function addJersey(\AppBundle\Entity\Jersey $jersey)
    {
        $this->jerseys[] = $jersey;

        return $this;
    }

    /**
     * Remove jersey.
     *
     * @param \AppBundle\Entity\Jersey $jersey
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeJersey(\AppBundle\Entity\Jersey $jersey)
    {
        return $this->jerseys->removeElement($jersey);
    }

    /**
     * Get jerseys.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJerseys()
    {
        return $this->jerseys;
    }

    /**
     * Set stadium.
     *
     * @param \AppBundle\Entity\Stadium|null $stadium
     *
     * @return Club
     */
    public function setStadium(\AppBundle\Entity\Stadium $stadium = null)
    {
        $this->stadium = $stadium;

        return $this;
    }

    /**
     * Get stadium.
     *
     * @return \AppBundle\Entity\Stadium|null
     */
    public function getStadium()
    {
        return $this->stadium;
    }
}
