<?php
class PaginaController extends Controller {
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

        if($usuario->temPermissao('consultar_pagina')) {
            $pagina = new Pagina();
            $dados['lista_paginas'] = $pagina->getListaPaginas($tipo = "");
            
            $this->carregarTemplateEmAdmin('sistema-adm/pagina', $dados);
        } else {
            header("Location: ".BASE_URL."/dashboard");
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();
        

        if($usuario->temPermissao('gerenciar_pagina')) {
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
            $dados['info_pagina'] = array(); //permite que a variável info_permissao exista na view, mas não carrega nenhuma informação 
            $dados['lista_categorias'] = $categoria->getListaCategorias(); 
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formPagina', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();
        

        if($usuario->temPermissao('gerenciar_pagina')) {
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

            $dados['info_pagina'] = $pagina->getPagina($id);
            $dados['lista_categorias'] = $categoria->getListaCategorias(); 
            $this->carregarTemplateEmAdmin('/sistema-adm/forms/formPagina', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_pagina) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_pagina')) {
            $pagina = new Pagina();

            $pagina->excluir($id_pagina);
            header("Location: ".BASE_URL."/pagina");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}