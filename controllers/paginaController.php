<?php
class paginaController extends Controller {
    public function __construct() {
        $usuario = new Usuario();
        //se o usuário não estiver logado, redireciona para login
        if($usuario->isLogado() == false) {
            header("Location: ".BASE_URL."/painel-adm/login");
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
            $this->carregarTemplateEmAdmin('painel-adm/pagina', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_pagina')) {
            $pagina = new Pagina(); 

            if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
                $titulo = addslashes($_POST['titulo']);
                $data = addslashes($_POST['data']);
                $imagem = addslashes($_POST['imagem']);
                $conteudo = addslashes($_POST['conteudo']);
                $autor = addslashes($_POST['autor']);
                $tags = addslashes($_POST['tags']);
                $palavra_chave = addslashes($_POST['palavra_chave']);
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = addslashes($_POST['descricao']);
                $url = addslashes($_POST['url']);
                $views = addslashes($_POST['views']);
                $tipo = addslashes($_POST['tipo']);

                $pagina->inserir($titulo, $data, $imagem, $conteudo, $autor, $tags, $palavra_chave, $alt_imagem_capa, $descricao, $url, $views, $tipo);

                header("Location: ".BASE_URL."/painel-adm/pagina");
            }
            $dados['info_pagina'] = array(); //permite que a variável info_permissao exista na view, mas não carrega nenhuma informação 
            $this->carregarTemplateEmAdmin('painel-adm/cadastrarPagina', $dados);
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
            $permissao = new Permissao(); 

            if(isset($_POST['id']) && !empty($_POST['id'])){
                $id_pagina = addslashes($_POST['id']);
                $titulo = addslashes($_POST['titulo']);
                $data = addslashes($_POST['data']);
                $imagem = addslashes($_POST['imagem']);
                $conteudo = addslashes($_POST['conteudo']);
                $autor = addslashes($_POST['autor']);
                $tags = addslashes($_POST['tags']);
                $palavra_chave = addslashes($_POST['palavra_chave']);
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = addslashes($_POST['descricao']);
                $url = addslashes($_POST['url']);
                $views = addslashes($_POST['views']);
                $tipo = addslashes($_POST['tipo']);
                
                $pagina->editar($id_pagina, $titulo, $data, $imagem, $conteudo, $autor, $tags, $palavra_chave, $alt_imagem_capa, $descricao, $url, $views, $tipo);
                
                header("Location: ".BASE_URL."/painel-adm/pagina");
            }

            $dados['info_pagina'] = $pagina->getPagina($id);

            $this->carregarTemplateEmAdmin('painel-adm/cadastrarPermissao', $dados);
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
            header("Location: ".BASE_URL."/painel-adm/pagina");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}