<?php
class Model {

    protected $conexaodb;

    public function __construct() {
        global $conexaoBaseDados;
        $this->conexaodb = $conexaoBaseDados;
    }
}