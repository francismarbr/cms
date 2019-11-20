<?php
class Produto extends model {

    public function inserir($nome, $imagem_capa, $preco, $alt_imagem_capa, $descricao, $slug, $fotos, $imagens_vinculadas) {
        try {
            $sql = "INSERT INTO produto SET nome = :nome, imagem_capa = :imagem_capa, descricao = :descricao, preco = :preco, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, slug = :slug";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":imagem_capa", $imagem_capa);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":preco", $preco);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":slug", $slug);
            if($sql->execute()) {
                $id_produto = $this->conexaodb->lastInsertId();
                $this->inserir_imagens_produto($id_produto, $fotos);
            }
        } catch(PDOException $e) {
            echo "Não foi possível inserir página! ".$e->getMessage(); exit;
        }
    }

    public function inserir_imagens_produto($id_produto, $fotos) {
        for($item = 0; $item < count($fotos); $item++) {
            try {
                $sql = "INSERT INTO imagens_produto SET id_produto = :id_produto, id_midia = :id_midia";
                $sql = $this->conexaodb->prepare($sql);
                $sql->bindValue(":id_produto", $id_produto);
                $sql->bindValue(':id_midia', $fotos[$item]);
                $sql->execute();
            } catch(PDOException $e) {
                echo "Não foi possível inserir página! ".$e->getMessage(); exit;
            }
        }
    }
    
    public function editar($id, $nome, $imagem, $preco, $alt_imagem_capa, $descricao, $slug, $id_fotos, $imagens_vinculadas) {
        try {
            $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, preco = :preco, slug = :slug";
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
            $sql->bindValue(":preco", $preco);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":slug", $slug);
            $sql->execute();
            
            if(is_array($imagens_vinculadas)) {

                foreach($imagens_vinculadas as $chave => $id_imagem) {
                    $imagens_vinculadas[$chave] = intval($id_imagem);
                }

                $sql = "DELETE FROM imagens_produto WHERE id_produto = :id_produto AND id_midia NOT IN (".implode(',', $imagens_vinculadas).")";
                $sql = $this->conexaodb->prepare($sql);
                $sql->bindValue(':id_produto', $id);
                $sql->execute();
            }

            if(!empty($id_fotos)) {
                $this->inserir_imagens_produto($id, $id_fotos);
            }

        } catch(PDOException $e) {
            echo "Não foi possível atualizar este produto! ".$e->getMessage(); exit;
        }
    }

    public function getImagensPorProduto($id_produto) {
        $resultado = array();
        try {

            $sql = "SELECT m.id, m.nome as nome_imagem FROM midia m, imagens_produto ip WHERE ip.id_produto = :id_produto AND ip.id_midia = m.id";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":id_produto", $id_produto);
            $sql->execute();
            if($sql->rowCount() > 0) {
                $resultado = $sql->fetchAll();
            }
        } catch(PDOException $e) {
            echo "Erro ao realizar consulta.".$e->getMessage(); exit;
        }
        return $resultado;
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