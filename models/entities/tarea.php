<?php
namespace App\models\entities;

use App\models\db\TareasDb;
use App\models\queries\TareasQueries;

class Empleado {
    private $id;
    private $nombre;

    public function set($prop, $value) {
        $this->{$prop} = $value;
    }

    public function get($prop) {
        return $this->{$prop};
    }

    public static function all() {
        $sql = TareasQueries::selectAll();
        $db = new TareasDb();
        $resultado = $db->query($sql);
        $empleados = [];

        while ($fila = $resultado->fetch_assoc()) {
            $empleado = new Empleado();
            $empleado->set('id', $fila['id']);
            $empleado->set('nombre', $fila['nombre']);
            array_push($empleados, $empleado);
        }
        $db->close();
        return $empleados;
    }

    static function find($id)
    {
        $sql = tareasQueries::whereId($id);
        $db = new tareasDb(); 
        $result = $db->query($sql);
        $empleado = null;
        while ($row = $result->fetch_assoc()) {
            $empleado = new Empleado();
            $empleado->set('id', $row['id']);
            $empleado->set('nombre', $row['nombre']);
        }
        $db->close();
        return $empleado;
    }
}
