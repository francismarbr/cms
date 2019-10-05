<?php
class Cliente extends Model {

    public function getLista($qtd_por_pag) {
        $array = array();

        try {
            $sql = $this->conexaodb->prepare("SELECT * FROM cliente LIMIT :qtd_por_pag, 10");
            $sql->bindValue(':qtd_por_pag', $qtd_por_pag);
            $sql->execute();

            if($sql->rowCount() > 0) {
               $array = $sql->fetchAll(); 
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        return $array;

    }
}