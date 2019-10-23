<?php
class grupoPermissaoController extends Controller {
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

        if($usuario->temPermissao('gerenciar_grupos_permissao')) {
            $grupoPermissao = new GrupoPermissao();
            $dados['lista_grupos'] = $grupoPermissao->getListaGrupos(); 

            $this->carregarTemplate('grupoPermissao', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_grupos_permissao')) {
            $grupoPermissao = new GrupoPermissao (); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_permissao = addslashes($_POST['nome']);
                $lista_permissoes = $_POST['permissoes'];
                $grupoPermissao->inserir($nome_permissao, $lista_permissoes);
                header("Location: ".BASE_URL."/grupoPermissao");
            }
            
            $permissao = new Permissao();
            //busca todas as permissões disponíveis para serem usadas na view cadastrar
            $dados['lista_permissoes'] = $permissao->getListaPermissoes();
            $dados['info_grupo'] = array(); //permite que a variável info_grupo exista na view, mas não carrega nenhuma informação 
            $this->carregarTemplate('forms/cadastrarGrupoPermissao', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_grupos_permissao')) {
            $grupoPermissao = new GrupoPermissao (); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_permissao = addslashes($_POST['nome']);
                $lista_permissoes = $_POST['permissoes'];
                $grupoPermissao->editar($id, $nome_permissao, $lista_permissoes);
                header("Location: ".BASE_URL."/grupoPermissao");
            }
            
            $permissao = new Permissao();
            $dados['lista_permissoes'] = $permissao->getListaPermissoes();
            $dados['info_grupo'] = $grupoPermissao->getGrupo($id); //armazena informações do grupo a ser editado

            $this->carregarTemplate('forms/cadastrarGrupoPermissao', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_grupo) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_grupos_permissao')) {
            $grupoPermissao = new grupoPermissao();
            
            $grupoPermissao->excluir($id_grupo);
            
            header("Location: ".BASE_URL."/grupoPermissao");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}