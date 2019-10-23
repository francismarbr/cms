<?php
class PerfilAcessoController extends Controller {
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

        if($usuario->temPermissao('gerenciar_perfil_acesso')) {
            $perfilAcesso = new PerfilAcesso();
            $dados['lista_perfis'] = $perfilAcesso->getListaPerfisAcesso(); 

            $this->carregarTemplateEmAdmin('sistema-adm/perfilAcesso', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_perfil_acesso')) {
            $perfilAcesso = new PerfilAcesso (); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_perfil = addslashes($_POST['nome']);
                $lista_permissoes = $_POST['permissoes'];
                $perfilAcesso->inserir($nome_perfil, $lista_permissoes);
                header("Location: ".BASE_URL."/perfilAcesso");
            }
            
            $permissao = new Permissao();
            //busca todas as permissões disponíveis para serem usadas na view form
            $dados['lista_permissoes'] = $permissao->getListaPermissoes();
            $dados['info_perfil'] = array(); //permite que a variável info_perfil exista na view, mas não carrega nenhuma informação 
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formPerfilAcesso', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_perfil_acesso')) {
            $perfilAcesso = new PerfilAcesso (); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_perfil = addslashes($_POST['nome']);
                $lista_permissoes = $_POST['permissoes'];
                $perfilAcesso->editar($id, $nome_perfil, $lista_permissoes);
                header("Location: ".BASE_URL."/perfilAcesso");
            }
            
            $permissao = new Permissao();
            $dados['lista_permissoes'] = $permissao->getListaPermissoes();
            $dados['info_perfil'] = $perfilAcesso->getPerfilAcesso($id); //armazena informações do grupo a ser editado

            $this->carregarTemplateEmAdmin('sistema-adm/forms/formPerfilAcesso', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_perfil) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_perfil_acesso')) {
            $perfilAcesso = new PerfilAcesso();
            
            $perfilAcesso->excluir($id_perfil);
            
            header("Location: ".BASE_URL."/perfilAcesso");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}