<?php
class usuarioController extends Controller {
    public function __construct() {
        $usuario = new Usuario();
        //se o usuário não estiver logado, redireciona para login
        if($usuario->isLogado() == false) {
            header("Location: ".BASE_URL."/painel-adm/login");
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
            $this->carregarTemplateEmAdmin('painel-adm/usuario', $dados);
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
            if(isset($_POST['login']) && !empty($_POST['login'])){
                $nome = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
                $login = addslashes($_POST['login']);
                $senha = addslashes($_POST['senha']);
                $grupo_permissao = addslashes($_POST['grupo']);

                $retorno = $usuario->inserir($nome, $email, $login, $senha, $grupo_permissao);
               
                if($retorno == '2') {
                    $dados['msg_informativa'] = "O email que você digitou já existe.";
                } elseif($retorno == '3'){
                    $dados['msg_informativa'] = "O login que você escolheu já existe.";
                } else {
                    header("Location: ".BASE_URL."/painel-adm/usuario");
                }  
            }
            $grupoPermissao = new GrupoPermissao();
            $dados['lista_grupos'] = $grupoPermissao->getListaGrupos();
            $dados['info_usuario'] = array();
            $this->carregarTemplateEmAdmin('painel-adm/cadastrarUsuario', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_usuarios')) {
            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome = addslashes($_POST['nome']);
                $login = addslashes($_POST['login']);
                $senha = addslashes($_POST['senha']);
                $grupo_permissao = addslashes($_POST['grupo']);
                
                $retorno = $usuario->editar($id, $nome, $login, $senha, $grupo_permissao);

                if($retorno == '0'){
                    $dados['msg_informativa'] = "O login que você escolheu já existe.";
                } else {
                    header("Location: ".BASE_URL."/painel-adm/usuario");
                } 
            }
            
            $grupoPermissao = new GrupoPermissao();
            $dados['lista_grupos'] = $grupoPermissao->getListaGrupos();
            $dados['info_usuario'] = $usuario->getInformacoes($id);

            $this->carregarTemplateEmAdmin('painel-adm/cadastrarUsuario', $dados);
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
            header("Location: ".BASE_URL."/painel-adm/usuario");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}