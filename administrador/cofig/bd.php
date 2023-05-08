<?php
//conctandose a la base de datos
$host = "localhost";
$bd = "divioteca";
$usuario = "root";
$contrasenia = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
    if ($conexion){ /*echo 'conectando a sistema'*/;}
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>
