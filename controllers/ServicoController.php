<?php
class ServicoController extends Controller {
    
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
            'menu_ativo' => 'servico',
            'submenu_ativo' => ''
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_servico')) {
            $servico = new Servico();
            $this->dados['lista_servicos'] = $servico->getListaServicos($tipo = "");
            $this->carregarTemplateEmAdmin('sistema-adm/servico', $this->dados);
        } else {
            header("Location: ".BASE_URL."/dashboard");
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
               
              header("Location: ".BASE_URL."/servico");
            }
            $this->dados['info_servico'] = array();
 
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formServico', $this->dados);
        } else {
            header("Location: ".BASE_URL);
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
                
                header("Location: ".BASE_URL."/servico");
            }

            $this->dados['info_servico'] = $servico->getServico($id);
        
            $this->carregarTemplateEmAdmin('/sistema-adm/forms/formServico', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_servico) {
        if($this->usuario->temPermissao('gerenciar_servico')) {
            $servico = new Servico();

            $servico->excluir($id_servico);
            header("Location: ".BASE_URL."/servico");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}