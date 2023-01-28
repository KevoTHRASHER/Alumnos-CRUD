<?php

session_start();
require('conexion.php');
?>

<?php include('templates/header.php'); ?>

<?php

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexion,$_GET['id']);
    $sql = "SELECT * FROM `estudiantes` WHERE md5(id)='$id'";
    $res = $conexion->query($sql);

    if($res->num_rows>0) {
        $datos = $res->fetch_object();
    } else {
        $_SESSION['mensaje'] = "No existe el estudiante";
        $_SESSION['error'] = true;
        header("Location:index.php");
        exit;
    }
}

?>

    <?php
    if(isset($_SESSION['mensaje'])){
        if(!$_SESSION['error']){
            ?>
            <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['mensaje'];?>
            </div>
        <?php
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['mensaje'];?>
            </div>
        <?php
        }
        unset($_SESSION['mensaje']);
        unset($_SESSION['error']);
    }

    ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>Editar Estudiantes
                <a class="btn btn-danger float-end" href="index.php" >Regresar</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="guardar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>" >
                <div class="mb-3">
                    <label for="">Nombre Estudiante</label>
                    <input type="text" name="nombreEstudiante" class="form-control" value="<?php echo $datos->nombres; ?> ">
                </div>
                <div class="mb-3">
                    <label for="">Apellido Estudiante</label>
                    <input type="text" name="apellidoEstudiante" class="form-control" value="<?php echo $datos->apellidos; ?> ">
                </div>
                <div class="mb-3">
                    <label for="">Semestre Estudiante</label>
                    <input type="text" name="semestreEstudiante" class="form-control" value="<?php echo $datos->semestre; ?> ">
                 </div>
                <div class="mb-3">
                    <label for="">País</label>
                    <select name="paisEstudiante" id="" class="form-select">
                        <option value="">Selecciona un pais</option>
                        <?php
                            $res = $conexion->query("SELECT * FROM `paises` order by nombre");

                            while($fila = $res->fetch_object()) {
                                ?>
                                    <option <?php if($fila->id == $datos->id_pais) { echo " selected ";} ?> value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" name="botonActualizarEstudiante" class="btn btn-warning float-end">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('templates/footer.php'); ?>
