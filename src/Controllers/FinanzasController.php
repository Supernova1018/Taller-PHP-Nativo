<?php
namespace App\Controllers;

use App\Models\Finanzas;

class FinanzasController {

    private $modelo;

    public function __construct() {
        $this->modelo = new Finanzas();
    }

    public function mostrarInteres($capital, $tasa, $tiempo) {
        return $this->modelo->calcularInteresCompuesto($capital, $tasa, $tiempo);
    }

    public function mostrarSalarioNeto($salario) {
        return $this->modelo->calcularSalarioNeto($salario);
    }
}   