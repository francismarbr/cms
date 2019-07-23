<?php
class Permissao extends Model {

    private $grupo;
    private $permissoes;

    public function setGrupo($id, $id_empresa) {
        $this->grupo = $id;
        $this->permissoes = array();

        $sql = $this->conexaodb->prepare("SELECT permissoes FROM grupo_permissao WHERE id = :id AND empresa_id :id_empresa ");
        $sql->bindValue(':id_empresa', $id_empresa);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount > 0) {
            $resultado = $sql->fetch();

            if(empty($resultado['permissoes'])) {
                $resultado['permissoes'] ='0';
            }
            
            $permissoes = $resultado['permissoes'];

            $sql = $this->conexaodb->prepare("SELECT nome FROM permissao WHERE id IN ($permissoes)");
            $sql->execute();

            if($sql->rowCount() > 0) {
               foreach($sql->fetchAll() as $item) {
                   $this->permissoes[] = $item['nome';]
               }
            }
        }

    }

    public function temPermissao($nome) {
        if(in_array($nome, $this->permissoes)) {
            return true;
        } else {
            return false;
        }
    }

}