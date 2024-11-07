<?php

namespace App\views;

use App\controllers\TareasController;

class TareasViews
{
    private $controller;

    function __construct()
    {
        $this->controller = new TareasController();
    }

    function getTable()
    {
        $rows = '';
        $tareas = $this->controller->getAlltareas();
        // usort($tareas, function ($a, $b) {
        //     return strcmp($a->get('fechaEstimadaFinalizacion'), $b->get('fechaEstimadaFinalizacion'));
        // });

        if (count($tareas) > 0) {
            foreach ($tareas as $tarea) {
                $id = $tarea->get('id');
                $rows .= '<tr>';
                $rows .= '   <td>' . $tarea->get('titulo') . '</td>';
                $rows .= '   <td>' . $tarea->get('descripcion') . '</td>';
                $rows .= '   <td>' . $tarea->get('fechaEstimadaFinalizacion') . '</td>';
                $rows .= '   <td>' . $tarea->get('fechaFinalizacion') . '</td>';
                $rows .= '   <td>' . $tarea->get('creadorTarea') . '</td>';
                $rows .= '   <td>' . $tarea->get('observaciones') . '</td>';
                $rows .= '   <td>' . $tarea->get('idEmpleado') . '</td>';
                $rows .= '   <td>' . $tarea->get('idEstado') . '</td>';
                $rows .= '   <td>' . $tarea->get('idPrioridad') . '</td>';
                $rows .= '   <td>' . $tarea->get('created_at') . '</td>';
                $rows .= '   <td>' . $tarea->get('updated_at') . '</td>';
                $rows .= '   <td>';
                $rows .= '      <a href="formularioTarea.php?cod=' . $id . '">modificar</a>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '      <button onClick="eliminarTarea(' . $id . ')">Borrar</button>';
                $rows .= '   </td>';
                $rows .= '</tr>';
            }
        } else {
            $rows .= '<tr>';
            $rows .= '   <td colspan="12">No hay datos registrados</td>';
            $rows .= '</tr>';
        }
        $table = '<table>';
        $table .= '  <thead>';
        $table .= '     <tr>';
        $table .= '         <th>Titulo</th>';
        $table .= '         <th>Descripcion</th>';
        $table .= '         <th>Fecha Estimada de Finalización</th>';
        $table .= '         <th>Fecha de Finalización</th>';
        $table .= '         <th>Creador</th>';
        $table .= '         <th>Observaciones</th>';
        $table .= '         <th>Empleado</th>';
        $table .= '         <th>Estado</th>';
        $table .= '         <th>Prioridad</th>';
        $table .= '         <th>Creado</th>';
        $table .= '         <th>Actualizado</th>';
        $table .= '         <th>Modificar</th>';
        $table .= '         <th>Borrar</th>';
        $table .= '     </tr>';
        $table .= '  </thead>';
        $table .= ' <tbody>';
        $table .=  $rows;
        $table .= ' </tbody>';
        $table .= '</table>';

        return $table;
    }

    function getFormTarea($data)
    {
        $datos = null;
        $form = '<form action="confirmarRegistro.php" method="post">';
        if (!empty($data['cod'])) {
            $form .= '<input type="hidden" name="cod" value="' . $data['cod'] . '">';
            $datos = $this->controller->getTarea($data['cod']);
        }
        $titulo = empty($datos) ? '' : $datos->get('titulo');
        $descripcion = empty($datos) ? '' : $datos->get('descripcion');
        $fechaEstimadaFinalizacion = empty($datos) ? '' : $datos->get('fechaEstimadaFinalizacion');
        $fechaFinalizacion = empty($datos) ? '' : $datos->get('fechaFinalizacion');
        $creadorTarea = empty($datos) ? '' : $datos->get('creadorTarea');
        $observaciones = empty($datos) ? '' : $datos->get('observaciones');
        $idEmpleado = empty($datos) ? '' : $datos->get('idEmpleado');
        $idEstado = empty($datos) ? '' : $datos->get('idEstado');
        $idPrioridad = empty($datos) ? '' : $datos->get('idPrioridad');

        $form .= '      <input type="text" name="titulo" placeholder="Título" value="'. $titulo .'" required>';
        $form .= '      <textarea name="descripcion" placeholder="Descripción" value="'. $descripcion .'" ></textarea>';
        $form .= '      <input type="date" name="fechaEstimadaFinalizacion" value="'. $fechaEstimadaFinalizacion .'" >';
        $form .= '      <input type="date" name="fechaFinalizacion" value="'. $fechaFinalizacion .'" >';
        $form .= '      <input type="text" name="creadorTarea" placeholder="Creador" value="'. $creadorTarea .'" >';
        $form .= '      <textarea name="observaciones" placeholder="Observaciones" value="'. $observaciones .'" ></textarea>';
        $form .= '      <input type="number" name="idEmpleado" placeholder="ID Empleado"value="'. $idEmpleado .'" required>';
        $form .= '      <input type="number" name="idEstado" placeholder="ID Estado" value="'. $idEstado .'" required>';
        $form .= '      <input type="number" name="idPrioridad" placeholder="ID Prioridad" value="'. $idPrioridad .'" required>';
        $form .= '      <button type="submit">Guardar Tarea</button>';
        return $form;
    }

