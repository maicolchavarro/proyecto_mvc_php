<?php
require '../models/db/tareasDb.php';
require '../models/queries/tareasQueries.php';
require '../models/entities/tarea.php';
require '../controllers/tareasController.php';
require '../views/tareasView.php';

use App\views\tareasViews;

$empleadosViews = new TareasViews();
$form = $empleadosViews->getformTarea($_GET);   
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear tarea</title>
</head>

<body>
    <section>
        <h1>Crear tarea</h1>
        <section>
            <?php echo $form;?>
        </section>
        <!-- <form action="crearTarea">
            <label for="tituloTarea">Título de la tarea</label>
            <input type="text" id="tituloTarea" name="tituloTarea" required>
            <br>

            <label for="descripcionTarea">Descripción</label>
            <textarea id="descripcionTarea" name="descripcionTarea" rows="4" required></textarea>
            <br>

            <label for="fechaCreacion">Fecha de creacion</label>
            <input type="date" id="fechaCreacion" name="fechaCreacion" required>
            <br>

            <label for="fechaModificacion">Fecha de modificacion</label>
            <input type="date" id="fechaModificacion" name="fechaModificacion">
            <br>

            <label for="estado">Estado</label>
            <select id="estado" name="estado" required>
                <option value="pendiente">Pendiente</option>
                <option value="proceso">En proceso</option>
                <option value="terminada">Terminada</option>
                <option value="impedimento">En impedimento</option>
            </select>
            <br>

            <label for="fechaEstimadaFinaliza">Fecha estimada de finalizacion</label>
            <input type="date" id="fechaEstimadaFinaliza" name="fechaEstimadaFinaliza" required>
            <br>

            <label for="fechaFinalizacion">Fecha estimada de finalizacion</label>
            <input type="date" id="fechaFinalizacion" name="fechaFinalizacion" required>
            <br>

            <label for="creadorTarea">Creador de la tarea</label>
            <select id="creadorTarea" name="creadorTarea" required>
                
            </select>
            <br>


            <label for="responsableTarea">Responsable de la tarea</label>
            <select id="responsableTarea" name="responsableTarea" required>

            </select>
            <br>

            <label for="prioridad">Prioridad</label>
            <select id="prioridad" name="prioridad" required>
                <option value="alta">Alta</option>
                <option value="media">Media</option>
                <option value="baja">Baja</option>
            </select>
            <br>

            <label for="observaciones">Observaciones</label>
            <input type="text" id="observaciones" name="observaciones">

            <button type="submit">Crear Tarea</button>
            <br>
        </form> -->
    </section>
    <a href="inicio.php">Volver</a>
</body>

</html>