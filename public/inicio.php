<?php
require '../controllers/empleadosController.php';
require '../controllers/tareasController.php';
require '../models/db/tareasDb.php';
require '../models/entities/empleados.php';
require '../models/entities/tareas.php';
require '../models/queries/empleadosQueries.php';
require '../models/queries/tareasQueries.php';
require '../views/empleadosView.php';
require '../views/modalsView.php';
require '../views/tareasView.php';

use App\views\EmpleadosViews;
use App\views\ModalsView;
use App\views\TareasViews;

$empleadosView = new EmpleadosViews();
$tareasView = new TareasViews();
$modalsView = new ModalsView();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/modals.css">
</head>

<body>

    <h1>Lista de empleados</h1>
    <br>
    <div>
        <?php echo $empleadosView->getTable(); ?>
    </div>
    <h1>Lista de tareas</h1>
    <a href="formularioTarea.php">Crear tarea</a>
    <br>
    <div>
        <?php echo $tareasView->getTable(); ?>
    </div>
    <?php echo $modalsView->getConfirmationModal(
        'tareaEliminarModal',
        'tareaForm',
        'eliminarTarea.php'
    ); ?>

    <script src="js/tareas.js"></script>
</body>

</html>