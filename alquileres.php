<?php 
session_start();

if($_SESSION['usuario']=== null){
    header('Location:index.php');
}

include_once 'conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena); 
$conexion->conectar();

$query = "select alquiler.id as id, fechaEntrega, cliente.nombre as cliente, cliente.dui as dui ,peliculas.nombre as pelicula, costo 
FROM alquiler
inner join cliente on alquiler.id_cliente	= cliente.id
inner join peliculas on alquiler.id_pelicula	= peliculas.id";
$statement = $conexion->getConnection()->query($query);
$alquileres = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Alquileres</title>
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
<a href='agregaralquiler.php' class='btn btn-primary'>Nuevo Alquiler</a>
    <table class="table" >
        <tr>
            <th >ID</th>
            <th>Fecha Entrega</th>
            <th>Cliente</th>
            <th>dui</th>
            <th>Pelicula</th>
            <th>Costo</th>
            <th >opciones</th>
            <th></th>
        </tr>
        <tbody>
            <?php
        foreach ($alquileres as $alquiler) {
                echo "<tr>";
                echo "<td>".$alquiler['id']."</td>";
                echo "<td>".$alquiler['fechaEntrega']."</td>";
                echo "<td>".$alquiler['cliente']."</td>";
                echo "<td>".$alquiler['dui']."</td>";
                echo "<td>".$alquiler['pelicula']."</td>";
                echo "<td>$".$alquiler['costo']."</td>";
                echo "<td><form action='editaralquileres.php' method='POST'>
                <input type='text' name='id' value='".$alquiler['id']."' hidden >
               <input type='submit' class='btn btn-success' value='Modificar'>
               </form></td>";

                echo "<td><form action='eliminaralquiler.php' method='POST'>
                        <input type='text' name='id' value='".$alquiler['id']."' hidden >
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