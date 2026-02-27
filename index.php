<?php
require "vendor/autoload.php";

use App\Controllers\UtilidadesController;
use App\Controllers\FinanzasController;
use App\Carrito;

$utilController = new UtilidadesController();

if (isset($_GET["pdf"])) {
    $utilController->crearPDF("Este PDF fue generado usando dompdf.");
    exit;
}

if (isset($_GET["imagen"])) {
    $utilController->redimensionarImagen("imagen.jpg", "imagen_modificada.jpg");
    echo "Imagen redimensionada correctamente.";
    exit;
}

$finanzasController = new FinanzasController();
$resultadoInteres = null;
$resultadoSalario = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["capital"], $_POST["tasa"], $_POST["tiempo"])) {
        $capital = floatval($_POST["capital"]);
        $tasa = floatval($_POST["tasa"]) / 100;
        $tiempo = intval($_POST["tiempo"]);
        $resultadoInteres = $finanzasController->mostrarInteres($capital, $tasa, $tiempo);
    }

    if (isset($_POST["salario"])) {
        $salario = floatval($_POST["salario"]);
        $resultadoSalario = $finanzasController->mostrarSalarioNeto($salario);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Proyecto PHP MVC</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-5">
<h1 class="text-center mb-5">Taller PHP Avanzado</h1>


<div class="card shadow mb-4">
<div class="card-body">
<h3 class="card-title">Ejercicio 1</h3>

<?php
$estudiantes = [
["nombre"=>"Santiago","Calificacion"=>40,"carrera"=>"Ingenieria"],
["nombre"=>"Valentina","Calificacion"=>82,"carrera"=>"Medicina"],
["nombre"=>"Mateo","Calificacion"=>85,"carrera"=>"Derecho"],
["nombre"=>"Isabella","Calificacion"=>76,"carrera"=>"Ingenieria"],
["nombre"=>"Sebastian","Calificacion"=>65,"carrera"=>"Ingenieria"],
["nombre"=>"Juanito","Calificacion"=>20,"carrera"=>"Medicina"],
["nombre"=>"Pedrito","Calificacion"=>90,"carrera"=>"Ingenieria"],
["nombre"=>"Tatiana","Calificacion"=>80,"carrera"=>"Derecho"],
];

function calcularPromedio($grupo){
$total=0;
foreach($grupo as $e){ $total += $e["Calificacion"]; }
return count($grupo)>0 ? $total/count($grupo) : 0;
}

$grupos=[];
foreach($estudiantes as $e){
$grupos[$e["carrera"]][]=$e;
}

$promedios=[];

echo "<table class='table table-bordered table-striped'>";
echo "<thead class='table-dark'><tr><th>Carrera</th><th>Promedio</th></tr></thead><tbody>";

foreach($grupos as $carrera=>$grupo){
$prom=calcularPromedio($grupo);
$promedios[$carrera]=$prom;
echo "<tr><td>$carrera</td><td>".round($prom,2)."</td></tr>";
}
echo "</tbody></table>";

$carreraMasDificil="";
$promedioMasBajo=PHP_FLOAT_MAX;

foreach($promedios as $carrera=>$prom){
if($prom<$promedioMasBajo){
$promedioMasBajo=$prom;
$carreraMasDificil=$carrera;
}
}

echo "<div class='alert alert-warning'><strong>Carrera más difícil:</strong> $carreraMasDificil con promedio ".round($promedioMasBajo,2)."</div>";

echo "<h5>Estudiantes sobre el promedio de su carrera</h5><ul class='list-group'>";
foreach($estudiantes as $e){
if($e["Calificacion"]>$promedios[$e["carrera"]]){
echo "<li class='list-group-item'>{$e["nombre"]} ({$e["carrera"]})</li>";
}
}
echo "</ul>";
?>

</div>
</div>


<div class="card shadow mb-4">
<div class="card-body">
<h3 class="card-title">Ejercicio 2</h3>

<?php
$envios=[
["id"=>1,"ciudad"=>"Bogota","transportista"=>"Carlos","peso"=>10,"costo_kilo"=>5000,"estado"=>"Entregado"],
["id"=>2,"ciudad"=>"Medellin","transportista"=>"Ana","peso"=>5,"costo_kilo"=>6000,"estado"=>"En ruta"],
["id"=>3,"ciudad"=>"Bogota","transportista"=>"Carlos","peso"=>8,"costo_kilo"=>5000,"estado"=>"Entregado"],
["id"=>4,"ciudad"=>"Cali","transportista"=>"Luis","peso"=>12,"costo_kilo"=>4000,"estado"=>"Entregado"],
["id"=>5,"ciudad"=>"Bogota","transportista"=>"Ana","peso"=>7,"costo_kilo"=>6000,"estado"=>"Cancelado"],
];

$total=0;
$pesoCiudad=[];
$entregasTransportista=[];

foreach($envios as $e){
if($e["estado"]=="Entregado"){
$total += $e["peso"]*$e["costo_kilo"];
$pesoCiudad[$e["ciudad"]] = ($pesoCiudad[$e["ciudad"]] ?? 0)+$e["peso"];
$entregasTransportista[$e["transportista"]] = ($entregasTransportista[$e["transportista"]] ?? 0)+1;
}
}

echo "<div class='alert alert-info'><strong>Total envíos entregados:</strong> $total</div>";

arsort($pesoCiudad);
$ciudadMayor=array_key_first($pesoCiudad);
echo "<p><strong>Ciudad con mayor peso:</strong> $ciudadMayor ({$pesoCiudad[$ciudadMayor]} kg)</p>";

arsort($entregasTransportista);
$mejor=array_key_first($entregasTransportista);
echo "<p><strong>Mejor transportista:</strong> $mejor ({$entregasTransportista[$mejor]} entregas)</p>";
?>

</div>
</div>


<div class="card shadow mb-4">
<div class="card-body">
<h3 class="card-title">Ejercicio 3 - Carrito</h3>
<?php
$carrito = new Carrito();
echo "<div class='alert alert-secondary'>".$carrito->sonido()."</div>";
?>
</div>
</div>


<div class="card shadow mb-4">
<div class="card-body">
<h3 class="card-title">Ejercicio MVC</h3>

<?php
$capital=1000000;
$tasa=0.05;
$tiempo=3;
$salarioBase=2000000;

$interes=$finanzasController->mostrarInteres($capital,$tasa,$tiempo);
$salarioNeto=$finanzasController->mostrarSalarioNeto($salarioBase);

echo "<p><strong>Interés compuesto:</strong> ".round($interes,2)."</p>";
echo "<p><strong>Salario neto:</strong> ".round($salarioNeto,2)."</p>";
?>
</div>
</div>


<div class="card shadow mb-4">
<div class="card-body">
<h3 class="card-title">Formularios</h3>

<div class="row">
<div class="col-md-6">
<form method="POST" class="border p-3 rounded">
<h5>Interés Compuesto</h5>
<input type="number" name="capital" class="form-control mb-2" placeholder="Capital" required>
<input type="number" step="0.01" name="tasa" class="form-control mb-2" placeholder="Tasa %" required>
<input type="number" name="tiempo" class="form-control mb-2" placeholder="Tiempo (años)" required>
<button class="btn btn-primary w-100">Calcular</button>
</form>
<?php if($resultadoInteres!==null){ echo "<div class='alert alert-success mt-2'>Resultado: ".round($resultadoInteres,2)."</div>"; } ?>
</div>

<div class="col-md-6">
<form method="POST" class="border p-3 rounded">
<h5>Salario Neto</h5>
<input type="number" name="salario" class="form-control mb-2" placeholder="Salario Base" required>
<button class="btn btn-success w-100">Calcular</button>
</form>
<?php if($resultadoSalario!==null){ echo "<div class='alert alert-info mt-2'>Salario Neto: ".round($resultadoSalario,2)."</div>"; } ?>
</div>
</div>

</div>
</div>


<div class="card shadow">
<div class="card-body text-center">
<h3 class="card-title">Librerías Externas</h3>
<a href="?pdf=1" class="btn btn-danger m-2">Generar PDF</a>
<a href="?imagen=1" class="btn btn-warning m-2">Redimensionar Imagen</a>
</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>