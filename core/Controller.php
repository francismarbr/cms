<?php
class Controller {
    
    public function carregarView($nomeView, $dadosView = array()) {
        extract($dadosView); // extrai os dados do array e os transforma em variáveis
        require 'views/'.$nomeView.'.php';
    }

    public function carregarTemplate($nomeView, $dadosView = array()) {
        extract($dadosView);
        require 'views/templates/template.php';
    }
    
    public function carregarViewNoTemplate($nomeView, $dadosView = array()) {
        extract($dadosView);
        require 'views/'.$nomeView.'.php';
    }

    //template sistema administrativo
    public function carregarTemplateEmAdmin($nomeView, $dadosView = array()) {
        extract($dadosView);
        require 'views/templates/admin.php';
    }


    
}