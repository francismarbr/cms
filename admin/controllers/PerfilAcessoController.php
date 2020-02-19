<?php
class PerfilAcessoController extends Controller {

    private $dados;
    private $usuario;
    
    public function __construct() {
        $this->usuario = new Usuario();
        
        //se o usuário não estiver logado, redireciona para login
        if($this->usuario->setUsuarioLogado() == false) {
            header("Location: ".URL_CMS."/login");
            exit;
        }

        $this->dados = array(
            'nome_usuario' => $this->usuario->getNome(),
            'menu_ativo' => 'configuracoes',
            'submenu_ativo' => 'perfilAcesso'
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_perfil_acesso')) {
            $perfilAcesso = new PerfilAcesso();
            $this->dados['lista_perfis'] = $perfilAcesso->getListaPerfisAcesso(); 

            $this->carregarTemplate('telas/perfilAcesso', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function inserir() {
        if($this->usuario->temPermissao('gerenciar_perfil_acesso')) {
            $perfilAcesso = new PerfilAcesso (); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_perfil = addslashes($_POST['nome']);
                $lista_permissoes = $_POST['permissoes'];
                $perfilAcesso->inserir($nome_perfil, $lista_permissoes);
                header("Location: ".URL_CMS."/perfilAcesso");
            }
            
            $permissao = new Permissao();
            //busca todas as permissões disponíveis para serem usadas na view form
            $this->dados['lista_permissoes'] = $permissao->getListaPermissoes();
            $this->dados['info_perfil'] = array(); //permite que a variável info_perfil exista na view, mas não carrega nenhuma informação 
            $this->carregarTemplate('telas/forms/formPerfilAcesso', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_perfil_acesso')) {
            $perfilAcesso = new PerfilAcesso (); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_perfil = addslashes($_POST['nome']);
                $lista_permissoes = $_POST['permissoes'];
                $perfilAcesso->editar($id, $nome_perfil, $lista_permissoes);
                header("Location: ".URL_CMS."/perfilAcesso");
            }
            
            $permissao = new Permissao();
            $this->dados['lista_permissoes'] = $permissao->getListaPermissoes();
            $this->dados['info_perfil'] = $perfilAcesso->getPerfilAcesso($id); //armazena informações do grupo a ser editado

            $this->carregarTemplate('telas/forms/formPerfilAcesso', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function excluir($id_perfil) {
        if($this->usuario->temPermissao('gerenciar_perfil_acesso')) {
            $perfilAcesso = new PerfilAcesso();
            
            $perfilAcesso->excluir($id_perfil);
            
            header("Location: ".URL_CMS."/perfilAcesso");
        } else {
            header("Location: ".URL_CMS);
        }
    }

}