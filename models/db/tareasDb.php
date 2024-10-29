<?php
namespace App\models\db;

use mysqli;
use Exception;

class TareasDb {
    private $host = 'localhost';
    private $user = 'root';
    private $pwd = '';
    private $name = 'tareas_db';
    private $conex;

    public function __construct() {
        $this->conex = new mysqli($this->host, $this->user, $this->pwd, $this->name);
        if ($this->conex->connect_error) {
            throw new Exception("Error de conexión: " . $this->conex->connect_error);
        }
    }

    public function close() {
        $this->conex->close();
    }

    public function query($sql) {
        return $this->conex->query($sql);
    }
}
