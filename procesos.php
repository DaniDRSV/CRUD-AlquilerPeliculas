<?php
session_start();

if($_SESSION['usuario']=== null){
    header('Location:index.php');
}

include_once 'conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena);
$conexion->conectar();

$opcion= $_POST['opcion'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$dui = $_POST['dui'];
$genero = $_POST['genero'];
$duracion = $_POST['duracion'];
$fecha= $_POST['fecha'];
$cliente= $_POST['cliente'];
$pelicula= $_POST['pelicula'];
$costo= $_POST['costo'];
$id= $_POST['id'];

if( $opcion== 1)
{
    try {
        $query = "INSERT INTO alquiler (fechaEntrega, id_cliente, id_pelicula,costo) 
        VALUES (:fecha, :cliente, :pelicula, :costo)";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':fecha', $fecha);
        $statement->bindParam(':cliente', $cliente);
        $statement->bindParam(':pelicula', $pelicula);
        $statement->bindParam(':costo', $costo);
        $statement->execute();

        // Redireccionar o mostrar un mensaje de éxito
        header("Location: alquileres.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al insertar los datos: " . $e->getMessage();
    }

$conexion->desconectar();

}else if($opcion == 2){
    try {
        $query = "UPDATE alquiler 
        SET fechaEntrega=:fecha, id_cliente=:cliente, id_pelicula=:pelicula,costo=:costo 
        WHERE id=:id";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':fecha', $fecha);
        $statement->bindParam(':cliente', $cliente);
        $statement->bindParam(':pelicula', $pelicula);
        $statement->bindParam(':costo', $costo);
        $statement->bindParam(':id', $id);
        $statement->execute();

        // Redireccionar o mostrar un mensaje de éxito
        header("Location: alquileres.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al insertar los datos: " . $e->getMessage();
    }

$conexion->desconectar();
} elseif ($opcion == 3) {
    try {
        $query = "INSERT INTO cliente (nombre, direccion, dui) 
        VALUES (:nombre, :direccion, :dui)";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':direccion', $direccion);
        $statement->bindParam(':dui', $dui);
        $statement->execute();

        // Redireccionar o mostrar un mensaje de éxito
        header("Location: clientes.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al insertar los datos: " . $e->getMessage();
    }
} elseif ($opcion == 4) {
    try {
        $query = "UPDATE cliente 
        SET nombre=:nombre, direccion=:direccion, dui=:dui
        WHERE id=:id";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':direccion', $direccion);
        $statement->bindParam(':dui', $dui);
        $statement->bindParam(':id', $id);
        $statement->execute();

        // Redireccionar o mostrar un mensaje de éxito
        header("Location: clientes.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al insertar los datos: " . $e->getMessage();
    }

$conexion->desconectar();
} elseif ($opcion == 5) {
    try {
        $query = "INSERT INTO peliculas (nombre, genero, duracion) 
        VALUES (:nombre, :genero, :duracion)";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':genero', $genero);
        $statement->bindParam(':duracion', $duracion);
        $statement->execute();

        // Redireccionar o mostrar un mensaje de éxito
        header("Location: peliculas.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al insertar los datos: " . $e->getMessage();
    }
} elseif ($opcion == 6) {
    try {
        $query = "UPDATE peliculas 
        SET nombre=:nombre, genero=:genero, duracion=:duracion
        WHERE id=:id";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':genero', $genero);
        $statement->bindParam(':duracion', $duracion);
        $statement->bindParam(':id', $id);
        $statement->execute();

        // Redireccionar o mostrar un mensaje de éxito
        header("Location: peliculas.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al insertar los datos: " . $e->getMessage();
    }

$conexion->desconectar();
}
?>
