<?php
class usuarioController extends Controller {
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

        if($usuario->temPermissao('gerenciar_usuarios')) {
            $dados['lista_usuarios'] = $usuario->getListaUsuarios(); 
            $this->carregarTemplate('usuario', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_usuarios')) { 
            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
                $login = addslashes($_POST['login']);
                $senha = addslashes($_POST['senha']);
                $grupo_permissao = addslashes($_POST['grupo']);
                $usuario->inserir($nome, $email, $login, $senha, $grupo_permissao);
                header("Location: ".BASE_URL."/usuario");
            }

            $this->carregarTemplate('usuario', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_permissao')) {
            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
                $login = addslashes($_POST['login']);
                $senha = addslashes($_POST['senha']);
                $grupo_permissao = addslashes($_POST['grupo']);
                $usuario->editar($id, $nome, $email, $login, $senha, $grupo_permissao);
                header("Location: ".BASE_URL."/usuario");
            }

            $dados['info_usuario'] = $usuario->getUsuario($id);

            $this->carregarTemplate('cadastrarUsuario', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_usuario) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_usuarios')) {
            $usuario->excluir($id_usuario);
            header("Location: ".BASE_URL."/usuario");

            $this->carregarTemplate('usuario', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

}