<?php 
class Usuario extends Model {

    private $infoUsuario;
    private $permissoes;

    public function inserir($nome, $email, $login, $senha, $perfil_acesso) {
        try {

            $sqlVerificaEmail = $this->conexaodb->prepare("SELECT * FROM usuario WHERE email = :email");
            $sqlVerificaEmail->bindValue(':email', $email);
            $sqlVerificaEmail->execute();

            $sqlVerificaLogin = $this->conexaodb->prepare("SELECT * FROM usuario WHERE login = :login");
            $sqlVerificaLogin->bindValue(':login', $login);
            $sqlVerificaLogin->execute();

            //só insere um novo usuário se o login e o email não existirem no banco vinculado a outro usuário
            if( !($sqlVerificaEmail->rowCount() > 0) && !($sqlVerificaLogin->rowCount() > 0) ) {
                $sql = "INSERT INTO usuario SET nome = :nome, email = :email, ";
                $sql .= "login = :login, senha = :senha, perfil_acesso_id = :perfil_acesso";
                $sql = $this->conexaodb->prepare($sql);
                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':login', $login);
                $sql->bindValue(':senha', md5($senha));
                $sql->bindValue(':perfil_acesso', $perfil_acesso);
            
                if($sql->execute()){
                    return '1';
                }

            } else {
                if($sqlVerificaEmail->rowCount() > 0) {
                    return '2';
                } 
                if($sqlVerificaLogin->rowCount() > 0) {
                    return '3';
                }
            }
            
        } catch(PDOException $e) {
            echo "Não foi possível inserir este usuário! ".$e->getMessage();
        }
    }

    public function editar($id, $nome, $login, $senha, $perfil_acesso) {
        try {

            $sqlVerificaLogin = $this->conexaodb->prepare("SELECT * FROM usuario WHERE login = :login AND id <> :id");
            $sqlVerificaLogin->bindValue(':login', $login);
            $sqlVerificaLogin->bindValue(':id', $id);
            $sqlVerificaLogin->execute();

            //só atualiza o usuário se o login não existir no banco vinculado a outro usuário
            if(  !($sqlVerificaLogin->rowCount() > 0) ) {
                $sql = "UPDATE usuario SET nome = :nome, login = :login, perfil_acesso_id = :perfil_acesso";
                //se a senha não foi alterada na edição, evita que seja salva uma senha em branco no banco
                if(!empty($senha)) {
                    $sql .= ", senha = :senha";
                }
                $sql .= " WHERE id = :id";
                $sql = $this->conexaodb->prepare($sql);
                $sql->bindValue(':id', $id);
                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':login', $login);
                if(!empty($senha)) {
                    $sql->bindValue(':senha', md5($senha));
                }
                $sql->bindValue(':perfil_acesso', $perfil_acesso);
            
                if($sql->execute()){
                    return '1';
                }

            } else {
                return '0';
            }
            
        } catch(PDOException $e) {
            echo "Não foi possível inserir este usuário! ".$e->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $sql = $this->conexaodb->prepare("DELETE FROM usuario WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível excluir esse usuário! ".$e->getMessage(); 
        }
    }

    public function isLogado() {
        if(isset($_SESSION['ccUsuario']) && !empty($_SESSION['ccUsuario'])) {
            return true;
        } else {
            return false;
        }
    }

    public function fazerLogin($login, $senha) {
        $sql = $this->conexaodb->prepare("SELECT * FROM usuario WHERE login = :login AND senha = :senha");
        $sql->bindValue(':login', $login);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetch();

            $_SESSION['ccUsuario'] = $resultado['id']; //salva na sessão id do usuário
            
            return true;
        } else {
            return false;
        }
    }

    public function setUsuarioLogado() {
        if(isset($_SESSION['ccUsuario']) && !empty($_SESSION['ccUsuario'])) {
            $id = $_SESSION['ccUsuario'];

            $sql = $this->conexaodb->prepare("SELECT * FROM usuario WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $this->infoUsuario = $sql->fetch();
                $this->permissoes = new Permissao();
                $this->permissoes->setPerfilAcesso($this->infoUsuario['perfil_acesso_id']);
            }
        }
    }

    public function logout() {
        unset($_SESSION['ccUsuario']);
    }

    public function temPermissao($nome) {
        return $this->permissoes->temPermissao($nome);
    }

    public function getEmpresa() {
        return $this->infoUsuario['empresa_id'];
    }

    public function getNome() {
        return $this->infoUsuario['nome'];
    }

    public function getInformacoes($id_usuario) {
        $resultado = array();

        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM usuario WHERE id = :id");
            $sql->bindValue(':id', $id_usuario);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $resultado = $sql->fetch();
            }
        } catch(PDOException $e) {
            echo "Não foi possível realizar a busca! ".$e->getMessage();
        }

        return $resultado;
    }

    //verifica se um determinado perfil está vinculado a algum usuário
    public function procurarPerfilNoUsuario($id_perfil) {
        $sql = "SELECT * FROM usuario WHERE perfil_acesso_id = :id_perfil";
        $sql = $this->conexaodb->prepare($sql);
        $sql->bindValue(':id_perfil', $id_perfil);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getListaUsuarios() {
        $resultado = array();

        try {
            $sql = "SELECT 
                usuario.id, 
                usuario.nome, 
                usuario.email, 
                usuario.login, 
                perfil_acesso.nome as perfil_acesso
                FROM usuario
                LEFT JOIN perfil_acesso ON perfil_acesso.id = usuario.perfil_acesso_id";
            $sql = $this->conexaodb->prepare($sql);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $resultado = $sql->fetchAll();
            }
        } catch(PDOException $e) {
            echo "Não foi possível consultar os usuários! ".$e->getMessage();
        }

        return $resultado;
    }
    
}