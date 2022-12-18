<?php
    include("includes/db.php");
    if(isset($_SESSION['email'])){
        if($_SESSION['userType'] == 1){?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Tu eres el Admin</title>
                <link rel="stylesheet" href="estilos/main.css">
            </head>
            <body>
                <nav class="navbar">
                    <!-- Logo -->
                    <div class="logo">HOLA:) <?php echo $_SESSION['name'] ?></div>
                    <!-- Menus -->
                    <div class="menus">
                        <ul>
                            <li><a href="index.php">Inicio</a></li>
                            <li><a href="logout.php">Logout</a></li>
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
                <div class="titulo">
                        <h2>Usuarios</h2>
                </div>
                <div class="contenido">
                    
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Descripcion</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Tipo de usuario</th>
                        <th>Fecha</th>
                        <th>Dar baja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM usuarios";
                            $result_task = mysqli_query($conn, $query);

                            while($row = mysqli_fetch_array($result_task)){ ?>
                                <tr>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['password'] ?></td>
                                    <td><?php echo $row['userType'] ?></td>
                                    <td><?php echo $row['created_at'] ?></td>
                                    <td>
                                        <a href="delete_user.php?id=<?php echo $row['id']?>">Eliminar</a>
                                    </td>
                                </tr>

                            <?php } ?>
                    </tbody>
                </table>
                </div>
                <div class="espacio_tabla"></div>
                <div class="titulo">
                        <h2>Depositos</h2>
                </div>
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
                                <td><a href="https://drive.google.com/file/d/<?php echo $row['link'] ?>/view"><?php echo $row['tema'] ?></a></td>
                                <td>
                                    <?php 
                                        $autores = $row['idResidencia'];
                                        $autoresSanitized = mysqli_real_escape_string($conn, $autores);
                                        $bdaut = "SELECT * FROM residencias JOIN autor ON(residencias.idResidencia = autor.residencias_id) where residencias.idResidencia = $autoresSanitized";
                                        $resul = mysqli_query($conn, $bdaut);
                                        while($rowAutor = mysqli_fetch_array($resul)){
                                            echo $rowAutor['nombre']." ".$rowAutor['apellido']."<br>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $row['fecha'] ?></td>
                                <td><?php echo $row['numPaginas'] ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td>
                                    <a href="https://drive.google.com/file/d/<?php echo $row['link'] ?>/view">Ver</a>
                                    <a href="https://drive.google.com/uc?export=download&id=<?php echo $row['link'] ?>">Descargar</a>
                                    <a href="delete_report.php?id=<?php echo $row['idResidencia'] ?>">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </body>
            </html>
            
        <?php } else {
            //Usuario Normal
            $_SESSION['err_msg'] = "No tienes acceso a esta pagina";
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }
?>
