<?php

namespace AdminBundle\Service;

/**
 * Service handling pagination from request
 */

/**
 * Class SimpleStats
 * @package AdminBundle\Service
 */
class SimpleStats
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * @param $player
     * @return array
     */
    public function simpleStats($player)
    {
        $atkStat = (int)$this->calculATK($player->getPlayerATKStats());
        $defStat = (int)$this->calculDEF($player->getPlayerDEFStats());
        $speStat = (int)$this->calculSPE($player->getPlayerSPEStats());

        return [
            'ATK' => $atkStat,
            'DEF' => $defStat,
            'SPE' => $speStat,
        ];
    }

    /**
     * @param $stats
     * @return float|int
     */
    private function calculATK($stats)
    {
        return ($stats->getBallControl()
                + $stats->getCrossing()
                + $stats->getCurve()
                + $stats->getDribbling()
                + $stats->getFinishing()
                + $stats->getShotpower()
                + $stats->getPenalties()) / 7;
    }

    /**
     * @param $stats
     * @return float|int
     */
    private function calculDEF($stats)
    {
        return ($stats->getHeadingAccuracy()
                + $stats->getInterceptions()
                + $stats->getJumping()
                + $stats->getMarking()
                + $stats->getReactions()
                + $stats->getSlidingTackle()
                + $stats->getStandingTackle()
                + $stats->getStrength()
                + $stats->getStamina()) / 9;
    }

    /**
     * @param $stats
     * @return float|int
     */
    private function calculSPE($stats)
    {
        return ($stats->getAcceleration()
                + $stats->getAgility()
                + $stats->getBalance()
                + $stats->getFreeKickAccuracy()
                + $stats->getShortPassing()
                + $stats->getLongPassing()
                + $stats->getPositioning()
                + $stats->getVision()) / 8;
    }
}
