<?php
class Pagina extends Model {

   
    public function inserir($titulo, $data, $imagem, $conteudo, $alt_imagem_capa, $descricao, $slug, $views, $tipo, $id_categoria) {
        try {
            $sql = "INSERT INTO pagina SET titulo = :titulo, data = :data, imagem = :imagem, conteudo = :conteudo, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, descricao = :descricao, slug = :slug, views = :views, tipo = :tipo, id_categoria = :id_categoria";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":titulo", $titulo);
            $sql->bindValue(":data", $data);
            $sql->bindValue(":imagem", $imagem);
            $sql->bindValue(":conteudo", $conteudo);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":slug", $slug);
            $sql->bindValue(":views", $views);
            $sql->bindValue(":tipo", $tipo);
            $sql->bindValue(":id_categoria", $id_categoria);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir página! ".$e->getMessage(); exit;
        }
    }
            
    public function editar($id, $titulo, $imagem, $conteudo, $alt_imagem_capa, $descricao, $slug, $tipo, $id_categoria) {
        try {
            $sql = "UPDATE pagina SET titulo = :titulo, conteudo = :conteudo, ";
            $sql .= "alt_imagem_capa = :alt_imagem_capa, descricao = :descricao, slug = :slug, tipo = :tipo, id_categoria = :id_categoria";
            if(!empty($imagem)) {
                $sql .= ", imagem = :imagem";
            }
            $sql .= " WHERE id = :id";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":titulo", $titulo);
            if(!empty($imagem)) {
                $sql->bindValue(":imagem", $imagem);
            }
            $sql->bindValue(":conteudo", $conteudo);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":slug", $slug);
            $sql->bindValue(":tipo", $tipo);
            $sql->bindValue(":id_categoria", $id_categoria);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível atualizar esta página! ".$e->getMessage(); exit;
        }
    }

    public function excluir($id_pagina) {
        try {
            $sql = $this->conexaodb->prepare("DELETE FROM pagina WHERE id = :id");
            $sql->bindValue(":id", $id_pagina);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível deletar este registro! ".$e->getMessage();
        }
    }

    public function getPagina($id) {
        $resultado = array();
        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM pagina WHERE id = :id");
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

    public function getListaPaginas($tipo) {
        $resultado = array();

        $sql = "SELECT * FROM pagina";
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