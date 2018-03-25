<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerATKStats
 *
 * @ORM\Table(name="player_a_t_k_stats")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerATKStatsRepository")
 */
class PlayerATKStats
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
     * @ORM\Column(name="ball_control", type="integer", length=3)
     */
    private $ball_control;

    /**
     * @var int
     *
     * @ORM\Column(name="crossing", type="integer", length=3)
     */
    private $crossing;

    /**
     * @var int
     *
     * @ORM\Column(name="curve", type="integer", length=3)
     */
    private $curve;

    /**
     * @var int
     *
     * @ORM\Column(name="dribbling", type="integer", length=3)
     */
    private $dribbling;

    /**
     * @var int
     *
     * @ORM\Column(name="finishing", type="integer", length=3)
     */
    private $finishing;

    /**
     * @var int
     *
     * @ORM\Column(name="volleys", type="integer", length=3)
     */
    private $volleys;

    /**
     * @var int
     *
     * @ORM\Column(name="shotpower", type="integer", length=3)
     */
    private $shotpower;

    /**
     * @var int
     *
     * @ORM\Column(name="longshots", type="integer", length=3)
     */
    private $longshots;

    /**
     * @var int
     *
     * @ORM\Column(name="penalties", type="integer", length=3)
     */
    private $penalties;


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
     * Set ballControl
     *
     * @param integer $ballControl
     *
     * @return PlayerATKStats
     */
    public function setBallControl($ballControl)
    {
        $this->ball_control = $ballControl;

        return $this;
    }

    /**
     * Get ballControl
     *
     * @return integer
     */
    public function getBallControl()
    {
        return $this->ball_control;
    }

    /**
     * Set crossing
     *
     * @param integer $crossing
     *
     * @return PlayerATKStats
     */
    public function setCrossing($crossing)
    {
        $this->crossing = $crossing;

        return $this;
    }

    /**
     * Get crossing
     *
     * @return integer
     */
    public function getCrossing()
    {
        return $this->crossing;
    }

    /**
     * Set curve
     *
     * @param integer $curve
     *
     * @return PlayerATKStats
     */
    public function setCurve($curve)
    {
        $this->curve = $curve;

        return $this;
    }

    /**
     * Get curve
     *
     * @return integer
     */
    public function getCurve()
    {
        return $this->curve;
    }

    /**
     * Set dribbling
     *
     * @param integer $dribbling
     *
     * @return PlayerATKStats
     */
    public function setDribbling($dribbling)
    {
        $this->dribbling = $dribbling;

        return $this;
    }

    /**
     * Get dribbling
     *
     * @return integer
     */
    public function getDribbling()
    {
        return $this->dribbling;
    }

    /**
     * Set finishing
     *
     * @param integer $finishing
     *
     * @return PlayerATKStats
     */
    public function setFinishing($finishing)
    {
        $this->finishing = $finishing;

        return $this;
    }

    /**
     * Get finishing
     *
     * @return integer
     */
    public function getFinishing()
    {
        return $this->finishing;
    }

    /**
     * Set volleys
     *
     * @param integer $volleys
     *
     * @return PlayerATKStats
     */
    public function setVolleys($volleys)
    {
        $this->volleys = $volleys;

        return $this;
    }

    /**
     * Get volleys
     *
     * @return integer
     */
    public function getVolleys()
    {
        return $this->volleys;
    }

    /**
     * Set shotpower
     *
     * @param integer $shotpower
     *
     * @return PlayerATKStats
     */
    public function setShotpower($shotpower)
    {
        $this->shotpower = $shotpower;

        return $this;
    }

    /**
     * Get shotpower
     *
     * @return integer
     */
    public function getShotpower()
    {
        return $this->shotpower;
    }

    /**
     * Set longshots
     *
     * @param integer $longshots
     *
     * @return PlayerATKStats
     */
    public function setLongshots($longshots)
    {
        $this->longshots = $longshots;

        return $this;
    }

    /**
     * Get longshots
     *
     * @return integer
     */
    public function getLongshots()
    {
        return $this->longshots;
    }

    /**
     * Set penalties
     *
     * @param integer $penalties
     *
     * @return PlayerATKStats
     */
    public function setPenalties($penalties)
    {
        $this->penalties = $penalties;

        return $this;
    }

    /**
     * Get penalties
     *
     * @return integer
     */
    public function getPenalties()
    {
        return $this->penalties;
    }
}
