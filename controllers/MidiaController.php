<?php
class MidiaController extends Controller {
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

        if($usuario->temPermissao('gerenciar_midias')) {
            $pagina = new Pagina();
            $dados['lista_paginas'] = $pagina->getListaPaginas($tipo = "");
            
            $this->carregarTemplateEmAdmin('sistema-adm/midia', $dados);
        } else {
            header("Location: ".BASE_URL."/dashboard");
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();
        

        if($usuario->temPermissao('gerenciar_midias')) {
            $midia = new Midia();
            
            $arquivos = array();
            
            if(!empty($_FILES['arquivo'])) {
                $arquivos = $_FILES['arquivo'];
                
                $midia->inserir_multiplos_arquivos($arquivos);
                
                header("Location: ".BASE_URL."/midia");
                $dados['lista_imagens'] = $midia->getListaImagens();
            }

            $this->carregarTemplateEmAdmin('sistema-adm/midia', $dados);

        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();
        

        if($usuario->temPermissao('gerenciar_midias')) {
            $pagina = new Pagina();
            $categoria = new Categoria(); 

            if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
                $titulo = addslashes($_POST['titulo']);
                $imagem_capa = addslashes($_POST['imagem_capa']);
                $conteudo = addslashes($_POST['conteudo']);
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

        if($usuario->temPermissao('gerenciar_midias')) {
            $pagina = new Pagina();

            $pagina->excluir($id_pagina);
            header("Location: ".BASE_URL."/pagina");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}