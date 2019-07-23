<?php 
class Usuario extends Model {

    private $infoUsuario;
    private $permissoes;

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

            $_SESSION['ccUsuario'] = $resultado['id'];
            
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
                $this->permissoes->setGrupo($this->infoUsuario['grupo'], $this->infoUsuario['empresa_id']);
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
    
}