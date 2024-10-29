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
}
