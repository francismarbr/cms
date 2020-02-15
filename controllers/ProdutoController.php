<?php
class ProdutoController extends Controller {
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

        if($usuario->temPermissao('gerenciar_produto')) {
            $produto = new Produto();
            $dados['lista_produtos'] = $produto->getListaProdutos($tipo = "");
            $this->carregarTemplateEmAdmin('sistema-adm/produto', $dados);
        } else {
            header("Location: ".BASE_URL."/dashboard");
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();
        

        if($usuario->temPermissao('gerenciar_produto')) {
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
            $dados['info_produto'] = array();
            $dados['imagens_produto'] = array();
 
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formProduto', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();
        

        if($usuario->temPermissao('gerenciar_produto')) {
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

            $dados['info_produto'] = $produto->getProduto($id);
            $dados['imagens_produto'] = $produto->getImagensPorProduto($id);
        
            $this->carregarTemplateEmAdmin('/sistema-adm/forms/formProduto', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_produto) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_produto')) {
            $produto = new Produto();

            $produto->excluir($id_produto);
            header("Location: ".BASE_URL."/produto");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}