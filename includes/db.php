<?php

    // Inicio de sesion para guardar mensajes
    session_start();

    // Permite reportar mensajes de error
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Conexion a la base de datos
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'tecW'
    );
?>