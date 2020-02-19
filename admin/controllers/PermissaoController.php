<?php
class PermissaoController extends Controller {
    
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
            'submenu_ativo' => 'permissao'
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao();
            $this->dados['lista_permissoes'] = $permissao->getListaPermissoes(); 
            $this->carregarTemplate('telas/permissao', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function inserir() {        
        if($this->usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_permissao = addslashes($_POST['nome']);
                $permissao->inserir($nome_permissao);
                header("Location: ".URL_CMS."/permissao");
            }
            $this->dados['info_permissao'] = array(); //permite que a variável info_permissao exista na view, mas não carrega nenhuma informação 
            $this->carregarTemplate('telas/forms/formPermissao', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_permissao = addslashes($_POST['nome']);
                $permissao->editar($id, $nome_permissao);
                header("Location: ".URL_CMS."/permissao");
            }

            $this->dados['info_permissao'] = $permissao->getPermissao($id);

            $this->carregarTemplate('telas/forms/formPermissao', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function excluir($id_permissao) {
        if($this->usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao();

            $permissao->excluir($id_permissao);
            header("Location: ".URL_CMS."/permissao");
        } else {
            header("Location: ".URL_CMS);
        }
    }

}