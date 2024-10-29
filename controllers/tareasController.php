<?php
namespace App\controllers;

use App\models\entities\Empleado;

class TareasController {
    public function getAllTareas() {
        return Empleado::all();
    }
}
