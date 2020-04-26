<?php

use App\Controller\Calcul;
use PHPUnit\Framework\TestCase;

class CalculTest extends TestCase {

    public function testAdditionWithPositiveNumbers() {
        $calcul = new Calcul();
        $result = $calcul->addition(2, 8);
        $this->assertEquals(10, $result);
    }

    public function testAdditionNegativeNumbers() {
        $calcul = new Calcul();
        $result = $calcul->addition(-5, -10);
        $this->assertTrue($result == -15);
    }

    public function testAdditionNegativeAndPositiveNumbers() {
        $calcul = new Calcul();
        $result = $calcul->addition(5, -10);
        $this->assertTrue($result == -5);
    }

    public function testSoustractionWithPositiveNumbers() {
        $calcul = new Calcul();
        $result = $calcul->soustraction(2, 8);
        $this->assertEquals(-6, $result);
    }

    public function testSoustractionNegativeNumbers() {
        $calcul = new Calcul();
        $result = $calcul->soustraction(-5, -10);
        $this->assertTrue($result == 5);
    }

    public function testSoustractionPositiveAndNegativeNumbers() {
        $calcul = new Calcul();
        $result = $calcul->soustraction(5, -10);
        $this->assertTrue($result == 15);
    }

    public function testMultiplicationWithPositiveNumbers() {
        $calcul = new Calcul();
        $result = $calcul->multiplication(2, 8);
        $this->assertEquals(16, $result);
    }

    public function testMultiplicationNegativeNumbers() {
        $calcul = new Calcul();
        $result = $calcul->multiplication(-5, -10);
        $this->assertTrue($result == 50);
    }

    public function testMultiplicationPositiveAndNegativeNumbers() {
        $calcul = new Calcul();
        $result = $calcul->multiplication(5, -10);
        $this->assertTrue($result == -50);
    }

    public function testDivisionWithPositiveNumbers() {
        $calcul = new Calcul();
        $result = $calcul->division(8, 4);
        $this->assertEquals(2, $result);
    }

    public function testDivisionNegativeNumbers() {
        $calcul = new Calcul();
        $result = $calcul->division(-10, -5);
        $this->assertTrue($result == 2);
    }

    public function testDivisionPositiveAndNegativeNumbers() {
        $calcul = new Calcul();
        $result = $calcul->division(10, -5);
        $this->assertTrue($result == -2);
    }

    public function testDivisionNegativeAndPositiveNumbers() {
        $calcul = new Calcul();
        $result = $calcul->division(-5, 10);
        $this->assertTrue($result == -0.5);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDivisionByZero() {
        $calcul = new Calcul();
        $result = $calcul->division(10, 0);
    }

}