<?php
class GrupoPermissao extends Model {

    private $grupo;
    private $permissoes;

    public function inserir($nome_permissao, $lista_permissoes) {
        try {
            $permissoes = implode(',', $lista_permissoes); //separa por vírgula os elementos do array
            $sql = $this->conexaodb->prepare("INSERT INTO grupo_permissao SET nome = :nome, permissoes = :permissoes");
            $sql->bindValue(":nome", $nome_permissao);
            $sql->bindValue(":permissoes", $permissoes);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir permissão! ".$e->getMessage();
        }
    }

    public function editar($id, $nome_permissao, $lista_permissoes) {
        try {
            $permissoes = implode(',', $lista_permissoes); //separa por vírgula os elementos do array
            $sql = $this->conexaodb->prepare("UPDATE grupo_permissao SET nome = :nome, permissoes = :permissoes WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":nome", $nome_permissao);
            $sql->bindValue(":permissoes", $permissoes);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível editar esse grupo! ".$e->getMessage();
        }
    }

    public function excluir($id_grupo) {
        try {
            $usuario = new Usuario();
            //verifica se o grupo a ser excluído está vinculado a algum usuário
            if($usuario->procurarGrupoNoUsuario($id_grupo) == false) {
                $sql = $this->conexaodb->prepare("DELETE FROM grupo_permissao WHERE id = :id");
                $sql->bindValue(":id", $id_grupo);
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

    public function getListaGrupos() {
        $resultado = array();

        $sql = $this->conexaodb->prepare('SELECT * FROM grupo_permissao');
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
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

    public function getGrupo($id_grupo) {
        $resultado = array();
        try{
            $sql = $this->conexaodb->prepare('SELECT * FROM grupo_permissao WHERE id = :id');
            $sql->bindValue(':id', $id_grupo);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $resultado = $sql->fetch();
                $resultado['permissoes'] = explode(',', $resultado['permissoes']); //transforma a string em parâmetros
            }
        } catch(PDOException $e) {
            echo "Não foi possível buscar grupo selecionado! ".$e->getMessage();
        }

        return $resultado;
    }

}