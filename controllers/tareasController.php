<?php
namespace App\controllers;

use App\models\entities\Empleado;

class TareasController {
    public function getAllTareas() {
        return Empleado::all();
    }

    function getEmpleado($id)
    {
        return Empleado::find($id);
    }
}
