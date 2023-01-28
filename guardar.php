<?php
session_start();
require('conexion.php');

if(isset($_POST['botonGuardarEstudiante'])) {

    $nombre = mysqli_real_escape_string($conexion, $_POST['nombreEstudiante']);
    $apellido = mysqli_real_escape_string($conexion, $_POST['apellidoEstudiante']);
    $semestre = mysqli_real_escape_string($conexion, $_POST['semestreEstudiante']);
    $pais = mysqli_real_escape_string($conexion, $_POST['paisEstudiante']);

    $sql = "INSERT INTO estudiantes(nombres,apellidos,semestre,id_pais) VALUES ('$nombre','$apellido','$semestre','$pais')";

    $res = $conexion->query($sql);

    if($res) {
        $_SESSION['mensaje'] = "Estudiante Registrado Correctamente";
        $_SESSION['error'] = false;
    } else {
        $_SESSION['mensaje'] = "No se logro registrar el Estudiante";
        $_SESSION['error'] = true;
    }
    header("Location:crear-estudiantes.php");
    exit;

} else if(isset($_POST['botonActualizarEstudiante'])) {

    $id = mysqli_real_escape_string($conexion, $_POST['id']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombreEstudiante']);
    $apellido = mysqli_real_escape_string($conexion, $_POST['apellidoEstudiante']);
    $semestre = mysqli_real_escape_string($conexion, $_POST['semestreEstudiante']);
    $pais = mysqli_real_escape_string($conexion, $_POST['paisEstudiante']);

    $sql = "UPDATE estudiantes SET nombres='$nombre',apellidos='$apellido',semestre='$semestre',id_pais='$pais' WHERE md5(id)='$id'";

    $res = $conexion->query($sql);

    if($res) {
        $_SESSION['mensaje'] = "Estudiante Actualizado Correctamente";
        $_SESSION['error'] = false;
    } else {
        $_SESSION['mensaje'] = "No se logro actualizar el Estudiante";
        $_SESSION['error'] = true;
    }
    header("Location:index.php");
    exit;
} else if(isset($_POST['botonEliminarEstudiante'])) {

    $id = mysqli_real_escape_string($conexion, $_POST['botonEliminarEstudiante']);

    $sql = "DELETE FROM estudiantes WHERE md5(id)='$id'";

    $res = $conexion->query($sql);

    if($res) {
        $_SESSION['mensaje'] = "Estudiante Eliminado Correctamente";
        $_SESSION['error'] = false;
    } else {
        $_SESSION['mensaje'] = "No se logro eliminar el Estudiante";
        $_SESSION['error'] = true;
    }
    header("Location:index.php");
    exit;
}



?>