    function getFormTareaModificar()
    {
        $datos = $this->controller->getTarea($_GET['cod']);
        $titulo = empty($datos) ? : $datos->get('titulo');
        $descripcion = empty($datos) ? :  $datos->get('descripcion');
        $fechaEstimadaFinalizacion = empty($datos) ? :  $datos->get('fechaEstimadaFinalizacion');
        $fechaFinalizacion = empty($datos) ? :  $datos->get('fechaFinalizacion');
        $creadorTarea = empty($datos) ? :  $datos->get('creadorTarea');
        $observaciones = empty($datos) ? :  $datos->get('observaciones');
        $idEmpleado = empty($datos) ? :  $datos->get('idEmpleado');
        $idEstado = empty($datos) ? :  $datos->get('idEstado');
        $idPrioridad = empty($datos) ? :  $datos->get('idPrioridad');

        $form = '<form action="confirmarRegistro.php" method="post">';
        $form .= '      <input type="text" name="titulo" placeholder="Título" value="'. $titulo .'" required>';
        $form .= '      <textarea name="descripcion" placeholder="Descripción" value="'. $descripcion .'" ></textarea>';
        $form .= '      <input type="date" name="fechaEstimadaFinalizacion" value="'. $fechaEstimadaFinalizacion .'" >';
        $form .= '      <input type="date" name="fechaFinalizacion" value="'. $fechaFinalizacion .'" >';
        $form .= '      <input type="text" name="creadorTarea" placeholder="Creador" value="'. $creadorTarea .'" >';
        $form .= '      <textarea name="observaciones" placeholder="Observaciones" value="'. $observaciones .'" ></textarea>';
        $form .= '      <input type="number" name="idEmpleado" placeholder="ID Empleado"value="'. $idEmpleado .'" required>';
        $form .= '      <input type="number" name="idEstado" placeholder="ID Estado" value="'. $idEstado .'" required>';
        $form .= '      <input type="number" name="idPrioridad" placeholder="ID Prioridad" value="'. $idPrioridad .'" required>';
        $form .= '      <button type="submit">Guardar Tarea</button>';
        return $form;
    }

    function getMsgNewTarea($datosFormulario)
    {
        $datos = [
            "titulo" => $datosFormulario['titulo'],
            "descripcion" => $datosFormulario['descripcion'],
            "fechaEstimadaFinalizacion" => $datosFormulario['fechaEstimadaFinalizacion'],
            "fechaFinalizacion" => $datosFormulario['fechaFinalizacion'],
            "creadorTarea" => $datosFormulario['creadorTarea'],
            "observaciones" => $datosFormulario['observaciones'],
            "idEmpleado" => $datosFormulario['idEmpleado'],
            "idEstado" => $datosFormulario['idEstado'],
            "idPrioridad" => $datosFormulario['idPrioridad'],
        ];
        $confirmarAccion = $this->controller->saveTarea($datos);
        $msg = '<h2>Resultado de la operación</h2>';
        if ($confirmarAccion) {
            $msg .= '<p>La tarea se guardo correctamente.</p>';
        } else {
            $msg .= '<p>No se pudo guardar la tarea</p>';
        }
        return $msg;
    }

    function getMsgUpdateTarea($datosFormulario)
    {
        $datos = [
            'id' => $datosFormulario['cod'],
            "titulo" => $datosFormulario['titulo'],
            "descripcion" => $datosFormulario['descripcion'],
            "fechaEstimadaFinalizacion" => $datosFormulario['fechaEstimadaFinalizacion'],
            "fechaFinalizacion" => $datosFormulario['fechaFinalizacion'],
            "creadorTarea" => $datosFormulario['creadorTarea'],
            "observaciones" => $datosFormulario['observaciones'],
            "idEmpleado" => $datosFormulario['idEmpleado'],
            "idEstado" => $datosFormulario['idEstado'],
            "idPrioridad" => $datosFormulario['idPrioridad'],
        ];
        $confirmarAccion = $this->controller->updateTarea($datos);
        $msg = '<h2>Resultado de la operación</h2>';
        if ($confirmarAccion) {
            $msg .= '<p>Datos del contacto guardados.</p>';
        } else {
            $msg .= '<p>No se pudo guardar la información del contacto</p>';
        }
        return $msg;
    }

    function getMsgDeleteTarea($id){
        $confirmarAccion = $this->controller->deleteTarea($id);
        $msg = '<h2>Resultado de la operación</h2>';
        if ($confirmarAccion) {
            $msg .= '<p>Tarea eliminada correctamente.</p>';
        } else {
            $msg .= '<p>No se pudo eliminar la tarea</p>';
        }
        return $msg;
    }
}
