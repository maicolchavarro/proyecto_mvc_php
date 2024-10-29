<?php

namespace App\controllers;

use App\models\entities\tarea;

class tareasController
{
    function getAllTareas()
    {
        return tarea::all();
    }
}
