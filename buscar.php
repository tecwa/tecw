<?php
    include("includes/db.php");
    if(isset($_SESSION['email'])){
        if(isset($_GET['search_query'])){
            $search = filter_var($_GET['search_query'], FILTER_SANITIZE_STRING);
            $searchSanitized = mysqli_real_escape_string($conn, $search);
            if(isset($searchSanitized[0])){
                ?>
                <nav class="navbar">
                    <!-- Logo -->
                    <div class="logo">HOLA:) <?php echo $_SESSION['name'] ?></div>
                    <!-- Menus -->
                    <div class="menus">
                        <ul>
                            <div class="buscar-container">
                                <form action="buscar.php" method="GET">
                                    <input type="text" placeholder="Buscar" name="search_query" value ="<?php echo $searchSanitized ?>">
                                    <button type="submit">Buscar</button>
                                </form>
                            </div>
                            <?php if($_SESSION['userType'] == 1){ ?>
                                <li><a href="admin_panel.php">Admin Panel</a></li>
                            <?php } ?>
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
                    include("includes/header.php");
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
                                $query = "SELECT * FROM residencias JOIN carrera ON(residencias.carrera_id = carrera.id) WHERE tema like '%$searchSanitized%'";
                                $result = mysqli_query($conn, $query);
                                if(mysqli_num_rows($result) >= 1) {
                                    while($row = mysqli_fetch_array($result)){ ?>
                                        <tr>
                                            <td><a href="https://drive.google.com/file/d/<?php echo $row['link'] ?>/view" target="_blank"><?php echo $row['tema'] ?></a></td>
                                            <td>
                                                <?php 
                                                    $autores = $row['idResidencia'];
                                                    $autoresSanitized = mysqli_real_escape_string($conn, $autores) ;
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
                                                <a href="https://drive.google.com/file/d/<?php echo $row['link'] ?>/view" target="_blank">Ver</a>
                                                <a href="https://drive.google.com/uc?export=download&id=<?php echo $row['link'] ?>" target="_blank">Descargar</a>
                                            </td>
                                        </tr>
                                    <?php } 
                                } else {
                                    $_SESSION['err_msg'] = "No se encontraron resultados";
                                    header("Location: index.php");
                                } ?>
                            </tbody>
                        </table>
                    </div>
            <?php } else {
                $_SESSION['err_msg'] = "Porfavor introduce texto a buscar";
                header("Location: index.php");
            }

        } else {
            $_SESSION['err_msg'] = "Porfavor introduce texto a buscar";
            header("Location: index.php");
        }
    } else {
        $_SESSION['err_msg'] = "Por favor inicia sesión";
        header("Location: index.php");
    }
?>
