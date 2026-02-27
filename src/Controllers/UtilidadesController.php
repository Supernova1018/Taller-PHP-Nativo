<?php
namespace App\Controllers;

use App\Models\Documento;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UtilidadesController {

    private $documento;

    public function __construct() {
        $this->documento = new Documento();
    }

    public function crearPDF($texto) {
        $this->documento->generarPDF($texto);
    }

    public function redimensionarImagen($rutaEntrada, $rutaSalida) {

        $manager = new ImageManager(new Driver());

        $imagen = $manager->read($rutaEntrada);
        $imagen->resize(300, 300);

        $imagen->save($rutaSalida);
    }
}