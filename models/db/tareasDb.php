<?php

namespace App\models\db;

use mysqli;
use Exception;

class tareasDb
{
    private $host = 'localhost';
    private $user = 'root';
    private $pwd = '';
    private $name = 'tareas_db';
    private $conex;

    function __construct()
    {
        $this->conex = new mysqli(
            $this->host,
            $this->user,
            $this->pwd,
            $this->name
        );

        if ($this->conex->connect_error) {
            throw new Exception("Connection failed: " . $this->conex->connect_error);
        }
    }

    function close()
    {
        $this->conex->close();
    }

    function query($sql)
    {
        return $this->conex->query($sql);
    }
}
