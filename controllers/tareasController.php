<?php

namespace App\controllers;

use App\models\entities\Tarea;

class TareasController
{
    function getAllTareas($titulo, $fechaInicio, $fechaFin, $idPrioridad, $idEmpleado, $descripcion, $idEstado)
    {
        if (!empty($titulo) || !empty($fechaInicio) || !empty($fechaFin)) {
            return Tarea::filtrer($titulo, $fechaInicio, $fechaFin, $idPrioridad, $idEmpleado, $descripcion);
        } elseif(!empty($idEstado))
        {
            return Tarea::agrupar($idEstado);
        } else {
            return Tarea::all();
        }
    }

    function saveTarea($datos)
    {
        $tarea = new Tarea();
        $tarea->set('titulo', $datos['titulo']);
        $tarea->set('descripcion', $datos['descripcion']);
        $tarea->set('fechaEstimadaFinalizacion', $datos['fechaEstimadaFinalizacion']);
        $tarea->set('fechaFinalizacion', $datos['fechaFinalizacion']);
        $tarea->set('creadorTarea', $datos['creadorTarea']);
        $tarea->set('observaciones', $datos['observaciones']);
        $tarea->set('idEmpleado', $datos['idEmpleado']);
        $tarea->set('idEstado', $datos['idEstado']);
        $tarea->set('idPrioridad', $datos['idPrioridad']);
        return $tarea->save();
    }

    function getTarea($id)
    {
        return Tarea::find($id);
    }

    function updateTarea($datos)
    {
        $tarea = new Tarea();
        $tarea->set('id', $datos['id']);
        $tarea->set('titulo', $datos['titulo']);
        $tarea->set('descripcion', $datos['descripcion']);
        $tarea->set('fechaEstimadaFinalizacion', $datos['fechaEstimadaFinalizacion']);
        $tarea->set('fechaFinalizacion', $datos['fechaFinalizacion']);
        $tarea->set('creadorTarea', $datos['creadorTarea']);
        $tarea->set('observaciones', $datos['observaciones']);
        $tarea->set('idEmpleado', $datos['idEmpleado']);
        $tarea->set('idEstado', $datos['idEstado']);
        $tarea->set('idPrioridad', $datos['idPrioridad']);
        return $tarea->update();
    }

    function deleteTarea($id)
    {
        $tarea = new Tarea();
        $tarea->set('id', $id);
        return $tarea->delete();
    }
}
