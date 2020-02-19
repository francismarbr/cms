<?php
class ServicoController extends Controller {
    
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
            'menu_ativo' => 'servico',
            'submenu_ativo' => ''
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_servico')) {
            $servico = new Servico();
            $this->dados['lista_servicos'] = $servico->getListaServicos($tipo = "");
            $this->carregarTemplate('telas/servico', $this->dados);
        } else {
            header("Location: ".URL_CMS."/dashboard");
        }
    }

    public function inserir() {
         if($this->usuario->temPermissao('gerenciar_servico')) {
            $servico = new Servico();
            $formataNome = new FormataNome(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $midia = new Midia();

                $nome = addslashes($_POST['nome']);
                $imagem_capa = $_FILES['imagem_capa'];
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = $_POST['descricao'];
                $slug = addslashes($_POST['slug']);
                
                if(empty($slug)) {
                    $slug = $formataNome->nome_amigavel($nome);
                }
                if(!empty($imagem_capa)){
                    $novo_nome_imagem = $midia->inserir_arquivo_unico($imagem_capa);
                }
                
                
               $servico->inserir($nome, $novo_nome_imagem, $alt_imagem_capa, $descricao, $slug);
               
              header("Location: ".URL_CMS."/servico");
            }
            $this->dados['info_servico'] = array();
 
            $this->carregarTemplate('telas/forms/formServico', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_servico')) {
            $servico = new Servico();
            $formataNome = new FormataNome(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $midia = new Midia();

                $nome = addslashes($_POST['nome']);
                $imagem_capa = $_FILES['imagem_capa'];
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = $_POST['descricao'];
                $slug = addslashes($_POST['slug']);
                
                if(empty($slug)) {
                    $slug = $formataNome->nome_amigavel($nome);
                }
                if(!empty($imagem_capa)){
                    $novo_nome_imagem = $midia->inserir_arquivo_unico($imagem_capa);
                }
                
                $servico->editar($id, $nome, $novo_nome_imagem, $alt_imagem_capa, $descricao, $slug);
                
                header("Location: ".URL_CMS."/servico");
            }

            $this->dados['info_servico'] = $servico->getServico($id);
        
            $this->carregarTemplate('/telas/forms/formServico', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function excluir($id_servico) {
        if($this->usuario->temPermissao('gerenciar_servico')) {
            $servico = new Servico();

            $servico->excluir($id_servico);
            header("Location: ".URL_CMS."/servico");
        } else {
            header("Location: ".URL_CMS);
        }
    }

}