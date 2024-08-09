<?php 
	
    include("conexao.php");

    $cod_jogo = $_POST['cod_jogo'];
    $quantidade = $_POST['quantidade'];;

    for($i = 0 ; $i < $quantidade; $i++) 
    {
        $valor =  $_POST['valor'][$i];

        $sql = "INSERT INTO `alternativa_jogos` (`cod_alternativa`, `alternativa`, `cod_jogo`) 
                                         VALUES (NULL, '$valor', '$cod_jogo');";
        $conexao->query($sql);

    }

    echo"Foi";

?>