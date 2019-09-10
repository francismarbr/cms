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
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao();
            $dados['lista_permissoes'] = $permissao->getListaPermissoes(); 

            $this->carregarTemplate('permissao', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_permissao = addslashes($_POST['nome']);
                $permissao->inserir($nome_permissao);
                header("Location: ".BASE_URL."/permissao");
            }

            $this->carregarTemplate('cadastrarPermissao', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_permissao = addslashes($_POST['nome']);
                $permissao->editar($id, $nome_permissao);
                header("Location: ".BASE_URL."/permissao");
            }

            $dados['info_permissao'] = $permissao->getPermissao($id);

            $this->carregarTemplate('cadastrarPermissao', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_permissao) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao();

            $permissao->excluir($id_permissao);
            header("Location: ".BASE_URL."/permissao");

            $this->carregarTemplate('cadastrarPermissao', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

}