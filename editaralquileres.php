<?php
session_start();

if($_SESSION['usuario'] === null){
    header('Location:index.php');
}

include_once 'conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena);
$conexion->conectar();

$id= $_POST['id'];
$query = "SELECT * FROM cliente";
$statement = $conexion->getConnection()->query($query);
$cliente = $statement->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM peliculas";
$statement = $conexion->getConnection()->query($query);
$pelicula = $statement->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM alquiler  WHERE id=:id";
$statement = $conexion->getConnection()->prepare($query);
$statement->bindParam(':id', $id);
$statement->execute();
$alquiler = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Editar Alquileres</title>

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
        <a href="alquileres.php" class="btn btn-outline-primary" role="button" data-bs-toggle="button">Atras</a>
        <br><br><br>
        <h4>Editar alquiler</h4>
        <form  action="procesos.php" method="POST">
            <input type="text" name="opcion" value="2" hidden >
            <input type="text" name="id"  value="<?php echo $alquiler['id'];?>" hidden >
            <label>Fecha de entrega</label>
            <input class="form-control form-control-sm" style="width:800px;" type="date" name="fecha" value="<?php echo $alquiler['fechaEntrega'];?>">
            <br>
            <label>Cliente</label>
            <select class="form-control form-control-sm" style="width:800px;" name="cliente">
                <?php
                    foreach($cliente as $clientes){
                        if($clientes['id']== $alquiler['id_cliente']){
                            echo "<option value='".$clientes['id']."' selected>".$clientes['nombre']."</option>";
                        }else{
                            echo "<option value='".$clientes['id']."' >".$clientes['nombre']."</option>";
                        }
                    
                    }
                ?>
            </select>
            <br>
            <label>Pelicula</label>
            <select class="form-control form-control-sm" style="width:800px;" name="pelicula">
                <?php
                    foreach($pelicula as $peliculas){
                        if($peliculas['id']== $alquiler['id_pelicula']){
                            echo "<option value='".$peliculas['id']."' selected>".$peliculas['nombre']."</option>";
                        }else{
                            echo "<option value='".$peliculas['id']."' >".$peliculas['nombre']."</option>";
                        }
                        
                    }
                ?>
            </select>
            <br>
            <label>Costo</label>
            <input class="form-control form-control-sm" style="width:800px;" type="text" name="costo" placeholder="$0.00" value="<?php echo $alquiler['costo'];?>">
            <br>
            <input type="submit" value="Editar" class="btn btn-primary">
        </form>
    </div>
</body>
</html>