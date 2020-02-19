
<?php
class Servico extends Model {

    public function inserir($nome, $imagem_capa, $alt_imagem_capa, $descricao, $slug) {
        
        try {
            $sql = "INSERT INTO servico SET nome = :nome, imagem_capa = :imagem_capa, descricao = :descricao, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, slug = :slug";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":imagem_capa", $imagem_capa);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":slug", $slug);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir este serviço! ".$e->getMessage(); exit;
        }
    }
    
    public function editar($id, $nome, $imagem, $alt_imagem_capa, $descricao, $slug) {
        try {
            $sql = "UPDATE servico SET nome = :nome, descricao = :descricao, ";
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
        } catch(PDOException $e) {
            echo "Não foi possível atualizar este servico! ".$e->getMessage(); exit;
        }
    }

    public function excluir($id_servico) {
        try {
            $sql = $this->conexaodb->prepare("DELETE FROM servico WHERE id = :id");
            $sql->bindValue(":id", $id_servico);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível deletar este registro! ".$e->getMessage();
        }
    }

    public function getServico($id) {
        $resultado = array();
        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM servico WHERE id = :id");
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

    public function getListaServicos() {
        $resultado = array();

        $sql = "SELECT * FROM servico";
        $sql = $this->conexaodb->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
    }
}