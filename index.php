<?php
session_start();
include_once 'conexion.php';
include_once 'login.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena);
$conexion->conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['user'];
    $password = MD5($_POST['pwd']);

    $login = new Login($conexion);

    if  ($login->login($usuario, $password)){
        $_SESSION['usuario'] = $usuario;
        header("Location: dash.php");
        exit();
    } else {
        $error_message = "Nombre de usuario o de contraseña incorrectos";
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <form action="" method="POST">
        <h1 class="title">Inicio de sesion</h1>
        <label >
            <i class="fa-solid fa-user"></i>
            <input placeholder="Usuario" id="usuario" name="user">
        </label>
        <label >
            <i class="fa-solid fa-lock"></i>
            <input type="password" placeholder="Contraseña" id="contraseña" name="pwd">
        </label>

        <button id="button">Iniciar sesion</button>
    </form>
</body>
</html>