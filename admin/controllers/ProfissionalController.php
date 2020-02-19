<?php
class ProfissionalController extends Controller {
    
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
            'menu_ativo' => 'profissional',
            'submenu_ativo' => ''
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_profissional')) {
            $profissional = new Profissional();
            $this->dados['lista_profissionais'] = $profissional->getListaProfissionais($tipo = "");
            $this->carregarTemplate('telas/profissional', $this->dados);
        } else {
            header("Location: ".URL_CMS."/dashboard");
        }
    }

    public function inserir() {
         if($this->usuario->temPermissao('gerenciar_profissional')) {
            $profissional = new Profissional();
            $formataNome = new FormataNome(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $midia = new Midia();

                $nome = addslashes($_POST['nome']);
                $imagem_capa = $_FILES['imagem_capa'];
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = $_POST['descricao'];
                $cargo = addslashes($_POST['cargo']);
                $slug = addslashes($_POST['slug']);
                
                if(empty($slug)) {
                    $slug = $formataNome->nome_amigavel($nome);
                }
                if(!empty($imagem_capa)){
                    $novo_nome_imagem = $midia->inserir_arquivo_unico($imagem_capa);
                }
                
                
               $profissional->inserir($nome, $novo_nome_imagem, $alt_imagem_capa, $descricao, $slug, $cargo);
               
              header("Location: ".URL_CMS."/profissional");
            }
            $this->dados['info_profissional'] = array();
 
            $this->carregarTemplate('telas/forms/formProfissional', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_profissional')) {
            $profissional = new Profissional();
            $formataNome = new FormataNome(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $midia = new Midia();

                $nome = addslashes($_POST['nome']);
                $imagem_capa = $_FILES['imagem_capa'];
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = $_POST['descricao'];
                $cargo = $_POST['cargo'];
                $slug = addslashes($_POST['slug']);
                
                if(empty($slug)) {
                    $slug = $formataNome->nome_amigavel($nome);
                }
                if(!empty($imagem_capa)){
                    $novo_nome_imagem = $midia->inserir_arquivo_unico($imagem_capa);
                }
                
                $profissional->editar($id, $nome, $novo_nome_imagem, $alt_imagem_capa, $descricao, $slug, $cargo);
                
                header("Location: ".URL_CMS."/profissional");
            }

            $this->dados['info_profissional'] = $profissional->getProfissional($id);
        
            $this->carregarTemplate('/telas/forms/formProfissional', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function excluir($id_profissional) {
        if($this->usuario->temPermissao('gerenciar_profissional')) {
            $profissional = new Profissional();

            $profissional->excluir($id_profissional);
            header("Location: ".URL_CMS."/profissional");
        } else {
            header("Location: ".URL_CMS);
        }
    }

}