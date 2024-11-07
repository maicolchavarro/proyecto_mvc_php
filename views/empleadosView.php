<?php
namespace App\views;

use App\controllers\EmpleadosController;

class EmpleadosViews{
    private $controller;

    function __construct()
    {
        $this->controller = new EmpleadosController();
    }

    function getTable()
    {
        $rows = '';
        $empleados = $this->controller->getAllempleados();
        if (count($empleados) > 0) {
            foreach ($empleados as $empleado) {
                $id = $empleado->get('id');
                $rows .= '<tr>';
                $rows .= '   <td>' . $empleado->get('nombre') . '</td>';
                $rows .= '   <td>';
                $rows .= '   <td>';
                $rows .= '      <a href="formularioContacto.php?cod=' . $id . '">modificar</a>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '      <button onClick="eliminarContacto(' . $id . ')">Borrar</button>';
                $rows .= '   </td>';
                $rows .= '</tr>';
            }
        } else {
            $rows .= '<tr>';
            $rows .= '   <td colspan="3">No hay datos registrados</td>';
            $rows .= '</tr>';
        }
        $table = '<table>';
        $table .= '  <thead>';
        $table .= '     <tr>';
        $table .= '         <th>Nombre</th>';
        $table .= '     </tr>';
        $table .= '  </thead>';
        $table .= ' <tbody>';
        $table .=  $rows;
        $table .= ' </tbody>';
        $table .= '</table>';
        return $table;
    }
}
?>