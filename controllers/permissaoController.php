<?php
class permissaoController extends Controller {
    
    private $dados;
    private $usuario;
    
    public function __construct() {
        $this->usuario = new Usuario();
        
        //se o usuário não estiver logado, redireciona para login
        if($this->usuario->setUsuarioLogado() == false) {
            header("Location: ".BASE_URL."/login");
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
            $this->carregarTemplateEmAdmin('sistema-adm/permissao', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inserir() {        
        if($this->usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_permissao = addslashes($_POST['nome']);
                $permissao->inserir($nome_permissao);
                header("Location: ".BASE_URL."/permissao");
            }
            $this->dados['info_permissao'] = array(); //permite que a variável info_permissao exista na view, mas não carrega nenhuma informação 
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formPermissao', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_permissao = addslashes($_POST['nome']);
                $permissao->editar($id, $nome_permissao);
                header("Location: ".BASE_URL."/permissao");
            }

            $this->dados['info_permissao'] = $permissao->getPermissao($id);

            $this->carregarTemplateEmAdmin('sistema-adm/forms/formPermissao', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_permissao) {
        if($this->usuario->temPermissao('gerenciar_permissoes')) {
            $permissao = new Permissao();

            $permissao->excluir($id_permissao);
            header("Location: ".BASE_URL."/permissao");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}