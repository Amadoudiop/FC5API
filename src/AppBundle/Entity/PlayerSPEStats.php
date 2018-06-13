<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AdminBundle\Entity\AbstractEntity;

/**
 * PlayerSPEStats
 *
 * @ORM\Table(name="player_s_p_e_stats")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerSPEStatsRepository")
 */
class PlayerSPEStats extends AbstractEntity
{
    public static $fieldsApi = [
        'acceleration',
        'agility',
        'balance',
        'freeKickAccuracy',
        'shortPassing',
        'longPassing',
        'positioning',
        'vision'
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
     * @ORM\Column(name="free_kick_accuracy", type="integer", length=3)
     */
    private $freeKickAccuracy;

    /**
     * @var int
     *
     * @ORM\Column(name="short_passing", type="integer", length=3)
     */
    private $shortPassing;

    /**
     * @var int
     *
     * @ORM\Column(name="sprint_speed", type="integer", length=3)
     */
    private $sprintSpeed;

    /**
     * @var int
     *
     * @ORM\Column(name="long_passing", type="integer", length=3)
     */
    private $longPassing;

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
     * Set freeKickAccuracy
     *
     * @param integer $freeKickAccuracy
     *
     * @return PlayerSPEStats
     */
    public function setFreeKickAccuracy($freeKickAccuracy)
    {
        $this->freeKickAccuracy = $freeKickAccuracy;

        return $this;
    }

    /**
     * Get freeKickAccuracy
     *
     * @return integer
     */
    public function getFreeKickAccuracy()
    {
        return $this->freeKickAccuracy;
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
        $this->shortPassing = $shortPassing;

        return $this;
    }

    /**
     * Get shortPassing
     *
     * @return integer
     */
    public function getShortPassing()
    {
        return $this->shortPassing;
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
        $this->sprintSpeed = $sprintSpeed;

        return $this;
    }

    /**
     * Get sprintSpeed
     *
     * @return integer
     */
    public function getSprintSpeed()
    {
        return $this->sprintSpeed;
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
        $this->longPassing = $longPassing;

        return $this;
    }

    /**
     * Get longPassing
     *
     * @return integer
     */
    public function getLongPassing()
    {
        return $this->longPassing;
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
