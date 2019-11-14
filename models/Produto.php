<?php
class Produto extends model {

    public function inserir($nome, $imagem, $preco, $alt_imagem_capa, $descricao, $slug) {
        try {
            $sql = "INSERT INTO produto SET nome = :nome, imagem = :imagem, descricao = :descricao, preco = :preco, alt_imagem_capa = :alt_imagem_capa, slug = :slug";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":imagem", $imagem);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":preco", $preco);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":slug", $slug);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir página! ".$e->getMessage(); exit;
        }
    }
            
    public function editar($id, $nome, $imagem, $preco, $alt_imagem_capa, $descricao, $slug) {
        try {
            $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, preco = :preco, slug = :slug";
            if(!empty($imagem)) {
                $sql .= ", imagem = :imagem";
            }
            $sql .= " WHERE id = :id";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":nome", $nome);
            if(!empty($imagem)) {
                $sql->bindValue(":imagem", $imagem);
            }
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":preco", $preco);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":slug", $slug);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível atualizar este produto! ".$e->getMessage(); exit;
        }
    }

    public function excluir($id_produto) {
        try {
            $sql = $this->conexaodb->prepare("DELETE FROM produto WHERE id = :id");
            $sql->bindValue(":id", $id_produto);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível deletar este registro! ".$e->getMessage();
        }
    }

    public function getProduto($id) {
        $resultado = array();
        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM produto WHERE id = :id");
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

    public function getListaProdutos() {
        $resultado = array();

        $sql = "SELECT * FROM produto";
        $sql = $this->conexaodb->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
    }
}