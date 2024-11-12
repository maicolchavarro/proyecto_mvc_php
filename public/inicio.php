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

use App\models\entities\Empleado;
use App\models\entities\Estado;
use App\models\entities\Prioridad;
use App\views\EmpleadosViews;
use App\views\ModalsView;
use App\views\TareasViews;

$empleadosView = new EmpleadosViews();
$tareasView = new TareasViews();
$modalsView = new ModalsView();
$prioridades = Prioridad::all();
$empleados = Empleado::all();
$estados = Estado::all();

$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$fechaInicio = isset($_GET['fechaInicio']) ? $_GET['fechaInicio'] : '';
$fechaFin = isset($_GET['fechaFin']) ? $_GET['fechaFin'] : '';
$idPrioridad = isset($_GET['idPrioridad']) ? $_GET['idPrioridad'] : '';
$idEmpleado = isset($_GET['idEmpleado']) ? $_GET['idEmpleado'] : '';
$descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : '';
$idEstado = isset($_GET['idEstado']) ? $_GET['idEstado'] : '';
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
    <h1>Lista de tareas</h1>
    <a href="formularioTarea.php">Crear tarea</a>
    <br>

    <button onclick="mostrarVentana()">Filtrar</button>
    <div class="fondoVentana" id="fondoVentana">
        <div class="ventana">
            <span class="cerrarVentana" onclick="cerrarVentana()">X</span>
            <h2>Filtrar por:</h2>
            <form id="formularioFiltro" action="#">
                <label for="fechaInicio">Fecha de inicio</label>
                <input type="date" id="fechaInicio" name="fechaInicio">

                <label for="fechaFin">Fecha de fin</label>
                <input type="date" id="fechaFin" name="fechaFin">

                <label for="idPrioridad">Ingrese la prioridad de la tarea</label>
                <select name="idPrioridad" id="idPrioridad">
                    <option value="">Selecciona una prioridad</option>
                    <?php
                    foreach ($prioridades as $prioridad) {
                        $selected = ($prioridad->id == $idPrioridad) ? 'selected' : '';
                        echo '<option value="' . $prioridad->id . '" ' . $selected . '>' . $prioridad->nombre . '</option>';
                    }
                    ?>
                </select>

                <label for="idEmpleado">Ingrese la persona responsable de la tarea</label>
                <select name="idEmpleado" id="idEmpleado">
                    <option value="">Selecciona un empleado</option>
                    <?php
                    foreach ($empleados as $empleado) {
                        $selected = ($empleado->id == $idEmpleado) ? 'selected' : '';
                        echo '<option value="' . $empleado->id . '" ' . $selected . '>' . $empleado->nombre . '</option>';
                    }
                    ?>
                </select>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo">

                <label for="descripcion">Descripcion:</label>
                <input type="text" id="descripcion" name="descripcion">

                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>

    <button onclick="mostrarVentanaAgrupar()">Agrupar</button>
    <div class="fondoVentanaAgrupar" id="fondoVentanaAgrupar">
        <div class="ventanaAgrupar">
            <span class="cerrarVentanaAgrupar" onclick="cerrarVentanaAgrupar()">X</span>
            <h2>Agrupar por:</h2>
            <form id="formularioAgrupar" action="#">
                <label for="idEstado">Ingrese el estado de la tarea</label>
                <select name="idEstado" id="idEstado">
                    <option value="">Selecciona un estado</option>
                    <?php
                    foreach ($estados as $estado) {
                        $selected = ($estado->id == $idEstado) ? 'selected' : '';
                        echo '<option value="' . $estado->id . '" ' . $selected . '>' . $estado->nombre . '</option>';
                    }
                    ?>
                </select>

                <button type="submit">Agrupar</button>
            </form>
        </div>
    </div>


    <form action="inicio.php">
        <button type="submit">Limpiar</button>
    </form>

    <div>
        <?php
        echo $tareasView->getTable($titulo, $fechaInicio, $fechaFin, $idPrioridad, $idEmpleado, $descripcion, $idEstado);
        ?>
    </div>
    <?php
    echo $modalsView->getConfirmationModal(
        'tareaEliminarModal',
        'tareaForm',
        'eliminarTarea.php'
    )
    ?>

    <script src="js/tareas.js"></script>
</body>

</html>