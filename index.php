<!-- To Do 
    Comprobar registro unico en la bd
    Hacer pagina de visualizacion
    css
-->

<?php include("includes/db.php"); ?>
<!-- Html -->
<?php
    //Usuario logeado
    if(isset($_SESSION['email'])){
        include("includes/header.php");?>

<link href="includes/main.css" rel="stylesheet" type="text/css"/>

            <nav class="navbar">
                <!-- Logo -->
                <div class="logo">HOLA :) <?php echo $_SESSION['name'] ?></div>
                <!-- Menus -->
                <div class="menus">
                    <ul>
                        <div class="buscar-container">
                            <form action="buscar.php" method="GET">
                                <input type="text" placeholder="Buscar" name="search_query">
                                <button type="submit">Buscar</button>
                            </form>
                        </div>
                        <?php if($_SESSION['userType'] == 1){ ?>
                            <li><a href="admin_panel.php">Admin Panel</a></li>
                        <?php } ?>
                            
                        <li><a href="logout.php">Salir</a></li>
                    </ul>
                </div>
            </nav>
            <?php
                if(isset($_SESSION['err_msg'])){?>
                <div class="err_msg">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <?php echo $_SESSION['err_msg'];
                          unset($_SESSION['err_msg']);?>
                </div>
                <?php }
            ?>
            <!-- Contenido -->
            <div class="contenido">
                <table class="tabla">
                    <thead>
                        <th>Descripcion</th>
                        <th>Usuario</th>
                        <th>fecha</th>
                        <th>Monto pagado</th>
                        <th>Banco</th>
                        <th>Facturar</th>
                    </thead>
                    <tbody>
                    <?php
                        $query = "SELECT * FROM residencias JOIN carrera ON (residencias.carrera_id = carrera.id)";
                        $result_task = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_array($result_task)){ ?>
                            <tr>
                                <td><a href="https://drive.google.com/file/d/<?php echo $row['link'] ?>/view" target="_blank"><?php echo $row['tema'] ?></a></td>
                                <td>
                                    <?php 
                                        $autores = $row['idResidencia'];
                                        $autoresSanitized = mysqli_real_escape_string($conn, $autores);
                                        $bdaut = "SELECT * FROM residencias JOIN autor ON(residencias.idResidencia = autor.residencias_id) where residencias.idResidencia = $autoresSanitized";
                                        $resul = mysqli_query($conn, $bdaut);
                                        while($rowAutor = mysqli_fetch_array($resul)){
                                            echo $rowAutor['nombre']." ".$rowAutor['apellido']."<br><br>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $row['fecha'] ?></td>
                                <td><?php echo $row['numPaginas'] ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td>
                                    <a href="https://drive.google.com/file/d/<?php echo $row['link'] ?>/view" target="_blank">Ver</a>
                                    <a href="https://drive.google.com/uc?export=download&id=<?php echo $row['link'] ?>" target="_blank">Descargar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php include("includes/footer.php");
    //Usuario no admin
    }else{
        include("includes/header.php");?>
            <script>window.alert("Esta pagina es un proyecto de la materia de programacion web del ITP disfruten:)!");
            </script>
        <nav class="navbar">
            <!-- Logo -->
            <div class="logo">Hola :)</div>
            <!-- Menus -->
            <div class="menus">
                <ul>
                    <li><a href="login.php">Inicio de sesion</a></li>
                    <li><a href="register.php">Registrarme</a></li>
                </ul>
            </div>
        </nav>
        <?php
                if(isset($_SESSION['err_msg'])){?>
                <div class="err_msg">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <?php echo $_SESSION['err_msg'];
                          unset($_SESSION['err_msg']);?>
                </div>
                <?php }
            ?>
        <div class="container_ppal">
            <div class="img1">
                <img class=""src="imagenes/3.jpg" alt=""/>
                <div class="texto"><span class="bordes">TecWallets</span></div>
            </div>
            <div class="about">
                <div class="textoAcerca">
                    <h2><b></b></h2><br>
                    <p>
                      
                    </p><br>
                    <p>
                         </p>
                </div>
                34 y 15
            </div>
            
            
        </div>
    <?php include("includes/footer.php");
    } ?>