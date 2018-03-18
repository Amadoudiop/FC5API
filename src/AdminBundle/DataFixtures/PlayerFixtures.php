<?php

namespace AdminBundle\DataFixtures;

use AppBundle\Entity\Player;
use AppBundle\Entity\PlayerATKStats;
use AppBundle\Entity\PlayerDEFStats;
use AppBundle\Entity\PlayerSPEStats;
use AppBundle\Entity\PlayerGKStats;
use AppBundle\Entity\PlayerStat;
use AppBundle\Entity\Nationality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PlayerFixtures extends Fixture
{
    protected $kernel;
    private $uTeam;


    public function __construct($kernel, $uTeam)
    {
        $this->kernel = $kernel;
        $this->uTeam = $uTeam;
    }

    public function load(ObjectManager $manager)
    {
        $nbPages = 422;
        $nbGKPages = 76;

        for($i=1; $i<=$nbPages; $i++){
            dump($i);
            $dataPlayers = $this->uTeam->getPlayers($i);

            foreach ($dataPlayers as $dataPlayer) {
                $atkStats = new PlayerATKStats();
                $atkStats->setBallControl($dataPlayer->ballcontrol);
                $atkStats->setCrossing($dataPlayer->crossing);
                $atkStats->setCurve($dataPlayer->curve);
                $atkStats->setDribbling($dataPlayer->dribbling);
                $atkStats->setFinishing($dataPlayer->finishing);
                $atkStats->setVolleys($dataPlayer->volleys);
                $atkStats->setShotpower($dataPlayer->shotpower);
                $atkStats->setLongshots($dataPlayer->longshots);
                $atkStats->setPenalties($dataPlayer->penalties);

                $defStats = new PlayerDEFStats();
                $defStats->setHeadingAccuracy($dataPlayer->headingaccuracy);
                $defStats->setInterceptions($dataPlayer->interceptions);
                $defStats->setJumping($dataPlayer->jumping);
                $defStats->setMarking($dataPlayer->marking);
                $defStats->setReactions($dataPlayer->reactions);
                $defStats->setSlidingTackle($dataPlayer->slidingtackle);
                $defStats->setStandingTackle($dataPlayer->standingtackle);
                $defStats->setStrength($dataPlayer->strength);
                $defStats->setStamina($dataPlayer->stamina);

                $speStats = new PlayerSPEStats();
                $speStats->setAcceleration($dataPlayer->acceleration);
                $speStats->setAggression($dataPlayer->aggression);
                $speStats->setAgility($dataPlayer->agility);
                $speStats->setBalance($dataPlayer->balance);
                $speStats->setFreekickAccuracy($dataPlayer->freekickaccuracy);
                $speStats->setShortPassing($dataPlayer->shortpassing);
                $speStats->setSprintSpeed($dataPlayer->sprintspeed);
                $speStats->setLongPassing($dataPlayer->longpassing);
                $speStats->setPositioning($dataPlayer->positioning);
                $speStats->setVision($dataPlayer->vision);

                $gkStats = new PlayerGKStats();
                $gkStats->setDiving($dataPlayer->gkdiving);
                $gkStats->setHandling($dataPlayer->gkhandling);
                $gkStats->setKicking($dataPlayer->gkkicking);
                $gkStats->setPositioning($dataPlayer->gkpositioning);
                $gkStats->setReflexes($dataPlayer->gkreflexes);

                $manager->persist($atkStats);
                $manager->persist($defStats);
                $manager->persist($speStats);
                $manager->persist($gkStats);
                $manager->flush();

                $player = new Player();
                $player->setCommonName($dataPlayer->commonName);
                $player->setFirstName($dataPlayer->firstName);
                $player->setLastName($dataPlayer->lastName);
                $player->setHeight($dataPlayer->height);
                $player->setWeight($dataPlayer->weight);
                $player->setBirthDate($dataPlayer->birthdate);
                $player->setAge($dataPlayer->age);
                $player->setFoot($dataPlayer->foot);
                $player->setWeakFoot($dataPlayer->weakFoot);
                $player->setIsGK($dataPlayer->isGK);
                $player->setImage($dataPlayer->headshotImgUrl);
                $player->setComposure($dataPlayer->composure);
                $player->setPotential($dataPlayer->potential);
                $player->setRating($dataPlayer->rating);
                $player->setPlayerATKStats($atkStats);
                $player->setPlayerSPEStats($speStats);
                $player->setPlayerDEFStats($defStats);
                $player->setPlayerGKStats($gkStats);

                $manager->persist($player);
                $manager->flush();
//            dump($player);die;
            }
        }

        for($i=1; $i<=$nbGKPages; $i++) {
            dump($i);
            $dataPlayers = $this->uTeam->getGoalkeeper($i);

            foreach ($dataPlayers as $dataPlayer) {
                $atkStats = new PlayerATKStats();
                $atkStats->setBallControl($dataPlayer->ballcontrol);
                $atkStats->setCrossing($dataPlayer->crossing);
                $atkStats->setCurve($dataPlayer->curve);
                $atkStats->setDribbling($dataPlayer->dribbling);
                $atkStats->setFinishing($dataPlayer->finishing);
                $atkStats->setVolleys($dataPlayer->volleys);
                $atkStats->setShotpower($dataPlayer->shotpower);
                $atkStats->setLongshots($dataPlayer->longshots);
                $atkStats->setPenalties($dataPlayer->penalties);

                $defStats = new PlayerDEFStats();
                $defStats->setHeadingAccuracy($dataPlayer->headingaccuracy);
                $defStats->setInterceptions($dataPlayer->interceptions);
                $defStats->setJumping($dataPlayer->jumping);
                $defStats->setMarking($dataPlayer->marking);
                $defStats->setReactions($dataPlayer->reactions);
                $defStats->setSlidingTackle($dataPlayer->slidingtackle);
                $defStats->setStandingTackle($dataPlayer->standingtackle);
                $defStats->setStrength($dataPlayer->strength);
                $defStats->setStamina($dataPlayer->stamina);

                $speStats = new PlayerSPEStats();
                $speStats->setAcceleration($dataPlayer->acceleration);
                $speStats->setAggression($dataPlayer->aggression);
                $speStats->setAgility($dataPlayer->agility);
                $speStats->setBalance($dataPlayer->balance);
                $speStats->setFreekickAccuracy($dataPlayer->freekickaccuracy);
                $speStats->setShortPassing($dataPlayer->shortpassing);
                $speStats->setSprintSpeed($dataPlayer->sprintspeed);
                $speStats->setLongPassing($dataPlayer->longpassing);
                $speStats->setPositioning($dataPlayer->positioning);
                $speStats->setVision($dataPlayer->vision);

                $gkStats = new PlayerGKStats();
                $gkStats->setDiving($dataPlayer->gkdiving);
                $gkStats->setHandling($dataPlayer->gkhandling);
                $gkStats->setKicking($dataPlayer->gkkicking);
                $gkStats->setPositioning($dataPlayer->gkpositioning);
                $gkStats->setReflexes($dataPlayer->gkreflexes);

                $manager->persist($atkStats);
                $manager->persist($defStats);
                $manager->persist($speStats);
                $manager->persist($gkStats);
                $manager->flush();

                $player = new Player();
                $player->setCommonName($dataPlayer->commonName);
                $player->setFirstName($dataPlayer->firstName);
                $player->setLastName($dataPlayer->lastName);
                $player->setHeight($dataPlayer->height);
                $player->setWeight($dataPlayer->weight);
                $player->setBirthDate($dataPlayer->birthdate);
                $player->setAge($dataPlayer->age);
                $player->setFoot($dataPlayer->foot);
                $player->setWeakFoot($dataPlayer->weakFoot);
                $player->setIsGK($dataPlayer->isGK);
                $player->setImage($dataPlayer->headshotImgUrl);
                $player->setComposure($dataPlayer->composure);
                $player->setPotential($dataPlayer->potential);
                $player->setRating($dataPlayer->rating);
                $player->setPlayerATKStats($atkStats);
                $player->setPlayerSPEStats($speStats);
                $player->setPlayerDEFStats($defStats);
                $player->setPlayerGKStats($gkStats);

                $manager->persist($player);
                $manager->flush();
//            dump($player);die;
            }
        }
    }

    public function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }
}