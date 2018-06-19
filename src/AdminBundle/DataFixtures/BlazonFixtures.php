<?php

namespace AdminBundle\DataFixtures;

use AppBundle\Entity\BlazonShape;
use AppBundle\Entity\JerseyShape;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class BlazonFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $blazonShape = new BlazonShape();
        $blazonShape->setsvg("https://www.arsenal.com/themes/custom/arsenal_main/logo.svg");
        $blazonShape->setPremium(false);
        $manager->persist($blazonShape);

        $blazonShape2 = new BlazonShape();
        $blazonShape2->setsvg("https://www.arsenal.com/themes/custom/arsenal_main/logo.svg");
        $blazonShape2->setPremium(false);
        $manager->persist($blazonShape2);

        $jerseyShape = new JerseyShape();
        $jerseyShape->setsvg("https://www.arsenal.com/themes/custom/arsenal_main/logo.svg");
        $jerseyShape->setPremium(false);
        $manager->persist($jerseyShape);

        $jerseyShape2 = new JerseyShape();
        $jerseyShape2->setsvg("https://www.arsenal.com/themes/custom/arsenal_main/logo.svg");
        $jerseyShape2->setPremium(false);
        $manager->persist($jerseyShape2);
        $manager->flush();
    }
}