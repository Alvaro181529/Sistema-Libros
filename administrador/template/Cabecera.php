<?php 
session_start();
    if(!isset($_SESSION['usuario'])){
        header("Location:../index.php");
    }else{
        if($_SESSION['usuario']=="ok"){
            $NombreUsuario=$_SESSION["NombreUsuario"];
        }
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body>
        <?php $url = "http://".$_SERVER['HTTP_HOST']."/Mi_Pagina_Web";
       // put your code here
?>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><b><i>Divioteca Administrador</i></b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="nav navbar-nav ms-auto">
                <a class="nav-item nav-link" href="#">Administrador</a>                
                <a class="nav-item nav-link" href="<?php echo $url;?>./administrador/inicio.php">Inicio</a>                
                <a class="nav-item nav-link" href="<?php echo $url;?>./administrador/seccion/Productos.php">Libros</a> 
                <a class="nav-item nav-link" href="<?php echo $url;?>">Ver Sitio Web</a>                
                <a class="nav-item nav-link" href="<?php echo $url;?>./administrador/seccion/Cerrar.php">Cerrar Sesion</a>                
            </div>

        </nav>
        <br/><br/>
        <div class="container">
            <div class="row">
                
                
