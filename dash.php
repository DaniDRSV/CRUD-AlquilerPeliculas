<?php 
session_start();

if($_SESSION['usuario']=== null){
    header('Location:index.php');
}

include_once 'conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena); 
$conexion->conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dashboard</title>
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

    <div class="container mt-5">
        <h1 class="display-4 text-center">Bienvenido: <?php echo $_SESSION['usuario'] ?></h1>
        <p class="lead text-center">Elije una opcion para trabajar</p>
    </div>
    <section style="width:800px; margin:0 auto;">
      <div class="container text-center">
        <div class="row">
          <div class="col">
            <div class="card" style="width: 12rem;">
              <a href="alquileres.php" style="text-decoration: none; color: black; ">
                <img src="./img/alquiler.png" class="card-img-top" alt="Alquiler">
                <div class="card-body">
                  <h5 class="card-title">Alquileres</h5>
                </div>
              </a>
            </div>
          </div>
          <div class="col">
            <div class="card" style="width: 12rem;">
              <a href="clientes.php" style="text-decoration: none; color: black; ">
                <img src="./img/clientes_2.png" class="card-img-top" alt="Clientes">
                <div class="card-body">
                  <h5 class="card-title">Clientes</h5>
                </div>
              </a>
            </div>
          </div>
          <div class="col">
            <div class="card" style="width: 12rem;">
              <a href="peliculas.php" style="text-decoration: none; color: black; ">
                <img src="./img/peliculas.png" class="card-img-top" alt="Peliculas">
                <div class="card-body">
                  <h5 class="card-title">Peliculas</h5>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>

    </section>
</body>
</html>