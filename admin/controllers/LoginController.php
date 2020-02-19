<?php
class loginController extends Controller {
    public function index() {
        $dados = array();

        if(isset($_POST['login']) && !empty($_POST['login'])) {
            $login = addslashes($_POST['login']);
            $senha = addslashes($_POST['senha']);

            $usuario = new Usuario();

            if($usuario->fazerLogin($login, $senha)) {
                header("Location: ".URL_CMS)."/dashboard";
                exit;
            } else {
                $dados['error'] = 'Login e/ou senha inválida!';
            }
        }

        $this->carregarView('telas/login', $dados);
    }

    public function logout() {
        $usuario = new Usuario();
        $usuario->logout();

        header("Location: ".URL_CMS."/login");
    }
}