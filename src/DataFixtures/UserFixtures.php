<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail('email@'.$i. 'com');
            $user->setPassword("$i");
            $manager->persist($user);
        }
        $manager->flush();
    }
}