<?php
class permissaoController extends Controller {
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

        if($usuario->temPermissao('visualizar_permissao')) {
            $this->carregarTemplate('permissao', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

}