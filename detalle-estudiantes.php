<?php

session_start();
require('conexion.php');
?>

<?php include('templates/header.php'); ?>

<?php

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexion,$_GET['id']);
    $sql = "SELECT E.*,P.nombre as pais FROM `estudiantes` E INNER JOIN paises P ON P.id=E.id_pais WHERE md5(E.id)='$id'";
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
                    <label for=""><b>Nombre:</b></label>
                    <?php echo $datos->nombres; ?>
                </div>
                <div class="mb-3">
                    <label for=""><b>Apellido:</b></label>
                    <?php echo $datos->apellidos; ?>
                </div>
                <div class="mb-3">
                    <label for=""><b>Semestre</b></label>
                    <?php echo $datos->semestre; ?> semestre
                 </div>
                <div class="mb-3">
                    <label for=""><b>País:</b></label>
                    <?php echo $datos->pais; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('templates/footer.php'); ?>
