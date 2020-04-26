<?php

namespace App\Tests\Entity;
use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PersonneTest extends KernelTestCase{

    public function testIfPrenomIsValid(){
        self::bootKernel();
        $person = $this->createPerson();

        $this->ExpectXErrorsForPerson(0, $person);

    }

    public function testIfPrenomLessThanThreeLettersIsNotValid(){
        self::bootKernel();
        $person = $this->createPerson()->setPrenom("Da");

        $this->ExpectXErrorsForPerson(1, $person);
    }

    public function testIfNomLessThanThreeLettersIsNotValid(){
        self::bootKernel();
        $person = $this->createPerson()->setNom("Da");

        $this->ExpectXErrorsForPerson(1, $person);
    }

    public function testIfHasErrorOnNomAndPrenomWithThreeLetters(){
        self::bootKernel();
        $person = $this->createPerson()->setNom("Da")->setNom("Li");

        $this->ExpectXErrorsForPerson(1, $person);
    }



    private function expectXErrorsForPerson(int $nbrErrors, Person $person){
        $errors = self::$container->get("validator")->validate($person);
        $this->assertCount($nbrErrors, $errors);
    }

    private function createPerson(){

        return (new Person())->setPrenom("David")->setNom("Chappelle");

    }

}

?>