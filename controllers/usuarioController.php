<?php
class usuarioController extends Controller {

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
            'menu_ativo' => 'configuracoes',
            'submenu_ativo' => 'usuario'
        );
    }

    public function index() {
        if($this->usuario->temPermissao('gerenciar_usuarios')) {
            $this->dados['lista_usuarios'] = $this->usuario->getListaUsuarios(); 
            $this->carregarTemplateEmAdmin('sistema-adm/usuario', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inserir() {
        if($this->usuario->temPermissao('gerenciar_usuarios')) { 
            if(isset($_POST['login']) && !empty($_POST['login'])){
                $nome = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
                $login = addslashes($_POST['login']);
                $senha = addslashes($_POST['senha']);
                $perfil_acesso = addslashes($_POST['perfil']);

                $retorno = $this->usuario->inserir($nome, $email, $login, $senha, $perfil_acesso);
               
                if($retorno == '2') {
                    $this->dados['msg_informativa'] = "O email que você digitou já existe.";
                } elseif($retorno == '3'){
                    $this->dados['msg_informativa'] = "O login que você escolheu já existe.";
                } else {
                    header("Location: ".BASE_URL."/usuario");
                }  
            }
            $perfilAcesso = new PerfilAcesso();
            $this->dados['lista_perfis'] = $perfilAcesso->getListaPerfisAcesso();
            $this->dados['info_usuario'] = array();
            $this->carregarTemplateEmAdmin('sistema-adm/forms/formUsuario', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function editar($id) {
        if($this->usuario->temPermissao('gerenciar_usuarios')) {
            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome = addslashes($_POST['nome']);
                $login = addslashes($_POST['login']);
                $senha = addslashes($_POST['senha']);
                $perfil_acesso = addslashes($_POST['perfil']);
                
                $retorno = $this->usuario->editar($id, $nome, $login, $senha, $perfil_acesso);

                if($retorno == '0'){
                    $this->dados['msg_informativa'] = "O login que você escolheu já existe.";
                } else {
                    header("Location: ".BASE_URL."/usuario");
                } 
            }
            
            $perfilAcesso = new PerfilAcesso();
            $this->dados['lista_perfis'] = $perfilAcesso->getListaPerfisAcesso();
            $this->dados['info_usuario'] = $this->usuario->getInformacoes($id);

            $this->carregarTemplateEmAdmin('sistema-adm/forms/formUsuario', $this->dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function excluir($id_usuario) {
        if($this->usuario->temPermissao('gerenciar_usuarios')) {
            $this->usuario->excluir($id_usuario);
            header("Location: ".BASE_URL."/usuario");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}