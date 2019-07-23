<?php
    require 'ambiente.php';

    $config = array();

    if(AMBIENTE == 'desenvolvimento') {
        define("BASE_URL", "http://localhost/sistemagestao");
        $config['dbname'] = 'sistemag';
        $config['host'] = "localhost";
        $config['dbusuario'] = 'root';
        $config['dbsenha'] = "";
    } else {
        define("BASE_URL", "http://localhost/sistemagestao");
        $config['dbname'] = 'sistemag';
        $config['host'] = "localhost";
        $config['dbusuario'] = 'root';
        $config['dbsenha'] = "";
    }

    global $conexaodb;

    try {
        $conexaodb = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbusuario'], $config['dbsenha']);
    } catch (PDOException $e) {
        echo "Erro ao conectar. ".$e->getMessage();
    }
?>