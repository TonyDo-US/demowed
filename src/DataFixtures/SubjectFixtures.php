<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i=0; $i<7; $i++){
            $sub = new Subject;
            $sub->setSubjectSlots(rand(30,90));
            $sub->setName("BI$i");
            $sub->setSubjectNo('1641');
            $manager->persist($sub);
        }

        $manager->flush();
    }
}
