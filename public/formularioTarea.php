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
$title = empty($_GET['cod'])?'Registrar tarea':'Modificar tarea';
$form = $tareasViews->getFormTarea($_GET);
?>
<!DOCTYPE html> 
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario tareas</title>
    <link rel="stylesheet" href="css/formulario.css">

</head>

<body>
    <header>
        <h1><?php echo $title;?></h1>
    </header>
    <section>
        <?php echo $form;?>
    </section>
    <a href="inicio.php">Volver</a>
</body>

</html>