<?php

namespace Model;

class Cita extends ActiveRecord {   
    // Definir la tabla si no sigue la convención de nombres
    protected static $tabla = 'Citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;

    // Constructor
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? null;
    }   

    // Definir las relaciones si es necesario

    // Validaciones, callbacks, y otros métodos pueden ser añadidos aquí
}