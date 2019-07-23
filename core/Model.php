<?php
class Model {

    protected $conexaodb;

    public function __construct() {
        global $conexaodb;
        $this->conexaodb = $conexaodb;
    }
}