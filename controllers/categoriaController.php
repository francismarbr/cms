<?php
class CategoriaController extends Controller {
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

        if($usuario->temPermissao('gerenciar_categorias')) {
            $categoria = new Categoria();
            $dados['lista_categorias'] = $categoria->getListaCategorias(); 
            $this->carregarTemplateEmAdmin('sistema-adm/categoria', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_categorias')) {
            $categoria = new Categoria(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome = addslashes($_POST['nome']);
                $categoria->inserir($nome);
                header("Location: ".BASE_URL."/categoria");
            }
            $dados['info_categoria'] = array(); //permite que a variável info_categoria exista na view, mas não carrega nenhuma informação 
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formCategoria', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_categorias')) {
            $categoria = new Categoria(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome = addslashes($_POST['nome']);
                $categoria->editar($id, $nome);
                header("Location: ".BASE_URL."/categoria");
            }

            $dados['info_categoria'] = $categoria->getCategoria($id);

            $this->carregarTemplateEmAdmin('sistema-adm/forms/formCategoria', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_categoria) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_categorias')) {
            $categoria = new Categoria();

            $categoria->excluir($id_categoria);
            header("Location: ".BASE_URL."/categoria");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}