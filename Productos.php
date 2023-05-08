<?php
include ("template/Cabecera.php");
include ("administrador/cofig/bd.php");

        $sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
        $sentenciaSQL->execute();
        $ListaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($ListaLibros as $Libro) {  
?>
<div class="col-md-3">
    <div class="card">
        <img class="card-img-top" src="./img/<?php echo $Libro['Imagen'];?>" width="80" alt="<?php echo $Libro['Codigo'];?>"/>
        <div class="card-body">
            <h4 class="card-title"><?php echo $Libro['Nombre'];?></h1>
            <a name="" id="" class="btn btn-primary" href="https://goalkicker.com/" role="button">Ver más</a>
        </div>
</div>
</div>
 <?php }?>
<?php
include ("template/Pie.php");
// put your code here
?> 