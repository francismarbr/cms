<?php
class Categoria extends Model {

    public function inserir($nome) {
        try {
            $sql = $this->conexaodb->prepare("INSERT INTO categoria SET nome = :nome");
            $sql->bindValue(":nome", $nome);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir categoria! ".$e->getMessage(); exit;
        }
    }

    public function editar($id, $nome) {
        try {
            $sql = $this->conexaodb->prepare("UPDATE categoria SET nome = :nome WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":nome", $nome);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir categoria! ".$e->getMessage();
        }
    }

    public function excluir($id_categoria) {
        try {
            $sql = $this->conexaodb->prepare("DELETE FROM categoria WHERE id = :id");
            $sql->bindValue(":id", $id_categoria);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível deletar este registro! ".$e->getMessage();
        }
    }

    public function getCategoria($id) {
        $resultado = array();
        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM categoria WHERE id = :id");
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

    public function getListaCategorias() {
        $resultado = array();

        $sql = $this->conexaodb->prepare('SELECT * FROM categoria');
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
    }

}