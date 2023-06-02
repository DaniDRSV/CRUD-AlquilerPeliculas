<?php 
session_start();

if($_SESSION['usuario']=== null){
    header('Location:index.php');
}

include_once 'conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena); 
$conexion->conectar();

$query = "select * FROM peliculas";
$statement = $conexion->getConnection()->query($query);
$peliculas = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Peliculas</title>
    <style>
        body {
            padding-top: 80px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
            <div class="container">
                <a class="navbar-brand">Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="dash.php">Inicio</a>
                    </div>
                </div>
                <a class="nav-link ml-auto p-2 text-white" href="salir.php">Salir de la sesión</a>
            </div>
        </nav>
    </header>

    <section style="width:800px; margin:0 auto;">
    <a href='agregarpelicula.php' class='btn btn-primary'>Nueva Pelicula</a>
        <table class="table" >
            <tr>
                <th >ID</th>
                <th>Nombre</th>
                <th>Genero</th>
                <th>Duracion</th>
                <th>Opciones</th>
                <th></th>
            </tr>
            <tbody>
                <?php
            foreach ($peliculas as $pelicula) {
                    echo "<tr>";
                    echo "<td>".$pelicula['id']."</td>";
                    echo "<td>".$pelicula['nombre']."</td>";
                    echo "<td>".$pelicula['genero']."</td>";
                    echo "<td>".$pelicula['duracion']."</td>";
                    echo "<td><form action='editarpelicula.php' method='POST'>
                    <input type='text' name='id' value='".$pelicula['id']."' hidden >
                <input type='submit' class='btn btn-success' value='Modificar'>
                </form></td>";

                    echo "<td><form action='eliminarpelicula.php' method='POST'>
                            <input type='text' name='id' value='".$pelicula ['id']."' hidden >
                        <input type='submit' class='btn btn-danger' value='Eliminar'>
                        </form></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </section>
</body>
</html>