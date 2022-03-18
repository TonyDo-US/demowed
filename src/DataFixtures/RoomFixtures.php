<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoomFixtures extends Fixture
{
  
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i=0; $i<5; $i++){
            $room = new Room;
            $room->setNo("GCH190$i");
            $room->setTime(\DateTime:: createFromFormat('Y/m/d', '2022/03/12'));
            $manager->persist(($room));
        }
        $manager->flush();
    }
}
