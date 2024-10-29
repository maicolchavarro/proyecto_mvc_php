<?php

namespace App\views;

use App\controllers\tareasController;

class tareasViews
{
    private $controller;

    function __construct()
    {
        $this->controller = new tareasController();
    }

    function getTable(){
        $rows = '';
        $empleados = $this->controller->getAllTareas();
        if (count($empleados) > 0) {
            foreach ($empleados as $tarea) {
                $id = $tarea->get('id');
                $rows .= '<tr>';
                $rows .= '   <td>' . $tarea->get('nombre') . '</td>';

    }
} else {
    $rows .= '<tr>';
    $rows .= '   <td colspan="3">No hay datos registrados</td>';
    $rows .= '</tr>';
}
}
}