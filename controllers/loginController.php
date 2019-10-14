<?php
class loginController extends Controller {
    public function index() {
        $dados = array();

        if(isset($_POST['login']) && !empty($_POST['login'])) {
            $login = addslashes($_POST['login']);
            $senha = addslashes($_POST['senha']);

            $usuario = new Usuario();

            if($usuario->fazerLogin($login, $senha)) {
                header("Location: ".BASE_URL)."/painel-adm/dashboard";
                exit;
            } else {
                $dados['error'] = 'Login e/ou senha inválida!';
            }
        }

        $this->carregarView('painel-adm/login', $dados);
    }

    public function logout() {
        $usuario = new Usuario();
        $usuario->logout();

        header("Location: ".BASE_URL."/painel-adm/login");
    }
}