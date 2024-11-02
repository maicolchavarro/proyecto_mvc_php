<?php
// Elimina o comenta la línea de redirección
// header('location: public/inicio.php');

require '../models/db/tareasDb.php';
require '../models/queries/tareasQueries.php';
require '../models/entities/tarea.php';
require '../controllers/tareasController.php';
require '../views/tareasView.php';

use App\views\TareasViews;

$tareasView = new TareasViews();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas</title>
</head>

<body>
    <header>
        <h1>Gestión de Tareas</h1>
    </header>
    <section>
        <br>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
            <?php echo $tareasView->getTable(); ?>
        </table>
    </section>
    <a href="crearTarea.php">Crear tarea</a>
</body>
</html>