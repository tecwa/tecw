<?php 
    include("includes/db.php");
    if(isset($_POST['register_user'])){
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $passwordCheck = filter_var($_POST['passwordCheck'], FILTER_SANITIZE_STRING);
        $nameSanitized = mysqli_real_escape_string($conn, $name);
        $emailSanitized = mysqli_real_escape_string($conn, $email);
        $passwordSanitized = mysqli_real_escape_string($conn, $password);
        $passwordCheckSanitized = mysqli_real_escape_string($conn, $passwordCheck);
        $regex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
        $emailIsValid = false;
        $passwordIsValid = false;
        $samePassword = false;

        if(!filter_var($emailSanitized, FILTER_VALIDATE_EMAIL) === false) {
            $emailIsValid = true;
        } else {
            $_SESSION['err_msg'] = "email invalido";
            header("Location: register.php");
        }

        if(preg_match($regex, $passwordSanitized)){
            $passwordIsValid = true;
        } else {
            $_SESSION['err_msg'] = "Contraseña invalida, debe incluir 1 letra, 1 caracter especial, 
            minimo 8 caracteres";
            header("Location: register.php");
        }

        if($passwordSanitized === $passwordCheckSanitized){
            $samePassword = true;
        } else {
            $_SESSION['err_msg'] = "Las contraseñas no coinciden";
            header("Location: register.php");
        }

        if($emailIsValid && $passwordIsValid && $samePassword){
            try{
                $query = "INSERT INTO usuarios(name, email, password) VALUES ('$nameSanitized', '$emailSanitized', '$passwordSanitized')";
                $result = mysqli_query($conn, $query);
                $_SESSION['err_msg'] = "Cuenta creada exitosamente, porfavor inicia sesión";
                header("Location: index.php");
            } catch (\mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) {
                    $_SESSION['err_msg'] = "email ya registrado";
                    header("Location: register.php");
                } else {
                    throw $e;
                }
            }
        }   
    }
?>
