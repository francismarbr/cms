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
                $nome = addslashes($_POST['nome']);
                $imagem_capa = $_FILES['imagem_capa'];
                $preco = addslashes($_POST['preco']);
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = addslashes($_POST['descricao']);
                $slug = addslashes($_POST['slug']);
                if(empty($slug)) {
                    $slug = $formataNome->nome_amigavel($nome);
                }
                if(!empty($imagem_capa)){
                    $midia = new Midia();
                    $novo_nome_imagem = $midia->inserir_arquivo_unico($imagem_capa);
                }
                $produto->inserir($nome, $novo_nome_imagem, $preco, $alt_imagem_capa, $descricao, $slug);

                header("Location: ".BASE_URL."/produto");
            }
            $dados['info_produto'] = array();
 
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
                $nome = addslashes($_POST['nome']);
                $imagem_capa = $_FILES['imagem_capa'];
                $preco = addslashes($_POST['preco']);
                $alt_imagem_capa = addslashes($_POST['alt_imagem_capa']);
                $descricao = addslashes($_POST['descricao']);
                $slug = addslashes($_POST['slug']);
                if(empty($slug)) {
                    $slug = $formataNome->nome_amigavel($nome);
                }
                if(!empty($imagem_capa)){
                    $midia = new Midia();
                    $novo_nome_imagem = $midia->inserir_arquivo_unico($imagem_capa);
                }
                $produto->editar($id, $nome, $novo_nome_imagem, $preco, $alt_imagem_capa, $descricao, $slug);
                
                header("Location: ".BASE_URL."/produto");
            }

            $dados['info_produto'] = $produto->getProduto($id);
        
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