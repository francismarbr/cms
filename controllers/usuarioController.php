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
            $this->carregarTemplateEmAdmin('sistema-adm/usuario', $dados);
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
                $perfil_acesso = addslashes($_POST['perfil']);

                $retorno = $usuario->inserir($nome, $email, $login, $senha, $perfil_acesso);
               
                if($retorno == '2') {
                    $dados['msg_informativa'] = "O email que você digitou já existe.";
                } elseif($retorno == '3'){
                    $dados['msg_informativa'] = "O login que você escolheu já existe.";
                } else {
                    header("Location: ".BASE_URL."/usuario");
                }  
            }
            $perfilAcesso = new PerfilAcesso();
            $dados['lista_perfis'] = $perfilAcesso->getListaPerfisAcesso();
            $dados['info_usuario'] = array();
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formUsuario', $dados);
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
                $perfil_acesso = addslashes($_POST['perfil']);
                
                $retorno = $usuario->editar($id, $nome, $login, $senha, $perfil_acesso);

                if($retorno == '0'){
                    $dados['msg_informativa'] = "O login que você escolheu já existe.";
                } else {
                    header("Location: ".BASE_URL."/usuario");
                } 
            }
            
            $perfilAcesso = new PerfilAcesso();
            $dados['lista_perfis'] = $perfilAcesso->getListaPerfisAcesso();
            $dados['info_usuario'] = $usuario->getInformacoes($id);

            $this->carregarTemplateEmAdmin('sistema-adm/forms/formUsuario', $dados);
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
        } else {
            header("Location: ".BASE_URL);
        }
    }

}