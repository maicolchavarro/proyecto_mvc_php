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

    

    static function filtrerTarea($titulo, $fechaInicio, $fechaFin, $idPrioridad, $idEmpleado, $descripcion)
    {
        $query = "SELECT tareas.* FROM tareas
              INNER JOIN empleados ON tareas.idEmpleado = empleados.id
              INNER JOIN prioridades ON tareas.idPrioridad = prioridades.id
              WHERE 1=1";

        if (!empty($idPrioridad)) {
            $query .= " AND tareas.idPrioridad = '$idPrioridad'";
        }

        if (!empty($idEmpleado)) {
            $query .= " AND tareas.idEmpleado = '$idEmpleado'";
        }

        if (!empty($descripcion)) {
            $query .= " AND tareas.descripcion = '$descripcion'";
        }

        if (!empty($titulo)) {
            $query .= " AND tareas.titulo = '$titulo'";
        }

        if (!empty($fechaInicio) && !empty($fechaFin)) {
            $query .= " AND tareas.fechaEstimadaFinalizacion BETWEEN '$fechaInicio' AND '$fechaFin'";
        } elseif (!empty($fechaInicio)) {
            $query .= " AND tareas.fechaEstimadaFinalizacion >= '$fechaInicio'";
        } elseif (!empty($fechaFin)) {
            $query .= " AND tareas.fechaEstimadaFinalizacion <= '$fechaFin'";
        }

        return $query;
    }


    static function agruparTarea($idEstado)
    {
        $query = "SELECT * FROM tareas WHERE 1=1";

        if (!empty($idEstado)) {
            $query .= " AND idEstado = '$idEstado'";
        }

        return $query;
    }
}
