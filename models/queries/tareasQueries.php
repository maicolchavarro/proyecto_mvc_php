<?php
namespace App\models\queries;

class TareasQueries {
    public static function selectAll() {
        return "SELECT * FROM empleados";
    }

    static function whereId($id)
    {
        return "select * from empleados where id=$id";
    }
}
