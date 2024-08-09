<?php 
	
    include("conexao.php");

    session_start();

    $codif = $_SESSION["codigo"];
    $cod_jogo = $_POST['cod_jogo'];
    $cod_alternativa = $_POST['cod_alternativa'];
    $montantante = $_POST['montantante'];

    $sql = "INSERT INTO `registro_jogos` (`cod_usuario`, `cod_jogo`, `cod_alternativa`, `montantante`) 
                                  VALUES ('$codif', '$cod_jogo', '$cod_alternativa', '$montantante');";
    
    if($conexao->query($sql) == true)
    {
        $sql2 = "SELECT * FROM `jogos` WHERE `cod_jogo`='$cod_jogo'";
        
        $resultado = $conexao->query($sql2);

        $linha = $resultado->fetch_object();
        
        $antigo = $linha->us_atuais;

        $novo = $antigo + 1;

        $sql3 = "UPDATE `jogos` SET `us_atuais` = '$novo' WHERE `cod_jogo`='$cod_jogo' ";
        
        $conexao->query($sql3);

        $sql4 = "SELECT `us_atuais`,`us_maximos` FROM `jogos` WHERE `cod_jogo`='$cod_jogo' ";

        $resultado2 = $conexao->query($sql4);

        $linha2 = $resultado2->fetch_object();

        if($linha2->us_atuais == $linha2->us_atuais)
        {
            $sql5 = "UPDATE `jogos` SET `inscricao` = 'Inativo' WHERE `cod_jogo`='$cod_jogo' ";
        }

        echo"Foi";
        
    }
    else
    {
        echo"Não foi";
    }
    
?>