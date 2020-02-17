<?php
class PaginaController extends Controller {
    
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
            'menu_ativo' => 'conteudo',
            'submenu_ativo' => 'post'
        );
    }

    public function index() {
        if($this->usuario->temPermissao('consultar_pagina')) {
            $pagina = new Pagina();
            $this->dados['lista_paginas'] = $pagina->getListaPaginas($tipo = "");
            
            $this->carregarTemplateEmAdmin('sistema-adm/pagina', $this->dados);
        } else {
            header("Location: ".BASE_URL."/dashboard");
        }
    }

    public function inserir() {
        if($this->usuario->temPermissao('gerenciar_pagina')) {
            $pagina = new Pagina();
            $categoria = new Categoria(); 

            if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
                $titulo = addslashes($_POST['titulo']);
                $data = date('d/m/y');
                $imagem_capa = addslashes($_POST['imagem_capa']);
                $conteudo = $_POST['conteudo'];
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = addslashes($_POST['descricao']);
                $slug = addslashes($_POST['slug']);
                $views = 0;
                $tipo = addslashes($_POST['tipo']);
                $id_categoria = $_POST['categoria'];
                $pagina->inserir($titulo, $data, $imagem_capa, $conteudo, $alt_imagem_capa, $descricao, $slug, $views, $tipo, $id_categoria);

                header("Location: ".BASE_URL."/pagina");
            }
            $this->dados['info_pagina'] = array(); //permite que a variável info_permissao exista na view, mas não carrega nenhuma informação 
            $this->dados['lista_categorias'] = $categoria->getListaCategorias(); 
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formPagina', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_pagina')) {
            $pagina = new Pagina();
            $categoria = new Categoria(); 

            if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
                $titulo = addslashes($_POST['titulo']);
                $imagem_capa = addslashes($_POST['imagem_capa']);
                $conteudo = $_POST['conteudo'];
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = addslashes($_POST['descricao']);
                $slug = addslashes($_POST['slug']);
                $tipo = addslashes($_POST['tipo']);
                $id_categoria = $_POST['categoria'];
                $pagina->editar($id, $titulo, $imagem_capa, $conteudo, $alt_imagem_capa, $descricao, $slug, $tipo, $id_categoria);
                
                header("Location: ".BASE_URL."/pagina");
            }

            $this->dados['info_pagina'] = $pagina->getPagina($id);
            $this->dados['lista_categorias'] = $categoria->getListaCategorias(); 
            $this->carregarTemplateEmAdmin('/sistema-adm/forms/formPagina', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_pagina) {
        if($this->usuario->temPermissao('gerenciar_pagina')) {
            $pagina = new Pagina();

            $pagina->excluir($id_pagina);
            header("Location: ".BASE_URL."/pagina");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}