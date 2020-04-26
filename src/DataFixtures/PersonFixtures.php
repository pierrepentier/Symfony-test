<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Adresse;

class PersonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $person = new Person();
            $person->setNom('Prénom-'.$i);
            $person->setPrenom("NOM-$i");
            $person->setSalaire(mt_rand(1000, 10000));
            $adresse= $this->createAdresse($i);
            $manager->persist($adresse);
            $adresse->addPerson($person);
            $person->setAdresse($adresse);
            $manager->persist($person);
        }

        $manager->flush();
    }

    private function createAdresse(int $i){
        $adresse = new Adresse();
        $adresse->setNumeroRue(mt_rand(1000, 10000));
        $adresse->setNomRue('Rue du ' . $i);
        $adresse->setCodePostal(mt_rand(10000, 99000));
        $adresse->setVille('Ville-' . $i);
        $adresse->setPays('Pays-' . $i);
        return $adresse; 
    }
}