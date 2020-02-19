<?php
class Banner extends Model {

    public function inserir($nome, $imagem, $mostrar, $ordem) {
        try {
            $sql = "INSERT INTO banner_slider SET nome = :nome, imagem = :imagem, mostrar = :mostrar, ordem = :ordem";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":imagem", $imagem);
            $sql->bindValue(":mostrar", $mostrar);
            $sql->bindValue(":ordem", $ordem);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir Banner! ".$e->getMessage(); exit;
        }
    }

    public function editar($id, $nome, $imagem, $mostrar, $ordem) {
        try {
            $sql = "UPDATE banner_slider SET nome = :nome, mostrar = :mostrar, ordem = :ordem";
            if(!empty($imagem)) {
                $sql .= ", imagem = :imagem";
            }
            $sql .= " WHERE id = :id";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->bindValue(':nome', $nome);
            if(!empty($imagem)) {
                $sql->bindValue(':imagem', $imagem);
            }
            $sql->bindValue(':mostrar', $mostrar);
            $sql->bindValue(':ordem', $ordem); 
            $sql->execute();
        } catch(PDOException $e) {
            echo "Erro ao editar este registro! ".$e->getMessage();
        }
    }

    public function excluir($id_banner) {
        try {
            $sql = $this->conexaodb->prepare("DELETE FROM banner_slider WHERE id = :id");
            $sql->bindValue(":id", $id_banner);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível deletar este registro! ".$e->getMessage();
        }
    }

    public function getBanner($id) {
        $resultado = array();
        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM banner_slider WHERE id = :id");
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

    public function getListaBanners($tipo) {
        $resultado = array();

        $sql = "SELECT * FROM banner_slider";
        if(!empty($tipo)) {
            $sql .=" WHERE tipo = :tipo'";
        }
        $sql = $this->conexaodb->prepare($sql);
        if(!empty($tipo)) {
            $sql->bindValue(':tipo', $tipo);
        }
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
    }

}