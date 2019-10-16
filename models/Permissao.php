<?php
class Permissao extends Model {

    private $grupo;
    private $permissoes;

    public function inserir($nome_permissao) {
        try {
            $sql = $this->conexaodb->prepare("INSERT INTO permissao SET nome = :nome");
            $sql->bindValue(":nome", $nome_permissao);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir permissão! ".$e->getMessage(); exit;
        }
    }

    public function editar($id, $nome_permissao) {
        try {
            $sql = $this->conexaodb->prepare("UPDATE permissao SET nome = :nome WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":nome", $nome_permissao);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir permissão! ".$e->getMessage();
        }
    }

    public function excluir($id_permissao) {
        try {
            $sql = $this->conexaodb->prepare("DELETE FROM permissao WHERE id = :id");
            $sql->bindValue(":id", $id_permissao);
            $sql->execute();
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

    public function getPermissao($id) {
        $resultado = array();
        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM permissao WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            
            if($sql->rowCount() > 0) {
                $resultado = $sql->fetch();
            }
            return $resultado;
        } catch(PDOException $e) {
            echo "Não foi possível buscar este registro! ".$e->getMessage();
        }
    }

    /*** 
     * recebe o id do grupo de acesso do usuário logado e 
     * lista todas as permissões que ele tem
    */
    public function setGrupo($id) {
        $this->grupo = $id;
        $this->permissoes = array();

        $sql = $this->conexaodb->prepare("SELECT permissoes FROM grupo_permissao WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetch();

            if(empty($resultado['permissoes'])) {
                $resultado['permissoes'] ='0';
            }
            
            $permissoesGrupo = $resultado['permissoes'];

            $sql = $this->conexaodb->prepare("SELECT nome FROM permissao WHERE id IN ($permissoesGrupo)");
            $sql->execute();

            if($sql->rowCount() > 0) {
               foreach($sql->fetchAll() as $item) {
                   $this->permissoes[] = $item['nome'];
               }
            }
        }

    }

    public function getListaPermissoes() {
        $resultado = array();

        $sql = $this->conexaodb->prepare('SELECT * FROM permissao');
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
    }

}