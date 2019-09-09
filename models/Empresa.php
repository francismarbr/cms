<?php
class Empresa extends Model {

    private $infoEmpresa;

    public function __construct($id) {
        parent::__construct(); //roda o construtor da classe model
       
        $sql = $this->conexaodb->prepare("SELECT * FROM empresa WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $this->infoEmpresa = $sql->fetch();
        }
    }

    public function getNome() {
        if(isset($this->infoEmpresa['nome_fantasia'])) {
            return $this->infoEmpresa['nome_fantasia'];
        } else {
            return '';
        }
    }
}