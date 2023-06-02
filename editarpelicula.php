<?php
session_start();

if($_SESSION['usuario'] === null){
    header('Location:index.php');
}

include_once 'conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena);
$conexion->conectar();

$id= $_POST['id'];

$query = "SELECT * FROM peliculas  WHERE id=:id";
$statement = $conexion->getConnection()->prepare($query);
$statement->bindParam(':id', $id);
$statement->execute();
$pelicula = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Editar Pelicula</title>

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
    
    <div class="container-fluid" style="width: 700px;">
        <a href="peliculas.php" class="btn btn-outline-primary" role="button" data-bs-toggle="button">Atras</a>
        <br><br><br>
        <h4>Editar pelicula</h4>
        <form action="procesos.php" method="POST">
            <input type="text" name="opcion" value="6" hidden >
            <input type="text" name="id"  value="<?php echo $pelicula['id'];?>" hidden >
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" name="nombre" class="form-control" id="inputEmail3" placeholder="Ingrese el nombre" value="<?php echo $pelicula['nombre'];?>">
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Genero</label>
                <div class="col-sm-10">
                    <input type="text" name="genero" class="form-control" id="inputPassword3" placeholder="Ingrese el genero" value="<?php echo $pelicula['genero'];?>">
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Duracion</label>
                <div class="col-sm-10">
                    <input type="time" name="duracion" class="form-control" id="inputPassword3" placeholder="Ingrese duracion" value="<?php echo $pelicula['duracion'];?>">
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="submit" value="Editar" class="btn btn-primary">
                </div>
            </div>
            
        </form>
    </div>
</body>
</html>