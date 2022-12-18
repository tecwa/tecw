<?php 
    session_start();


if(isset($_SESSION['email'])){
    //   Usuario SI esta logeado
    header("Location: index.php");
} else { ?>
    <!-- Usuario NO esta logeado -->
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
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
        
        <div class="content">
            <div class="info-content">
                <div class="form_cuerpo">
                    <h2 class="titulo">Inicia sesion</h2>
                    <div class="iniciar-con">                                                             <!-- El div que contiene el inicio de sesion con google y con facebook-->
                <div class="facebook">                                                            <!-- Un div con clase de nombre facebook -->
                    <img src="imagenes/Facebook_logo.png" alt="facebook-image">                          <!-- Aqui se encuentra el icono de facebook -->
                    <span>Facebook</span>                                                         <!-- Elemento en linea que dice Facebook  -->
                </div>
                <div class="google">                                                              <!-- Un div con clase de nombre facebook -->
                    <img src="imagenes/logo g.png" alt="google-image">                              <!-- Aqui se encuentra el icono de facebook -->
                    <span>Google</span>                                                           <!-- Elemento en linea que dice Google  -->
                </div>
            </div>
            <p class="o">Ó</p>
                    <form action="validar.php" method="POST" class="formulario">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email"><br>
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="Contraseña"><br>
                        <input type="submit" value="Login" name="login_user">
                    </form>
                </div>
                <div class="form_pie">
                    <div>
                        <span> </span><a href="register.php">Registrarme</a>      <a class="">Ó</a>      <a href="logout.php">Regresar</a>
                    </div>
                </div><a href="logout.php"></a>
            </div>
            <img class="image" src="imagenes/login img.png" alt="login">
        </div>
    </body>
    </html>
<?php } ?>