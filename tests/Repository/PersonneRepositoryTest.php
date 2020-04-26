<?php

namespace App\Tests\Repository;

use App\DataFixtures\AppFixtures;
use App\DataFixtures\PersonFixtures;
use App\Entity\User;
use App\Entity\Adresse;
use App\Entity\Person;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class PersonneRepositoryTest extends WebTestCase { 

    use FixturesTrait;

    /**
     * Prepares the tests
     * @before
     * @return void
     */
    public function setUp(){
        self::bootKernel();
    }

    public function testFindAllReturnsAllPersons(){
        $this->loadFixtures([PersonFixtures::class]);
        $person = self::$container->get(PersonRepository::class)->findAll();
        $this->assertCount(20, $person);
    }

    public function testfindById(){
        $this->loadFixtures([PersonFixtures::class]);
        $person = self::$container->get(PersonRepository::class)->find(1);
        $this->assertInstanceOf(Person::class, $person);
        $this->assertEquals(1, $person->getId());
    }

    public function testInsertion(){
        $adresse = (new Adresse())
                    ->setNumeroRue(1)
                    ->setNomRue("Rue toot")
                    ->setCodePostal("hkjhjk")
                    ->setVille("TEST")
                    ->setPays("FR");
        $person = (new Person())->setPrenom("Dav")
                    ->setNom("DUPOND")
                    ->setSalaire(21312)
                    ->setAdresse($adresse);
        $manager = self::$container->get('doctrine.orm.entity_manager');
        // $this->loadFixtures([PersonneFixtures::class]);
        $manager->persist($person);
        $manager->flush();
        $personneTrouvee = self::$container->get(PersonRepository::class)->find($person);
        $this->assertNotNull($personneTrouvee);
        $this->assertEquals("Dav", $personneTrouvee->getPrenom());
    }

    /**
     * Stops the kernel
     * @after
     * @return void
     */
    public function closeTests(){
        self::ensureKernelShutdown();
    }
}
?>