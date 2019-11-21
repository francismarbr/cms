<?php
class Portfolio extends model {

    public function inserir($nome, $imagem_capa, $alt_imagem_capa, $descricao, $slug, $fotos) {
       
        try {
            $sql = "INSERT INTO portfolio SET nome = :nome, imagem_capa = :imagem_capa, descricao = :descricao, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, slug = :slug";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":imagem_capa", $imagem_capa);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":slug", $slug);
            if($sql->execute()) {
                $id_portfolio = $this->conexaodb->lastInsertId();
                $this->inserir_imagens_portfolio($id_portfolio, $fotos);
            }
        } catch(PDOException $e) {
            echo "Não foi possível inserir porfólio! ".$e->getMessage(); exit;
        }
    }

    public function inserir_imagens_portfolio($id_portfolio, $fotos) {
        for($item = 0; $item < count($fotos); $item++) {
            try {
                $sql = "INSERT INTO imagens_portfolio SET id_portfolio = :id_portfolio, id_midia = :id_midia";
                $sql = $this->conexaodb->prepare($sql);
                $sql->bindValue(":id_portfolio", $id_portfolio);
                $sql->bindValue(':id_midia', $fotos[$item]);
                $sql->execute();
            } catch(PDOException $e) {
                echo "Não foi possível inserir porfólio! ".$e->getMessage(); exit;
            }
        }
    }
    
    public function editar($id, $nome, $imagem, $alt_imagem_capa, $descricao, $slug, $id_fotos, $imagens_vinculadas) {
        try {
            $sql = "UPDATE portfolio SET nome = :nome, descricao = :descricao, ";
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

                $sql = "DELETE FROM imagens_portfolio WHERE id_portfolio = :id_portfolio AND id_midia NOT IN (".implode(',', $imagens_vinculadas).")";
                $sql = $this->conexaodb->prepare($sql);
                $sql->bindValue(':id_portfolio', $id);
                $sql->execute();
            }

            if(!empty($id_fotos)) {
                $this->inserir_imagens_portfolio($id, $id_fotos);
            }

        } catch(PDOException $e) {
            echo "Não foi possível atualizar este portfolio! ".$e->getMessage(); exit;
        }
    }

    public function getImagensPorPortfolio($id_portfolio) {
        $resultado = array();
        try {

            $sql = "SELECT m.id, m.nome as nome_imagem FROM midia m, imagens_portfolio ip WHERE ip.id_portfolio = :id_portfolio AND ip.id_midia = m.id";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":id_portfolio", $id_portfolio);
            $sql->execute();
            if($sql->rowCount() > 0) {
                $resultado = $sql->fetchAll();
            }
        } catch(PDOException $e) {
            echo "Erro ao realizar consulta.".$e->getMessage(); exit;
        }
        return $resultado;
    }

    public function excluir($id_portfolio) {
        try {
            $sql = $this->conexaodb->prepare("DELETE FROM portfolio WHERE id = :id");
            $sql->bindValue(":id", $id_portfolio);
            $sql->execute();

            $sql = $this->conexaodb->prepare("DELETE FROM imagens_portfolio WHERE id_portfolio = :id_portfolio");
            $sql->bindValue(':id_portfolio', $id_portfolio);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível deletar este registro! ".$e->getMessage();
        }
    }

    public function getPortfolio($id) {
        $resultado = array();
        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM portfolio WHERE id = :id");
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

    public function getListaPortfolios() {
        $resultado = array();

        $sql = "SELECT * FROM portfolio";
        $sql = $this->conexaodb->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
    }
}