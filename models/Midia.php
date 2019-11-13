<?php
class Midia extends Model {

    public function inserir($arquivos) {
        $pasta_upload = "uploads";
        $arquivos_permitidos = array(
            'image/jpeg',
            'image/jpg',
            'image/png'
        );

        $formataNome = new FormataNome();

        for($qtd=0; $qtd < count($arquivos['name']); $qtd++) {
            
            $tipo = $arquivos['type'][$qtd];

            if(in_array($tipo, $arquivos_permitidos)) {
                $nome_original = explode(".", $arquivos['name'][$qtd]);
                $tipo = explode('/', $tipo);
                $novo_nome = rand(0,999).time()."_".$formataNome->nome_amigavel($nome_original[0]).".".$tipo[1];

                move_uploaded_file($arquivos['tmp_name'][$qtd], $pasta_upload.'/'.$novo_nome);
                $slug = $novo_nome;
                
                try {
                    $sql = $this->conexaodb->prepare("INSERT INTO midia SET nome = :nome, slug = :slug");       
                   
                    $sql->bindValue(":nome", $novo_nome);
                    $sql->bindValue(":slug", $slug);
    
                    $sql->execute();              
                } catch(PDOException $e) {
                    echo "Erro ao inserir arquivo de mídia! ".$e->getMessage(); exit;
                }

            }
        }

    }
}