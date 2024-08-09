<?php 
	
    include("conexao.php");

    $cod_jogo = $_POST['cod_jogo'];
    $cod_alternativa = $_POST['cod_alternativa'];

    $sql = "SELECT * FROM `registro_jogos` WHERE `cod_jogo`='$cod_jogo' AND `cod_alternativa`='$cod_alternativa' ";
    
    $resultado = $conexao->query($sql);

    while($linha = $resultado->fetch_object())
    {
        $sql2 = "SELECT * FROM `usuarios` WHERE `cod_usuario`='$linha->cod_usuario' ";

        $resultado2 = $conexao->query($sql2);

        $linha2 = $resultado2->fetch_object();

        $novo = $linha->montantante + $linha2->moedas;

        $sql3 = "UPDATE `usuarios` SET `moedas` = '$novo' WHERE `cod_usuario`='$linha->cod_usuario' ";

        $conexao->query($sql3);

    }    

        $sql4 = "UPDATE `jogos` SET `situacao` = 'Inativo', `inscricao` = 'Inativo' WHERE `cod_jogo`='$cod_jogo' ";
        
        $conexao->query($sql4);

        $sql5 = "UPDATE `alternativa_jogos` SET `situacao` = 'Certa' WHERE `cod_jogo`='$cod_jogo' AND `cod_alternativa`='$cod_alternativa' ";
        
        $conexao->query($sql5);

        echo"Foi";

    
?>