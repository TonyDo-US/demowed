<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++){
            $student = new Student;
            $student->setName("Student $i");
            $student->setDate(\DateTime::createFromFormat('Y/m/d','2001/08/21'));
            $student->setMajor("IT");
            $student->setImage("https://www.eurocircuits.com/wp-content/uploads/Student-icon.jpg");
            $manager->persist($student);
        }

        $manager->flush();
    }
}
