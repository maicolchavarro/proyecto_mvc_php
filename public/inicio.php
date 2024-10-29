<?php
require '../models/db/tareasDb.php';
require '../models/queries/tareasQueries.php';
require '../models/entities/tarea.php';
require '../controllers/tareasController.php';
require '../views/tareasView.php';

use App\Views\TareasViews;

$tareasView = new TareasViews();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
    <h1>gestion de tareas</h1>
</header>
<section>
    <br>
    <?php  echo $tareasView-> getTable();?>
</section>
</body>
</html>