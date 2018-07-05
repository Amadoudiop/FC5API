<?php

namespace AdminBundle\DataFixtures;

use AppBundle\Entity\StoreItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class StoreFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $storeItem = new StoreItem();
        $storeItem->setTitle("Premium mode");
        $storeItem->setValue(2.99);
        $storeItem->setFc5Buyable(false);
        $storeItem->setDescription("Remove all commercials from the app for ever");
        $storeItem->setImage("coin1.png");
        $manager->persist($storeItem);

        $storeItem2 = new StoreItem();
        $storeItem2->setTitle("Buy the referee");
        $storeItem2->setValue(100);
        $storeItem2->setFc5Buyable(true);
        $storeItem2->setDescription("The referee is 30% more likely to signal a foul for your side");
        $storeItem2->setImage("coin1.png");
        $manager->persist($storeItem2);
        $manager->flush();
    }
}