<?php
class GaleriaController extends Controller {
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

        if($usuario->temPermissao('gerenciar_galeria')) {
            $galeria = new Galeria();
            $dados['lista_galerias'] = $galeria->getListaGalerias($tipo = "");
            $this->carregarTemplateEmAdmin('sistema-adm/galeria', $dados);
        } else {
            header("Location: ".BASE_URL."/dashboard");
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();
        

        if($usuario->temPermissao('gerenciar_galeria')) {
            $galeria = new Galeria();
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
                
                $galeria->inserir($nome, $novo_nome_imagem, $alt_imagem_capa, $descricao, $slug, $id_fotos);

               header("Location: ".BASE_URL."/galeria");
            }
            $dados['info_galeria'] = array();
            $dados['imagens_galeria'] = array();
 
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formGaleria', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();
        

        if($usuario->temPermissao('gerenciar_galeria')) {
            $galeria = new Galeria();
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
                $galeria->editar($id, $nome, $novo_nome_imagem, $alt_imagem_capa, $descricao, $slug, $id_fotos, $imagens_vinculadas);
                
                header("Location: ".BASE_URL."/galeria");
            }

            $dados['info_galeria'] = $galeria->getGaleria($id);
            $dados['imagens_galeria'] = $galeria->getImagensPorGaleria($id);
        
            $this->carregarTemplateEmAdmin('/sistema-adm/forms/formGaleria', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_galeria) {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('gerenciar_galeria')) {
            $galeria = new Galeria();

            $galeria->excluir($id_galeria);
            header("Location: ".BASE_URL."/galeria");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}