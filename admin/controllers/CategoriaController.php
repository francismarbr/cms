<?php
class CategoriaController extends Controller {
    
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
            'menu_ativo' => 'conteudo',
            'submenu_ativo' => 'categoria'
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_categorias')) {
            $categoria = new Categoria();
            $this->dados['lista_categorias'] = $categoria->getListaCategorias(); 
            $this->carregarTemplate('telas/categoria', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function inserir() {
        if($this->usuario->temPermissao('gerenciar_categorias')) {
            $categoria = new Categoria(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome = addslashes($_POST['nome']);
                $categoria->inserir($nome);
                header("Location: ".URL_CMS."/categoria");
            }
            $this->dados['info_categoria'] = array(); //permite que a variável info_categoria exista na view, mas não carrega nenhuma informação 
            $this->carregarTemplate('telas/forms/formCategoria', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_categorias')) {
            $categoria = new Categoria(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome = addslashes($_POST['nome']);
                $categoria->editar($id, $nome);
                header("Location: ".URL_CMS."/categoria");
            }

            $this->dados['info_categoria'] = $categoria->getCategoria($id);

            $this->carregarTemplate('telas/forms/formCategoria', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function excluir($id_categoria) {
        if($this->usuario->temPermissao('gerenciar_categorias')) {
            $categoria = new Categoria();

            $categoria->excluir($id_categoria);
            header("Location: ".URL_CMS."/categoria");
        } else {
            header("Location: ".URL_CMS);
        }
    }

}