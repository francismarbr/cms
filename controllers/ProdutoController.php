<?php
class ProdutoController extends Controller {

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
            'menu_ativo' => 'produto',
            'submenu_ativo' => ''           
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_produto')) {
            $produto = new Produto();
            $this->dados['lista_produtos'] = $produto->getListaProdutos($tipo = "");
            $this->carregarTemplateEmAdmin('sistema-adm/produto', $this->dados);
        } else {
            header("Location: ".BASE_URL."/dashboard");
        }
    }

    public function inserir() {
        if($this->usuario->temPermissao('gerenciar_produto')) {
            $produto = new Produto();
            $formataNome = new FormataNome(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $midia = new Midia();

                $nome = addslashes($_POST['nome']);
                $imagem_capa = $_FILES['imagem_capa'];
                $preco = addslashes($_POST['preco']);
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
                $produto->inserir($nome, $novo_nome_imagem, $preco, $alt_imagem_capa, $descricao, $slug, $id_fotos);

                header("Location: ".BASE_URL."/produto");
            }
            $this->dados['info_produto'] = array();
            $this->dados['imagens_produto'] = array();
 
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formProduto', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_produto')) {
            $produto = new Produto();
            $formataNome = new FormataNome(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $midia = new Midia();

                $nome = addslashes($_POST['nome']);
                $imagem_capa = $_FILES['imagem_capa'];
                $preco = addslashes($_POST['preco']);
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
                $produto->editar($id, $nome, $novo_nome_imagem, $preco, $alt_imagem_capa, $descricao, $slug, $id_fotos, $imagens_vinculadas);
                
                header("Location: ".BASE_URL."/produto");
            }

            $this->dados['info_produto'] = $produto->getProduto($id);
            $this->dados['imagens_produto'] = $produto->getImagensPorProduto($id);
        
            $this->carregarTemplateEmAdmin('/sistema-adm/forms/formProduto', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_produto) {
        if($this->usuario->temPermissao('gerenciar_produto')) {
            $produto = new Produto();

            $produto->excluir($id_produto);
            header("Location: ".BASE_URL."/produto");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}