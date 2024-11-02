<?php
namespace App\views;

use App\controllers\TareasController;

class TareasViews {
    private $controller;

    public function __construct() {
        $this->controller = new TareasController();
    }

    public function getTable() {
        $filas = '';
        $empleados = $this->controller->getAllTareas();

        if (count($empleados) > 0) {
            foreach ($empleados as $empleado) {
                $id = $empleado->get('id');
                $nombre = $empleado->get('nombre');
                $filas .= '<tr>';
                $filas .= '<td>' . $id . '</td>';
                $filas .= '<td>' . $nombre . '</td>';
                $filas .= '</tr>';
            }
        } else {
            $filas .= '<tr>';
            $filas .= '<td colspan="2">No hay datos registrados</td>';
            $filas .= '</tr>';
        }
        return $filas;
    }

    function getformTarea()
{
    $empleados = $this->controller->getAllTareas();

    $form = '<form action="crearTarea.php" method="post">';

    $form .= '  <div>';
    $form .= '      <label>Título de la tarea</label>';
    $form .= '      <input type="text" name="tituloTarea" required>';
    $form .= '  </div>';
    $form .= '  <div>';
    $form .= '      <label for="descripcionTarea">Descripción</label>';
    $form .= '      <textarea id="descripcionTarea" name="descripcionTarea" rows="4" required></textarea>';
    $form .= '  </div>';
    $form .= '  <div>';
    $form .= '      <label for="creadorTarea">Creador de la tarea</label>';
    $form .= '      <select id="creadorTarea" name="creadorTarea" required>';
    foreach ($empleados as $empleado) {
        $nombre = htmlspecialchars($empleado->get('nombre'));
        $id = htmlspecialchars($empleado->get('id'));
        $form .= '          <option value="' . $id . '">' . $nombre . '</option>';
    }
    
    $form .= '      </select>';
    $form .= '  </div>';
    $form .= '  <div>';
    $form .= '      <button type="submit">Guardar</button>';
    $form .= '  </div>';
    $form .= '</form>';

    return $form;
}

}
