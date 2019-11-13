<?php
class FormataNome {

    function nome_amigavel($nome) {
        $nome = strtolower($nome);
        $nome = preg_replace("[áàâãª]","a",$nome);
        $nome = preg_replace("[éèê]","e",$nome);
        $nome = preg_replace("[íìî]","i",$nome);
        $nome = preg_replace("[éèê]","e",$nome);
        $nome = preg_replace("[óòôõº]","o",$nome);
        $nome = preg_replace("[úùû]","u",$nome);
        $nome = str_replace("ç","c",$nome);
        $nome = preg_replace("/[^a-z0-9_\s-]/", "", $nome); // Exclui caracteres especiais
        $nome = preg_replace("/[\s-]+/", " ", $nome); // Exclui hífens repetidos em sequência ou espaços
        $nome = preg_replace("/[\s_]/", "-", $nome); // Transforma espaços e underlines em hífens

        return $nome;
    }
}