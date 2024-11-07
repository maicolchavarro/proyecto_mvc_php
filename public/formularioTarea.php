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
$title = empty($_GET['cod'])?'Registrar tarea':'Modificar tarea';
$form = $tareasViews->getFormTarea($_GET);
?>
<!DOCTYPE html> 
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario tareas</title>
</head>

<body>
    <header>
        <h1><?php echo $title;?></h1>
    </header>
    <section>
        <?php echo $form;?>
    </section>
</body>

</html>