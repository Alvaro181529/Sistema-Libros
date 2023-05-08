<?php
include ('../template/Cabecera.php');
// put your code here
?>
<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include ('../cofig/bd.php');

switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO libros (Codigo,Nombre,Imagen) VALUES (:Codigo,:Nombre,:Imagen);");
        $sentenciaSQL->bindParam(':Codigo', $txtCodigo);
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $Fecha = new DateTime();
        $NombreArchivo = ($txtImagen != "") ? $Fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
        $TmpImagen = $_FILES["txtImagen"]["tmp_name"];
        if ($TmpImagen != "") {
            move_uploaded_file($TmpImagen, "../../img/" . $NombreArchivo);
        }
        $sentenciaSQL->bindParam(':Imagen', $NombreArchivo);
        $sentenciaSQL->execute();
        break;
        header("Location:Productos.php");
    case "Modificar":

        $sentenciaSQL = $conexion->prepare("UPDATE libros SET Codigo=:Codigo WHERE id=:ID");
        $sentenciaSQL->bindParam(':Codigo', $txtCodigo);
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE libros SET Nombre=:Nombre WHERE id=:ID");
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();

        if ($txtImagen != "") {

            $Fecha = new DateTime();
            $NombreArchivo = ($txtImagen != "") ? $Fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $TmpImagen = $_FILES["txtImagen"]["tmp_name"];            
            move_uploaded_file($TmpImagen, "../../img/" . $NombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM libros WHERE id=:ID");
            $sentenciaSQL->bindParam(':ID', $txtID);
            $sentenciaSQL->execute();
            $Libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($Libro['Imagen']) && ($Libro["imagen"] != "Imagen.jpg")) {
                if (file_exists("../../img" . $Libro["Imagen"])) {
                    unlink("../../img/" . $Libro["imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE libros SET Imagen=:Imagen WHERE id=:ID");
            $sentenciaSQL->bindParam(':Imagen', $NombreArchivo);
            $sentenciaSQL->bindParam(':ID', $txtID);
            $sentenciaSQL->execute();
            
        }
        header("Location:Productos.php");
        break;


    case "Cancelar":
        header("Location:Productos.php");
        break;
    case "Borrar":

        $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM libros WHERE id=:ID");
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();
        $Libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($Libro['Imagen']) && ($Libro["imagen"] != "Imagen.jpg")) {
            if (file_exists("../../img/".$Libro["Imagen"])) {
                unlink("../../img/".$Libro["imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM libros WHERE id=:ID");
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();
        header("Location:Productos.php");

        break;
    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:ID");
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();
        $Libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtCodigo = $Libro['Codigo'];
        $txtNombre = $Libro['Nombre'];
        $txtImagen = $Libro['Imagen'];
        
        break;

    default:
        break;
}
$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$ListaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="col-md-4">

    <div class="card text-black-50">
        <div class="card-header">
            Datos del Libro
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
               
                <!-- <div class="form-group">
                    <label for="txtID" class="form-label">ID:</label>
                    <input type="hiden" required readonly class="form-control" name="txtID" value="<?php echo $txtID; ?>" id="txtID" placeholder="ID">
                </div>
                <br/> -->
                <div class="form-group">
                    <label for="txtCodigo" class="form-label">Codigo del Libro:</label>
                    <input type="text" required class="form-control" name="txtCodigo" value="<?php echo $txtCodigo; ?>"  id="txtCodigo" placeholder="Codigo">
                </div>
                <br/>
                <div class="form-group">
                    <label for="txtNombre" class="form-label">Nombre:</label>
                    <input type="text" required class="form-control" name="txtNombre" value="<?php echo $txtNombre; ?>" id="txtNombre" placeholder="Nombre del Libro">
                </div>
                <br/>
                <div class="form-group">
                    <label for="txtImagen" class="form-label">Imagen:</label>
                    <br/>
                    <?php if($txtImagen!="") {?>
                     <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="50" alt=""/>                        
                    <?php
                    }?>
                    <input type="file" class="form-control" name="txtImagen" id="txtImagen">
                </div>
                <br/>
                <div align="center" class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""?> value="Agregar" class="btn btn-success">Agregar</button> <br/>
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""?> value="Modicar" class="btn btn-warning">Modicar</button> <br/>
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""?> value="Cancelar" class="btn btn-info">Cancelar</button> <br/>
                </div>
                <br/>
            </form>
        </div>

    </div>


</div>
<div class="col-md-8">

    <table class="table table-bordered table-hover">
        <thead  align="center">
            <tr>
                <!-- 
                <th scope="col">ID</th> -->
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Imagenes</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody  align="center">
            <?php foreach ($ListaLibros as $Libro) { ?>
                <tr>
                    <!--  
                    <td><?php echo $Libro['ID']; ?></td>--> 
                    <td><?php echo $Libro['Codigo']; ?></td>
                    <td><?php echo $Libro['Nombre']; ?></td>
                    <td>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $Libro['Imagen']; ?>" width="50" alt="<?php echo $Libro['Nombre']; ?>"/>                        
                        
                    </td>                

                    <td>
                        <form method="POST" align="center">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $Libro['ID']; ?>">
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger"> &nbsp;
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                        </form>                
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
<?php
include ('../template/Pie.php');
// put your code here
?>