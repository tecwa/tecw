<?php
    include("includes/db.php");
    if(isset($_SESSION["email"])){
        if(isset($_GET["id"])){
            $id = $_GET['id'];
            $query = "SELECT * FROM residencias JOIN carrera ON(carrera.id = residencias.carrera_id) where residencias.id = $id";
            $resul = mysqli_query($conn, $query);
            if(mysqli_num_rows($resul) == 1) {
                $row = mysqli_fetch_array($resul);
                $link = $row['link'];
                include("includes/header.php")
                ?>
                <div class="pdf_display">
                    
                </div>
                <div class="detalles">
                    <table>
                        <tr>
                            <th>Tema</th>
                            <th>Autores</th>

                        </tr>
                    </table>
                </div>
            <?php include("includes/footer.php");
            }
            else {
                echo "Residencia no encontrada";
            }
        } else {
            $_SESSION['err_msg'] = "Residencia no encontrada";
        }
    } else {
        $_SESSION['err_msg'] = "Necesitas iniciar sesion para poder visualizar esto";
        header("Location: index.php");
    }
?>