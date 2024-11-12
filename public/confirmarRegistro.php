<?php
require '../controllers/empleadosController.php';
require '../controllers/tareasController.php';
require '../controllers/estadosController.php';
require '../controllers/prioridadesController.php';
require '../models/db/tareasDb.php';
require '../models/entities/empleados.php';
require '../models/entities/tareas.php';
require '../models/entities/estados.php';
require '../models/entities/prioridades.php';
require '../models/queries/empleadosQueries.php';
require '../models/queries/tareasQueries.php';
require '../models/queries/estadosQueries.php';
require '../models/queries/prioridadesQueries.php';
require '../views/empleadosView.php';
require '../views/tareasView.php';
require '../views/modalsView.php';

use App\views\TareasViews;

$tareasViews = new TareasViews();
$datosFormulario = $_POST;
$msg = empty($datosFormulario['cod'])
  ? $tareasViews->getMsgNewTarea($datosFormulario)
  : $tareasViews->getMsgUpdateTarea($datosFormulario);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar acción</title>
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