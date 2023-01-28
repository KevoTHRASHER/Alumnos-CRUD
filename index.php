<?php

session_start();
require('conexion.php');
?>

<?php include('templates/header.php'); ?>

<?php
if(isset($_SESSION['mensaje'])) {
    if(!$_SESSION['error']) {
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
            <h4>Lista de Estudiantes
                <a class="btn btn-success float-end" href="crear-estudiantes.php" >Agregar Nuevo</a>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>SEMESTRE</th>
                        <th>PAIS</th>
                        <th>ACCIONES</th>
                    </tr>
                    <?php

                    $res = $conexion->query("SELECT E.*,P.nombre as pais FROM `estudiantes` E INNER JOIN paises P ON P.id=E.id_pais;");

                    while($fila = $res->fetch_object()) {

                    ?>
                    <tr>
                        <td><?php echo $fila->id; ?></td>
                        <td><?php echo $fila->nombres; ?></td>
                        <td><?php echo $fila->apellidos; ?></td>
                        <td><?php echo $fila->semestre; ?></td>
                        <td><?php echo $fila->pais; ?></td>
                        <td>
                            <a href="editar-estudiantes.php?id=<?php echo md5($fila->id); ?>" class="btn btn-primary">Editar
                            </a>
                            <a href="detalle-estudiantes.php?id=<?php echo md5($fila->id); ?>" class="btn btn-success">Ver
                            </a>
                            <form action="guardar.php" method="POST" class="d-inline">
                                <button class="btn btn-danger" type="submit" name="botonEliminarEstudiante" value="<?php echo md5($fila->id); ?>">Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php include('templates/footer.php'); ?>
