<?php
class Controller {
    
    public function carregarView($nomeView, $dadosView = array()) {
        extract($dadosView); // extrai os dados do array e os transforma em variáveis
        require 'views/'.$nomeView.'.php';
    }

    public function carregarTemplate($nomeView, $dadosView = array()) {
        extract($dadosView);
        require 'views/template.php';
    }

    public function carregarViewNoTemplate($nomeView, $dadosView = array()) {
        extract($dadosView);
        require 'views/'.$nomeView.'.php';
    }
}