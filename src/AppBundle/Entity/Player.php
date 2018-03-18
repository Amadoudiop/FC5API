<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerRepository")
 */
class Player
{
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
     * @ORM\Column(name="common_name", type="string", length=125)
     */
    private $commonName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=125)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=125)
     */
    private $firstName;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer", length=3)
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer", length=3)
     */
    private $weight;

    /**
     * @var int
     *
     * @ORM\Column(name="birth_date", type="string", length=10)
     */
    private $birthDate;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", length=3)
     */
    private $age;

    /**
     * @var int
     *
     * @ORM\Column(name="foot", type="string", length=10)
     */
    private $foot;

    /**
     * @var int
     *
     * @ORM\Column(name="weak_foot", type="integer", length=3)
     */
    private $weakFoot;

    /**
     * @var int
     *
     * @ORM\Column(name="is_gk", type="boolean")
     */
    private $isGK;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="real_club", type="string", length=125, nullable=true)
     */
    private $realClub;

    /**
     * @var integer
     *
     * @ORM\Column(name="composure", type="integer", length=3)
     */
    private $composure;

    /**
     * @var integer
     *
     * @ORM\Column(name="potential", type="integer", length=3)
     */
    private $potential;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", length=3)
     */
    private $rating;

    /**
     * Many Players have Many PlayerPostions.
     * @ORM\ManyToMany(targetEntity="PlayerPosition", inversedBy="players")
     * @ORM\JoinTable(name="players_postions")
     */
    private $positions;

    /**
     * Many Players have one Nationality.
     * @ORM\ManyToOne(targetEntity="Nationality", inversedBy="players")
     * @ORM\JoinColumn(name="nationality_id", referencedColumnName="id")
     */
    private $nationality;

    /**
     * One Player has One PlayerATKStats.
     * @ORM\OneToOne(targetEntity="PlayerATKStats")
     * @ORM\JoinColumn(name="player_atk_stats_id", referencedColumnName="id")
     */
    private $playerATKStats;

    /**
     * One Player has One PlayerSPEStats.
     * @ORM\OneToOne(targetEntity="PlayerSPEStats")
     * @ORM\JoinColumn(name="player_spe_stats_id", referencedColumnName="id")
     */
    private $playerSPEStats;

    /**
     * One Player has One PlayerDEFStats.
     * @ORM\OneToOne(targetEntity="PlayerDEFStats")
     * @ORM\JoinColumn(name="player_def_stats_id", referencedColumnName="id")
     */
    private $playerDEFStats;

    /**
     * One Player has One PlayerGKStats.
     * @ORM\OneToOne(targetEntity="PlayerGKStats")
     * @ORM\JoinColumn(name="player_gk_stats_id", referencedColumnName="id")
     */
    private $playerGKStats;


    public function __construct()
    {
        $this->positions = new ArrayCollection();
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
     * Set commonName
     *
     * @param string $commonName
     *
     * @return Player
     */
    public function setCommonName($commonName)
    {
        $this->commonName = $commonName;

        return $this;
    }

    /**
     * Get commonName
     *
     * @return string
     */
    public function getCommonName()
    {
        return $this->commonName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Player
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Player
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
     * Set height
     *
     * @param integer $height
     *
     * @return Player
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Player
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set birthDate
     *
     * @param string $birthDate
     *
     * @return Player
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Player
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set foot
     *
     * @param string $foot
     *
     * @return Player
     */
    public function setFoot($foot)
    {
        $this->foot = $foot;

        return $this;
    }

    /**
     * Get foot
     *
     * @return string
     */
    public function getFoot()
    {
        return $this->foot;
    }

    /**
     * Set weakFoot
     *
     * @param integer $weakFoot
     *
     * @return Player
     */
    public function setWeakFoot($weakFoot)
    {
        $this->weakFoot = $weakFoot;

        return $this;
    }

    /**
     * Get weakFoot
     *
     * @return integer
     */
    public function getWeakFoot()
    {
        return $this->weakFoot;
    }

    /**
     * Set isGK
     *
     * @param boolean $isGK
     *
     * @return Player
     */
    public function setIsGK($isGK)
    {
        $this->isGK = $isGK;

        return $this;
    }

    /**
     * Get isGK
     *
     * @return boolean
     */
    public function getIsGK()
    {
        return $this->isGK;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Player
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set realClub
     *
     * @param string $realClub
     *
     * @return Player
     */
    public function setRealClub($realClub)
    {
        $this->realClub = $realClub;

        return $this;
    }

    /**
     * Get realClub
     *
     * @return string
     */
    public function getRealClub()
    {
        return $this->realClub;
    }

    /**
     * Add position
     *
     * @param \AppBundle\Entity\PlayerPosition $position
     *
     * @return Player
     */
    public function addPosition(\AppBundle\Entity\PlayerPosition $position)
    {
        $this->positions[] = $position;

        return $this;
    }

    /**
     * Remove position
     *
     * @param \AppBundle\Entity\PlayerPosition $position
     */
    public function removePosition(\AppBundle\Entity\PlayerPosition $position)
    {
        $this->positions->removeElement($position);
    }

    /**
     * Get positions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * Set nationality
     *
     * @param \AppBundle\Entity\Nationality $nationality
     *
     * @return Player
     */
    public function setNationality(\AppBundle\Entity\Nationality $nationality = null)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return \AppBundle\Entity\Nationality
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set playerATKStats
     *
     * @param \AppBundle\Entity\PlayerATKStats $playerATKStats
     *
     * @return Player
     */
    public function setPlayerATKStats(\AppBundle\Entity\PlayerATKStats $playerATKStats = null)
    {
        $this->playerATKStats = $playerATKStats;

        return $this;
    }

    /**
     * Get playerATKStats
     *
     * @return \AppBundle\Entity\PlayerATKStats
     */
    public function getPlayerATKStats()
    {
        return $this->playerATKStats;
    }

    /**
     * Set playerSPEStats
     *
     * @param \AppBundle\Entity\PlayerSPEStats $playerSPEStats
     *
     * @return Player
     */
    public function setPlayerSPEStats(\AppBundle\Entity\PlayerSPEStats $playerSPEStats = null)
    {
        $this->playerSPEStats = $playerSPEStats;

        return $this;
    }

    /**
     * Get playerSPEStats
     *
     * @return \AppBundle\Entity\PlayerSPEStats
     */
    public function getPlayerSPEStats()
    {
        return $this->playerSPEStats;
    }

    /**
     * Set playerDEFStats
     *
     * @param \AppBundle\Entity\PlayerDEFStats $playerDEFStats
     *
     * @return Player
     */
    public function setPlayerDEFStats(\AppBundle\Entity\PlayerDEFStats $playerDEFStats = null)
    {
        $this->playerDEFStats = $playerDEFStats;

        return $this;
    }

    /**
     * Get playerDEFStats
     *
     * @return \AppBundle\Entity\PlayerDEFStats
     */
    public function getPlayerDEFStats()
    {
        return $this->playerDEFStats;
    }

    /**
     * Set playerGKStats
     *
     * @param \AppBundle\Entity\PlayerGKStats $playerGKStats
     *
     * @return Player
     */
    public function setPlayerGKStats(\AppBundle\Entity\PlayerGKStats $playerGKStats = null)
    {
        $this->playerGKStats = $playerGKStats;

        return $this;
    }

    /**
     * Get playerGKStats
     *
     * @return \AppBundle\Entity\PlayerGKStats
     */
    public function getPlayerGKStats()
    {
        return $this->playerGKStats;
    }

    /**
     * Set composure
     *
     * @param integer $composure
     *
     * @return Player
     */
    public function setComposure($composure)
    {
        $this->composure = $composure;

        return $this;
    }

    /**
     * Get composure
     *
     * @return integer
     */
    public function getComposure()
    {
        return $this->composure;
    }

    /**
     * Set potential
     *
     * @param integer $potential
     *
     * @return Player
     */
    public function setPotential($potential)
    {
        $this->potential = $potential;

        return $this;
    }

    /**
     * Get potential
     *
     * @return integer
     */
    public function getPotential()
    {
        return $this->potential;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Player
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }
}
