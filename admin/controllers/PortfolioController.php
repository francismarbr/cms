<?php
class PortfolioController extends Controller {
    
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
            'menu_ativo' => 'portfolio',
            'submenu_ativo' => ''
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_portfolio')) {
            $portfolio = new Portfolio();
            $this->dados['lista_portfolios'] = $portfolio->getListaPortfolios($tipo = "");
            $this->carregarTemplate('telas/portfolio', $this->dados);
        } else {
            header("Location: ".URL_CMS."/dashboard");
        }
    }

    public function inserir() {
         if($this->usuario->temPermissao('gerenciar_portfolio')) {
            $portfolio = new Portfolio();
            $formataNome = new FormataNome(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $midia = new Midia();

                $nome = addslashes($_POST['nome']);
                $imagem_capa = $_FILES['imagem_capa'];
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = $_POST['descricao'];
                $slug = addslashes($_POST['slug']);
                $fotos = $_FILES['fotos'];
                $id_fotos = array();
                if(empty($slug)) {
                    $slug = $formataNome->nome_amigavel($nome);
                }
                if(!empty($imagem_capa)){
                    $novo_nome_imagem = $midia->inserir_arquivo_unico($imagem_capa);
                }
                if(!empty($_FILES['fotos'])){
                    $id_fotos = $midia->inserir_multiplos_arquivos($fotos);
                }
                
               $portfolio->inserir($nome, $novo_nome_imagem, $alt_imagem_capa, $descricao, $slug, $id_fotos);
               
              header("Location: ".URL_CMS."/portfolio");
            }
            $this->dados['info_portfolio'] = array();
            $this->dados['imagens_portfolio'] = array();
 
            $this->carregarTemplate('telas/forms/formPortfolio', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_portfolio')) {
            $portfolio = new Portfolio();
            $formataNome = new FormataNome(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $midia = new Midia();

                $nome = addslashes($_POST['nome']);
                $imagem_capa = $_FILES['imagem_capa'];
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = $_POST['descricao'];
                $slug = addslashes($_POST['slug']);
                $fotos = $_FILES['fotos'];
                $id_fotos = array();
                $imagens_vinculadas = $_POST['imagens_vinculadas'];
                if(empty($slug)) {
                    $slug = $formataNome->nome_amigavel($nome);
                }
                if(!empty($imagem_capa)){
                    $novo_nome_imagem = $midia->inserir_arquivo_unico($imagem_capa);
                }
                if(!empty($fotos)){
                    $id_fotos = $midia->inserir_multiplos_arquivos($fotos);
                }
                $portfolio->editar($id, $nome, $novo_nome_imagem, $alt_imagem_capa, $descricao, $slug, $id_fotos, $imagens_vinculadas);
                
                header("Location: ".URL_CMS."/portfolio");
            }

            $this->dados['info_portfolio'] = $portfolio->getPortfolio($id);
            $this->dados['imagens_portfolio'] = $portfolio->getImagensPorPortfolio($id);
        
            $this->carregarTemplate('/telas/forms/formPortfolio', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function excluir($id_portfolio) {
        if($this->usuario->temPermissao('gerenciar_portfolio')) {
            $portfolio = new Portfolio();

            $portfolio->excluir($id_portfolio);
            header("Location: ".URL_CMS."/portfolio");
        } else {
            header("Location: ".URL_CMS);
        }
    }

}