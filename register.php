<?php
    include("includes/db.php");
    //Usuario SI esta logeado
    if(isset($_SESSION['email'])){
        header("Location: index.php");
    } else {
    //Usuario NO esta logeado ?>
        
        

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Registrar</title>
            <link rel="stylesheet" href="estilos/login.css">
            <link href="estilos/proestilos.css" rel="stylesheet" type="text/css"/>
        </head>
        <body>
            <?php
                if(isset($_SESSION['err_msg'])){?>
                <div class="err_msg">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <?php echo $_SESSION['err_msg'];
                          unset($_SESSION['err_msg']);?>
                </div>
                <?php }
            ?>
            <div class="contentenedor">
                <div class="form_contenedor">
                    <div class="form_cuerpo">
                        <h2 class="titulo">Registrarse</h2>
                        <form action="validar_registro.php" method="post" class="formulario">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="name" placeholder="Nombre" id="nombre"><br>
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="email" id="email"><br>
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" placeholder="Minimo 8 caracteres, 1 letra, 1 caracter especial" id="password"><br>
                            <label for="passwordCheck">Vuelve a introducir la contraseña</label>
                            <input type="password" name="passwordCheck" placeholder="Comprobar password" id="passwordCheck"><br>
                            <input type="submit" value="Registrar" name="register_user"><br>
                        </form>
                    </div>
                    <div class="form_pie">
                        <div>
                            <span> </span><a href="login.php">Inicia sesión!</a>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
    <?php }
?>