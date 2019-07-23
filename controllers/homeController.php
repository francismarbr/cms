<?php
class homeController extends Controller {

    public function __construct() {
       
        $usuario = new Usuario();
        //se o usuário não estiver logado, redireciona para login
        if($usuario->isLogado() == false) {
            header("Location: ".BASE_URL."/login");
            exit;
        }
    }

    public function index() {
        $dados = array();

        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $empresa = new Empresa($usuario->getEmpresa());
        $dados['nome_empresa'] = $empresa->getNome();
        $dados['nome_usuario'] = $usuario->getNome();

        $this->carregarTemplate('home', $dados);
    }
}