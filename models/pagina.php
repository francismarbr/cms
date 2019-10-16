<?php
class Pagina extends Model {

   
    public function inserir($titulo, $data, $imagem, $conteudo, $autor, $tags, $palavra_chave, $alt_imagem_capa, $descricao, $url, $views, $tipo) {
        try {
            $sql = "INSERT INTO pagina SET titulo = :titulo, data = :data, imagem = :imagem, conteudo = :conteudo, autor = :autor, tags = :tags, ";
            $sql .= "palavra_chave = :palavra_chave, alt_imagem_capa = :alt_imagem_capa, descricao = :descricao, url = :url, views = :views, tipo = :tipo";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":titulo", $titulo);
            $sql->bindValue(":data", $data);
            $sql->bindValue(":imagem", $imagem);
            $sql->bindValue(":conteudo", $conteudo);
            $sql->bindValue(":autor", $autor);
            $sql->bindValue(":tags", $tags);
            $sql->bindValue(":palavra_chave", $palavra_chave);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":url", $url);
            $sql->bindValue(":views", $views);
            $sql->bindValue(":tipo", $tipo);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível inserir página! ".$e->getMessage(); exit;
        }
    }

    public function editar($id, $titulo, $data, $imagem, $conteudo, $autor, $tags, $palavra_chave, $alt_imagem_capa, $descricao, $url, $views, $tipo) {
        try {
            $sql = "INSERT INTO pagina SET titulo = :titulo, data = :data, imagem = :imagem, conteudo = :conteudo, autor = :autor, tags = :tags, ";
            $sql .= "palavra_chave = :palavra_chave, alt_imagem_capa = :alt_imagem_capa, descricao = :descricao, url = :url, views = :views, tipo = :tipo ";
            $sql .= "WHERE id = :id";
            $sql = $this->conexaodb->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":titulo", $titulo);
            $sql->bindValue(":data", $data);
            $sql->bindValue(":imagem", $imagem);
            $sql->bindValue(":conteudo", $conteudo);
            $sql->bindValue(":autor", $autor);
            $sql->bindValue(":tags", $tags);
            $sql->bindValue(":palavra_chave", $palavra_chave);
            $sql->bindValue(":alt_imagem_capa", $alt_imagem_capa);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":url", $url);
            $sql->bindValue(":views", $views);
            $sql->bindValue(":tipo", $tipo);
            $sql->execute();
        } catch(PDOException $e) {
            echo "Não foi possível atualizar esta página! ".$e->getMessage();
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

        $sql = $this->conexaodb->prepare('SELECT * FROM pagina WHERE tipo = :tipo');
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultado = $sql->fetchAll();
        }

        return $resultado;
    }

}