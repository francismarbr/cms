<?php
class DashboardController extends Controller {

    private $dados;
    private $usuario;
    
    public function __construct() {
        $this->usuario = new Usuario();
        
        //se o usuário não estiver logado, redireciona para login
        if($this->usuario->setUsuarioLogado() == false) {
            header("Location: ".URL_CMS."/login");
            exit;
        }

        $this->dados = array(
            'nome_usuario' => $this->usuario->getNome(),
            'menu_ativo' => 'dashboard',
            'submenu_ativo' => ''           
        );
    }

    public function index() {      
        $this->carregarTemplate('telas/dashboard', $this->dados);
    }
}