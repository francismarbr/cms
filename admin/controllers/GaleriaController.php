<?php
class GaleriaController extends Controller {
    
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
            'menu_ativo' => 'galeria',
            'submenu_ativo' => ''
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_galeria')) {
            $galeria = new Galeria();
            $this->dados['lista_galerias'] = $galeria->getListaGalerias($tipo = "");
            $this->carregarTemplate('telas/galeria', $this->dados);
        } else {
            header("Location: ".URL_CMS."/dashboard");
        }
    }

    public function inserir() {
        if($this->usuario->temPermissao('gerenciar_galeria')) {
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

               header("Location: ".URL_CMS."/galeria");
            }
            $this->dados['info_galeria'] = array();
            $this->dados['imagens_galeria'] = array();
 
            $this->carregarTemplate('telas/forms/formGaleria', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_galeria')) {
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
                
                header("Location: ".URL_CMS."/galeria");
            }

            $this->dados['info_galeria'] = $galeria->getGaleria($id);
            $this->dados['imagens_galeria'] = $galeria->getImagensPorGaleria($id);
        
            $this->carregarTemplate('/telas/forms/formGaleria', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function excluir($id_galeria) {
        if($this->usuario->temPermissao('gerenciar_galeria')) {
            $galeria = new Galeria();

            $galeria->excluir($id_galeria);
            header("Location: ".URL_CMS."/galeria");
        } else {
            header("Location: ".URL_CMS);
        }
    }

}