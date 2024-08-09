<?php 
	
    include("conexao.php");

    $cod_jogo = $_POST['cod_jogo'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $us_minimos = $_POST['us_minimos'];
    $us_maximos = $_POST['us_maximos'];
    $dt_final = $_POST['dt_final'];
    $visibilidade = $_POST['visibilidade'];
    $montantante = $_POST['montantante'];
    $cod_categoria = $_POST['cod_categoria'];
    $custo = $_POST['custo'];

    session_start();

    $codif = $_SESSION["codigo"];

    $sql = "INSERT INTO `jogos` (`custo`, `dt_cricao`, `dt_final`, `us_minimos`, `us_maximos`, `us_atuais`, `inscricao`, `cod_categoria`, `cod_jogo`, `nome`, `descricao`, `criador`, `situacao`, `visibilidade`, `montantante`) 
                         VALUES ('$custo', current_timestamp(), '$dt_final','$us_maximos', '$us_maximos', '0', 'Ativo', '$cod_categoria', '$cod_jogo', '$nome', '$descricao', '$codif', 'Ativo','$visibilidade', '$montantante')";

    
    if($conexao->query($sql) == true)
    {
        echo"Foi";
    }
    
?>