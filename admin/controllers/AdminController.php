<?php
class AdminController extends Controller {

    public function __construct() {
       
        $usuario = new Usuario();
        //se o usuário não estiver logado, redireciona para login
        if($usuario->isLogado() == false) {
            header("Location: ".URL_CMS."/login");
            exit;
        }
    }

    public function index() {
        $dados = array();

        $usuario = new Usuario();
        $usuario->setUsuarioLogado(); //busca o usuário logado para pegar suas informações
        $dados['nome_usuario'] = $usuario->getNome();
        
        $this->carregarTemplate('dashboard', $dados);
    }
}