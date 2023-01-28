<?php

session_start();
require('conexion.php');

?>

<?php include('templates/header.php'); ?>

    <?php
    if(isset($_SESSION['mensaje'])){
        if(!$_SESSION['error']){
            ?>
            <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['mensaje'];?>
            </div>
        <?php
        }else{
            ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['mensaje'];?>
            </div>
        <?php
        }
        unset($_SESSION['mensaje']);
    }

    ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>Registrar Estudiantes
                <a class="btn btn-danger float-end" href="index.php" >Regresar</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="guardar.php" method="POST">
                <div class="mb-3">
                    <label for="">Nombre Estudiante</label>
                    <input type="text" name="nombreEstudiante" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Apellido Estudiante</label>
                    <input type="text" name="apellidoEstudiante" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Semestre Estudiante</label>
                    <input type="number" name="semestreEstudiante" class="form-control">
                 </div>
                <div class="mb-3">
                    <label for="">País</label>
                    <select name="paisEstudiante" id="" class="form-select">
                        <option value="">Selecciona un pais</option>
                        <?php
                            $res = $conexion->query("SELECT * FROM `paises` order by nombre");

                            while($fila = $res->fetch_object()) {
                                ?>
                                    <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" name="botonGuardarEstudiante" class="btn btn-primary float-end">Guardar Estudiante</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('templates/footer.php'); ?>
