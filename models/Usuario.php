<?php 
class Usuario extends Model {

    private $infoUsuario;
    private $permissoes;

    public function inserir($nome, $email, $login, $senha, $grupo_permissao) {
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
                $sql .= "login = :login, senha = :senha, grupo_id = :grupo_permissao";
                $sql = $this->conexaodb->prepare($sql);
                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':login', $login);
                $sql->bindValue(':senha', md5($senha));
                $sql->bindValue(':grupo_permissao', $grupo_permissao);
            
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

    public function editar($id, $nome, $login, $senha, $grupo_permissao) {
        try {

            $sqlVerificaLogin = $this->conexaodb->prepare("SELECT * FROM usuario WHERE login = :login AND id <> :id");
            $sqlVerificaLogin->bindValue(':login', $login);
            $sqlVerificaLogin->bindValue(':id', $id);
            $sqlVerificaLogin->execute();

            //só atualiza o usuário se o login não existir no banco vinculado a outro usuário
            if(  !($sqlVerificaLogin->rowCount() > 0) ) {
                $sql = "UPDATE usuario SET nome = :nome, login = :login, grupo_id = :grupo_permissao";
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
                $sql->bindValue(':grupo_permissao', $grupo_permissao);
            
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
                $this->permissoes->setGrupo($this->infoUsuario['grupo_id']);
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

    //verifica se um determinado grupo está vinculado a algum usuário
    public function procurarGrupoNoUsuario($id_grupo) {
        $sql = "SELECT * FROM usuario WHERE grupo_id = :id_grupo";
        $sql = $this->conexaodb->prepare($sql);
        $sql->bindValue(':id_grupo', $id_grupo);
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
                grupo_permissao.nome as grupo_permissao
                FROM usuario
                LEFT JOIN grupo_permissao ON grupo_permissao.id = usuario.grupo_id";
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