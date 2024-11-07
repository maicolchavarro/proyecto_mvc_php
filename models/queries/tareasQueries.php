<?php

namespace App\models\queries;

class TareasQueries
{
    static function selectAll()
    {
        return "select * from tareas";
    }

    static function insert($tarea)
    {
        $titulo = $tarea->get('titulo');
        $descripcion = $tarea->get('descripcion');
        $fechaEstimadaFinalizacion = $tarea->get('fechaEstimadaFinalizacion');
        $fechaFinalizacion = $tarea->get('fechaFinalizacion');
        $creadorTarea = $tarea->get('creadorTarea');
        $observaciones = $tarea->get('observaciones');
        $idEmpleado = $tarea->get('idEmpleado');
        $idEstado = $tarea->get('idEstado');
        $idPrioridad = $tarea->get('idPrioridad');
        $created_at = date('Y-m-d H:i:s');
        $sql = "insert into tareas (titulo, descripcion, fechaEstimadaFinalizacion, fechaFinalizacion, creadorTarea, observaciones, idEmpleado, idEstado, idPrioridad, created_at, updated_at) values ";
        $sql .= "('$titulo' , '$descripcion' , '$fechaEstimadaFinalizacion' , '$fechaFinalizacion' , '$creadorTarea' , '$observaciones' , '$idEmpleado' , '$idEstado', '$idPrioridad', '$created_at', '')";
        return $sql;
    }

    static function whereId($id)
    {
        return "select * from tareas where id=$id";
    }

    static function update($tarea)
    {
        $id = $tarea->get('id');
        $titulo = $tarea->get('titulo');
        $descripcion = $tarea->get('descripcion');
        $fechaEstimadaFinalizacion = $tarea->get('fechaEstimadaFinalizacion');
        $fechaFinalizacion = $tarea->get('fechaFinalizacion');
        $creadorTarea = $tarea->get('creadorTarea');
        $observaciones = $tarea->get('observaciones');
        $idEmpleado = $tarea->get('idEmpleado');
        $idEstado = $tarea->get('idEstado');
        $idPrioridad = $tarea->get('idPrioridad');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE tareas SET ";
        $sql .= "titulo='$titulo',";
        $sql .= "descripcion='$descripcion',";
        $sql .= "fechaEstimadaFinalizacion='$fechaEstimadaFinalizacion',";
        $sql .= "fechaFinalizacion='$fechaFinalizacion',";
        $sql .= "creadorTarea='$creadorTarea',";
        $sql .= "observaciones='$observaciones',";
        $sql .= "idEmpleado='$idEmpleado',";
        $sql .= "idEstado='$idEstado',";
        $sql .= "idPrioridad='$idPrioridad',";
        $sql .= "updated_at='$updatedAt' ";
        $sql .= "WHERE id='$id'";

        return $sql;
    }


    static function delete($tarea)
    {
        $id = $tarea->get('id');
        return "delete from tareas where id=$id";
    }
}
