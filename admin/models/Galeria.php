<?php
class Galeria extends model {

    public function inserir($nome, $imagem_capa, $alt_imagem_capa, $descricao, $slug, $fotos) {
        
        try {
            $sql = "INSERT INTO galeria SET nome = :nome, imagem_capa = :imagem_capa, descricao = :descricao, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, slug = :slug";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":imagem_capa", $imagem_capa);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":slug", $slug);
            if($sql->execute()) {
                $id_galeria = $this->conexaodb->lastInsertId();
                $this->inserir_imagens_galeria($id_galeria, $fotos);
            }
        } catch(PDOException $e) {
            echo "Não foi possível inserir página! ".$e->getMessage(); exit;
        }
    }

    public function inserir_imagens_galeria($id_galeria, $fotos) {
        for($item = 0; $item < count($fotos); $item++) {
            try {
                $sql = "INSERT INTO imagens_galeria SET id_galeria = :id_galeria, id_midia = :id_midia";
                $sql = $this->conexaodb->prepare($sql);
                $sql->bindValue(":id_galeria", $id_galeria);
                $sql->bindValue(':id_midia', $fotos[$item]);
                $sql->execute();
            } catch(PDOException $e) {
                echo "Não foi possível inserir página! ".$e->getMessage(); exit;
            }
        }
    }
    
    public function editar($id, $nome, $imagem, $alt_imagem_capa, $descricao, $slug, $id_fotos, $imagens_vinculadas) {
        try {
            $sql = "UPDATE galeria SET nome = :nome, descricao = :descricao, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, slug = :slug";
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
            $sql->execute();
            
            if(is_array($imagens_vinculadas)) {

                foreach($imagens_vinculadas as $chave => $id_imagem) {
                    $imagens_vinculadas[$chave] = intval($id_imagem);
                }

                $sql = "DELETE FROM imagens_galeria WHERE id_galeria = :id_galeria AND id_midia NOT IN (".implode(',', $imagens_vinculadas).")";
                $sql = $this->conexaodb->prepare($sql);
                $sql->bindValue(':id_galeria', $id);
                $sql->execute();
            }

            if(!empty($id_fotos)) {
                $this->inserir_imagens_galeria($id, $id_fotos);
            }

        } catch(PDOException $e) {
            echo "Não foi possível atualizar este galeria! ".$e->getMessage(); exit;
        }
    }

    public function getImagensPorGaleria($id_galeria) {
        $resultado = array();
        try {

            $sql = "SELECT m.id, m.nome as nome_imagem FROM midia m, imagens_galeria ip WHERE ip.id_galeria = :id_galeria AND ip.id_midia = m.id";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":id_galeria", $id_galeria);
            $sql->execute();
            if($sql->rowCount() > 0) {
                $resultado = $sql->fetchAll();
            }
        } catch(PDOException $e) {
            echo "Erro ao realizar consulta.".$e->getMessage(); exit;
        }
        return $resultado;
    }

    public function excluir($id_galeria) {
        try {
            $sql = $this->conexaodb->prepare("DELETE FROM galeria WHERE id = :id");
            $sql->bindValue(":id", $id_galeria);
            $sql->execute();

            $sql = $this->conexaodb->prepare("DELETE FROM imagens_galeria WHERE id_galeria = :id_galeria");
            $sql->bindValue(':id_galeria', $id_galeria);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível deletar este registro! ".$e->getMessage();
        }
    }

    public function getGaleria($id) {
        $resultado = array();
        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM galeria WHERE id = :id");
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

    public function getListaGalerias() {
        $resultado = array();

        $sql = "SELECT * FROM galeria";
        $sql = $this->conexaodb->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
    }
}