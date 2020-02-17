<?php
class MidiaController extends Controller {
    
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
            'menu_ativo' => 'midia',
            'submenu_ativo' => ''
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_midias')) {
            $pagina = new Pagina();
            $this->dados['lista_paginas'] = $pagina->getListaPaginas($tipo = "");
            $this->dados['menu_ativo'] = 'midia';
            
            $this->carregarTemplateEmAdmin('sistema-adm/midia', $this->dados);
        } else {
            header("Location: ".BASE_URL."/dashboard");
        }
    }

    public function inserir() {
        if($this->usuario->temPermissao('gerenciar_midias')) {
            $midia = new Midia();
            
            $arquivos = array();
            
            if(!empty($_FILES['arquivo'])) {
                $arquivos = $_FILES['arquivo'];
                
                $midia->inserir_multiplos_arquivos($arquivos);
                
                header("Location: ".BASE_URL."/midia");
                $this->dados['lista_imagens'] = $midia->getListaImagens();
            }

            $this->carregarTemplateEmAdmin('sistema-adm/midia', $this->dados);

        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        
    }

    public function excluir($id_midia) {
        
    }

    public function upload_tinymce() {
        if(!empty($_FILES['file']['tmp_name'])) {
            $midia = new Midia();
            $nome_imagem = $midia->inserir_arquivo_unico($_FILES['file']);

            $local_arquivo = BASE_URL.'/uploads';
            $array = array(
                'location' => $local_arquivo.'/'.$nome_imagem
            );

            echo json_encode($array);
            exit;
        }
    }

}