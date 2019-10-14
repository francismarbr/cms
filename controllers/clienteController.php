<?php
class clienteController extends Controller {
    public function __construct() {
        $usuario = new Usuario();
        //se o usuário não estiver logado, redireciona para login
        if($usuario->isLogado() == false) {
            header("Location: ".BASE_URL."/painel-adm/login");
            exit;
        }
    }

    public function index() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('visualizar_clientes')) {
            $cliente = new Cliente();
            $qtd_por_pag = 0; //para fazer paginação da lista de clientes
            $dados['lista_clientes'] = $cliente->getLista($qtd_por_pag);
            $dados['add_cliente'] = $usuario->temPermissao('alterar_clientes');


            $this->carregarTemplate('painel-adm/cliente', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inserir() {
        $dados = array();
        $usuario = new Usuario();
        $usuario->setUsuarioLogado();
        $dados['nome_usuario'] = $usuario->getNome();

        if($usuario->temPermissao('alterar_cliente')) {
            $cliente = new Cliente(); 

            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                $nome_permissao = addslashes($_POST['nome']);
                $permissao->inserir($nome_permissao);
                header("Location: ".BASE_URL."/painel-adm/cliente");
            }
            $dados['info_cliente'] = array(); //permite que a variável info_cliente exista na view, mas não carrega nenhuma informação 
            $this->carregarTemplate('cadastrarCliente', $dados);
        } else {
            header("Location: ".BASE_URL."painel-adm/cliente");
        }
    }
}
?>