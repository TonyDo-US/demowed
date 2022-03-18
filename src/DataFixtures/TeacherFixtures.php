<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeacherFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++){
            $teacher = new Teacher;
            $teacher->setName("Teacher $i");
            $teacher->setDate(\DateTime::createFromFormat('Y/m/d','2001/08/21'));
            $teacher->setPhone("0964544815");
            $teacher->setAddress("Ha Noi");
            $teacher->setEmail('DDDDD@fpt.edu.vn');
            $manager->persist($teacher);
        }

        $manager->flush();
    }
}
