<?php

namespace App\models\entities;

use App\models\db\tareasDb;
use App\models\queries\tareasQueries;

class tarea
{
    private $id;
    private $nombre;

    function set($prop, $value)
    {
        $this->{$prop} = $value;
    }

    function get($prop)
    {
        return $this->{$prop};
    }

    static function all()
    {
        $sql = tareasQueries::selectAll();
        $db = new tareasDb();
        $result = $db->query($sql);
        $tareas = []; // Cambiado de $empleados a $tareas
        while ($row = $result->fetch_assoc()) {
            $tarea = new tarea();
            $tarea->set('id', $row['id']);
            $tarea->set('nombre', $row['nombre']);
            
            array_push($tareas, $tarea);
        }
        $db->close();
        return $tareas;
    }
}
