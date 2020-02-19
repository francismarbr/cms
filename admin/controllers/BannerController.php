<?php
class BannerController extends Controller {
    
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
            'menu_ativo' => 'banner',
            'submenu_ativo' => ''
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_banner')) {
            $banner = new Banner();
            $this->dados['lista_banners'] = $banner->getListaBanners($tipo = "");
            
            $this->carregarTemplate('telas/banner', $this->dados);
        } else {
            header("Location: ".URL_CMS."/dashboard");
        }
    }

    public function inserir() {
        if($this->usuario->temPermissao('gerenciar_banner')) {
            $banner = new Banner();
            $midia = new Midia();

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome = addslashes($_POST['nome']);
                $imagem = $_FILES['imagem_banner'];
                $mostrar = addslashes($_POST['mostrar']);
                $ordem = addslashes($_POST['ordem']);
                if(!empty($imagem)) {
                    $imagem = $midia->inserir_arquivo_unico($imagem);
                }
                
                $banner->inserir($nome, $imagem, $mostrar, $ordem);

                header("Location: ".URL_CMS."/banner");
            }
            $this->dados['info_banner'] = array(); //permite que a variável info_permissao exista na view, mas não carrega nenhuma informação 
            $this->carregarTemplate('telas/forms/formBanner', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_banner')) {
            $banner = new Banner();
            $midia = new Midia();

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome = addslashes($_POST['nome']);
                $imagem = $_FILES['imagem_banner'];
                $mostrar = addslashes($_POST['mostrar']);
                $ordem = addslashes($_POST['ordem']);
                if(!empty($imagem)) {
                    $imagem = $midia->inserir_arquivo_unico($imagem);
                }
                $banner->editar($id, $nome, $imagem, $mostrar, $ordem);

                header("Location: ".URL_CMS."/banner");
            }
            $this->dados['info_banner'] = $banner->getBanner($id);
            $this->carregarTemplate('telas/forms/formBanner', $this->dados);
        } else {
            header("Location: ".URL_CMS);
        }
    }

    public function excluir($id_banner) {
        if($this->usuario->temPermissao('gerenciar_banner')) {
            $banner = new Banner();

            $banner->excluir($id_banner);
            header("Location: ".URL_CMS."/banner");
        } else {
            header("Location: ".URL_CMS);
        }
    }

}