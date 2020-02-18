<?php
class dashboardController extends Controller {

    private $dados;
    private $usuario;
    
    public function __construct() {
        $this->usuario = new Usuario();
        
        //se o usuário não estiver logado, redireciona para login
        if($this->usuario->setUsuarioLogado() == false) {
            header("Location: ".BASE_URL."/login");
            exit;
        }

        $this->dados = array(
            'nome_usuario' => $this->usuario->getNome(),
            'menu_ativo' => 'dashboard',
            'submenu_ativo' => ''           
        );
    }

    public function index() {      
        $this->carregarTemplateEmAdmin('sistema-adm/dashboard', $this->dados);
    }
}