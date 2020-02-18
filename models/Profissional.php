<?php
class Profissional extends Model {

    public function inserir($nome, $imagem_capa, $alt_imagem_capa, $descricao, $slug, $cargo) {
        
        try {
            $sql = "INSERT INTO profissional SET nome = :nome, imagem_capa = :imagem_capa, descricao = :descricao, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, slug = :slug, cargo = :cargo";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":imagem_capa", $imagem_capa);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":slug", $slug);
            $sql->bindValue(":cargo", $cargo);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir porfólio! ".$e->getMessage(); exit;
        }
    }
    
    public function editar($id, $nome, $imagem, $alt_imagem_capa, $descricao, $slug, $cargo) {
        try {
            $sql = "UPDATE profissional SET nome = :nome, descricao = :descricao, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, slug = :slug, cargo = :cargo";
            if(!empty($imagem_capa)) {
                $sql .= ", imagem_capa = :imagem_capa";
            }
            $sql .= " WHERE id = :id";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":nome", $nome);
            if(!empty($imagem_capa)) {
                $sql->bindValue(":imagem_capa", $imagem_capa);
            }
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":slug", $slug);
            $sql->bindValue(":cargo", $cargo);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível atualizar este profissional! ".$e->getMessage(); exit;
        }
    }

    public function excluir($id_profissional) {
        try {
            $sql = $this->conexaodb->prepare("DELETE FROM profissional WHERE id = :id");
            $sql->bindValue(":id", $id_profissional);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível deletar este registro! ".$e->getMessage();
        }
    }

    public function getProfissional($id) {
        $resultado = array();
        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM profissional WHERE id = :id");
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

    public function getListaProfissionais() {
        $resultado = array();

        $sql = "SELECT * FROM profissional";
        $sql = $this->conexaodb->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
    }
}