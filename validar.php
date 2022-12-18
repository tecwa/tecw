<?php 
include("includes/db.php");
    if(isset($_POST['login_user'])){
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $emailSanitized = mysqli_real_escape_string($conn, $email);
        $passwordSanitized = mysqli_real_escape_string($conn, $password);
        $regex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
        $emailIsValid = false;
        if(!filter_var($emailSanitized, FILTER_VALIDATE_EMAIL) === false) {
            $emailIsValid = true;
        } else {
            $_SESSION['err_msg'] = "email invalido";
            header("Location: login.php");
        }

        if($emailIsValid){
            $query = "SELECT * FROM usuarios WHERE email = '$emailSanitized' AND password = BINARY '$passwordSanitized'";
            $resul = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($resul);
            if(mysqli_num_rows($resul) == 1) {
                //Datos Correctos
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['userType'] = $row['userType'];
                header("Location: index.php");
            } else {
                $_SESSION['err_msg'] = "Datos incorrectos";
                header("Location: login.php");
            }
        }
    }
?>