<?php

namespace App\Controller;

class Calcul {

    public function addition (int $a, int $b) {
        return $a + $b;
    }

    public function soustraction (int $a, int $b) {
        return $a - $b;
    }

    public function multiplication (int $a, int $b) {
        return $a * $b;
    }

    public function division (int $a, int $b) {
        if ($b == 0) {
            throw new \InvalidArgumentException("Division by zero is not possible");
        }

        return $a / $b;
    }
}