<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerSPEStats
 *
 * @ORM\Table(name="player_s_p_e_stats")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerSPEStatsRepository")
 */
class PlayerSPEStats
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
     * @var int
     *
     * @ORM\Column(name="acceleration", type="integer", length=3)
     */
    private $acceleration;

    /**
     * @var int
     *
     * @ORM\Column(name="aggression", type="integer", length=3)
     */
    private $aggression;

    /**
     * @var int
     *
     * @ORM\Column(name="agility", type="integer", length=3)
     */
    private $agility;

    /**
     * @var int
     *
     * @ORM\Column(name="balance", type="integer", length=3)
     */
    private $balance;

    /**
     * @var int
     *
     * @ORM\Column(name="freekick_accuracy", type="integer", length=3)
     */
    private $freekick_accuracy;

    /**
     * @var int
     *
     * @ORM\Column(name="short_passing", type="integer", length=3)
     */
    private $short_passing;

    /**
     * @var int
     *
     * @ORM\Column(name="sprint_speed", type="integer", length=3)
     */
    private $sprint_speed;

    /**
     * @var int
     *
     * @ORM\Column(name="long_passing", type="integer", length=3)
     */
    private $long_passing;

    /**
     * @var int
     *
     * @ORM\Column(name="positioning", type="integer", length=3)
     */
    private $positioning;

    /**
     * @var int
     *
     * @ORM\Column(name="vision", type="integer", length=3)
     */
    private $vision;


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
     * Set acceleration
     *
     * @param integer $acceleration
     *
     * @return PlayerSPEStats
     */
    public function setAcceleration($acceleration)
    {
        $this->acceleration = $acceleration;

        return $this;
    }

    /**
     * Get acceleration
     *
     * @return integer
     */
    public function getAcceleration()
    {
        return $this->acceleration;
    }

    /**
     * Set aggression
     *
     * @param integer $aggression
     *
     * @return PlayerSPEStats
     */
    public function setAggression($aggression)
    {
        $this->aggression = $aggression;

        return $this;
    }

    /**
     * Get aggression
     *
     * @return integer
     */
    public function getAggression()
    {
        return $this->aggression;
    }

    /**
     * Set agility
     *
     * @param integer $agility
     *
     * @return PlayerSPEStats
     */
    public function setAgility($agility)
    {
        $this->agility = $agility;

        return $this;
    }

    /**
     * Get agility
     *
     * @return integer
     */
    public function getAgility()
    {
        return $this->agility;
    }

    /**
     * Set balance
     *
     * @param integer $balance
     *
     * @return PlayerSPEStats
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return integer
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set freekickAccuracy
     *
     * @param integer $freekickAccuracy
     *
     * @return PlayerSPEStats
     */
    public function setFreekickAccuracy($freekickAccuracy)
    {
        $this->freekick_accuracy = $freekickAccuracy;

        return $this;
    }

    /**
     * Get freekickAccuracy
     *
     * @return integer
     */
    public function getFreekickAccuracy()
    {
        return $this->freekick_accuracy;
    }

    /**
     * Set shortPassing
     *
     * @param integer $shortPassing
     *
     * @return PlayerSPEStats
     */
    public function setShortPassing($shortPassing)
    {
        $this->short_passing = $shortPassing;

        return $this;
    }

    /**
     * Get shortPassing
     *
     * @return integer
     */
    public function getShortPassing()
    {
        return $this->short_passing;
    }

    /**
     * Set sprintSpeed
     *
     * @param integer $sprintSpeed
     *
     * @return PlayerSPEStats
     */
    public function setSprintSpeed($sprintSpeed)
    {
        $this->sprint_speed = $sprintSpeed;

        return $this;
    }

    /**
     * Get sprintSpeed
     *
     * @return integer
     */
    public function getSprintSpeed()
    {
        return $this->sprint_speed;
    }

    /**
     * Set longPassing
     *
     * @param integer $longPassing
     *
     * @return PlayerSPEStats
     */
    public function setLongPassing($longPassing)
    {
        $this->long_passing = $longPassing;

        return $this;
    }

    /**
     * Get longPassing
     *
     * @return integer
     */
    public function getLongPassing()
    {
        return $this->long_passing;
    }

    /**
     * Set positioning
     *
     * @param integer $positioning
     *
     * @return PlayerSPEStats
     */
    public function setPositioning($positioning)
    {
        $this->positioning = $positioning;

        return $this;
    }

    /**
     * Get positioning
     *
     * @return integer
     */
    public function getPositioning()
    {
        return $this->positioning;
    }

    /**
     * Set vision
     *
     * @param integer $vision
     *
     * @return PlayerSPEStats
     */
    public function setVision($vision)
    {
        $this->vision = $vision;

        return $this;
    }

    /**
     * Get vision
     *
     * @return integer
     */
    public function getVision()
    {
        return $this->vision;
    }
}
