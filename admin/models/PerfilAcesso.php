<?php
class PerfilAcesso extends Model {

    private $perfil;
    private $permissoes;

    public function inserir($nome_perfil, $lista_permissoes) {
        try {
            $permissoes = implode(',', $lista_permissoes); //separa por vírgula os elementos do array
            $sql = $this->conexaodb->prepare("INSERT INTO perfil_acesso SET nome = :nome, permissoes = :permissoes");
            $sql->bindValue(":nome", $nome_perfil);
            $sql->bindValue(":permissoes", $permissoes);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir permissão! ".$e->getMessage();
        }
    }

    public function editar($id, $nome_perfil, $lista_permissoes) {
        try {
            $permissoes = implode(',', $lista_permissoes); //separa por vírgula os elementos do array
            $sql = $this->conexaodb->prepare("UPDATE perfil_acesso SET nome = :nome, permissoes = :permissoes WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":nome", $nome_perfil);
            $sql->bindValue(":permissoes", $permissoes);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível editar esse perfil! ".$e->getMessage();
        }
    }

    public function excluir($id_perfil) {
        try {
            $usuario = new Usuario();
            //verifica se o perfil a ser excluído está vinculado a algum usuário
            if($usuario->procurarPerfilNoUsuario($id_perfil) == false) {
                $sql = $this->conexaodb->prepare("DELETE FROM perfil_acesso WHERE id = :id");
                $sql->bindValue(":id", $id_perfil);
                $sql->execute();
            }
        } catch(PDOException $e) {
            echo "Não foi possível deletar este registro! ".$e->getMessage();
        }
    }

    //verifica o usuário tem permissão para acessar tela
    public function temPermissao($nome) {
        if(in_array($nome, $this->permissoes)) {
            return true;
        } else {
            return false;
        }
    }

    public function getListaPerfisAcesso() {
        $resultado = array();

        $sql = $this->conexaodb->prepare('SELECT * FROM perfil_acesso');
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
    }

    /*** 
     * recebe o id do perfil de acesso do usuário logado e 
     * lista todas as permissões que ele tem
    */
    public function setPerfilAcesso($id) {
        $this->perfil = $id;
        $this->permissoes = array();

        $sql = $this->conexaodb->prepare("SELECT permissoes FROM perfil_acesso WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetch();

            if(empty($resultado['permissoes'])) {
                $resultado['permissoes'] ='0';
            }
            
            $permissoesPerfil = $resultado['permissoes'];

            $sql = $this->conexaodb->prepare("SELECT nome FROM permissao WHERE id IN ($permissoesPerfil)");
            $sql->execute();

            if($sql->rowCount() > 0) {
               foreach($sql->fetchAll() as $item) {
                   $this->permissoes[] = $item['nome'];
               }
            }
        }

    }

    public function getPerfilAcesso($id_perfil) {
        $resultado = array();
        try{
            $sql = $this->conexaodb->prepare('SELECT * FROM perfil_acesso WHERE id = :id');
            $sql->bindValue(':id', $id_perfil);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $resultado = $sql->fetch();
                $resultado['permissoes'] = explode(',', $resultado['permissoes']); //transforma a string em parâmetros
            }
        } catch(PDOException $e) {
            echo "Não foi possível buscar perfil selecionado! ".$e->getMessage();
        }

        return $resultado;
    }

}