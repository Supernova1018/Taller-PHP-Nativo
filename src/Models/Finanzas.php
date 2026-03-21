<?php
namespace App\Models;

class Finanzas {

    // Interés compuesto
    public function calcularInteresCompuesto($capital, $tasa, $tiempo) {
        return $capital * pow((1 + $tasa), $tiempo);
    }

    // Salario neto Colombia (simplificado)
    public function calcularSalarioNeto($salarioBase) {
        $salud = $salarioBase * 0.04;   // 4%
        $pension = $salarioBase * 0.04; // 4%

        return $salarioBase - ($salud + $pension);
    }
}