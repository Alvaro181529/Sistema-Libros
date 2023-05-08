<?php
session_start();
if ($_POST) {
    if (($_POST['usuario'] == "develoteca") && ($_POST['contrasenia'] == "sistema")) {
        $_SESSION['usuario'] = "ok";
        $_SESSION['NombreUsuario'] = "develoteca";

        header("Location:inicio.php");
    } else {
        $mensaje = "error el usuario o contraseña son incorrectos";
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
        <title>Administrador</title>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/Diseno.css"/>    
    </head>
    <body>
        <p></p><br/><br/><br/><br/><br/>
        <div class="container">
            <div class="row">

                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <div class="card">
                        <div class="card-header">
                            <h3 align="center">Login</h3>
                        </div>
                        <div class="card-body">
                            
                                <?php if(isset($mensaje)){?>                               
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                   
                                       <?php echo $mensaje;?>   
                                </div>
                                <?php }?>

                            <form method="POST">

                                
                                
                                <div class="form-group">
                                    <label>Nombre de Usuario:</label>
                                    <input type="text" class="form-control" name="usuario" placeholder="Usuario">                                    
                                </div>
                                <p></p>
                                <div class="form-group">
                                    <label>ingrese Contraseña:</label>
                                    <input type="password" class="form-control" name="contrasenia" placeholder="Contraseña">
                                </div>
                                <p></p>  
                                <div align="center" >
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </div>

                            </form>
                        </div>                        
                    </div>
                    <div class="col-md-4"></div>

                </div>

            </div>

        </div>
    </body>
</html>
