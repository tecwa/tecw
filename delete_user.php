<?php
    include("includes/db.php");
    if(isset($_SESSION['email'])){
        if($_SESSION['userType'] == 1){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $idSanitized = mysqli_real_escape_string($conn, $id);
                $query = "DELETE FROM usuarios WHERE id = $idSanitized";
                $resul = mysqli_query($conn, $query);
                if(!$resul){
                    die("Query Error");
                }
        
                $_SESSION['err_msg'] = "Usuario borrado exitosamente";
        
                header("Location: admin_panel.php");
            }
        } else {
            $_SESSION['err_msg'] = "No tienes acceso a esta pagina";
            header("Location: index.php");
        }
    } else {
        $_SESSION['err_msg'] = "Por favor inicia sesión";
        header("Location: index.php");
    }
    
?>