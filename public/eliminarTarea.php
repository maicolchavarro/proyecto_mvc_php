<?php
require '../controllers/empleadosController.php';
require '../controllers/tareasController.php';
require '../models/db/tareasDb.php';
require '../models/entities/empleados.php';
require '../models/entities/tareas.php';
require '../models/queries/empleadosQueries.php';
require '../models/queries/tareasQueries.php';
require '../views/empleadosView.php';
require '../views/tareasView.php';

use App\views\TareasViews;

$tareasViews = new TareasViews();
$msg = $tareasViews->getMsgDeleteTarea($_POST['cod']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Tarea</title>
</head>
<body>
    <header>
        <h1>Estado de acción</h1>
    </header>
    <section>
        <?php echo $msg;?>
        <br>
        <a href="inicio.php">Volver al inicio</a>
    </section>
</body>
</html>