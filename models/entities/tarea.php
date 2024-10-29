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
}
