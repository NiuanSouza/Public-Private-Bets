<?php 
	
    include("conexao.php");

    session_start();

    $codif = $_SESSION["codigo"];
    $cobrado = $_POST['cobrado'];

    $sql = "SELECT `moedas` FROM `usuarios` WHERE `cod_usuario`='$codif' ";

    $resultado = $conexao->query($sql);

    $linha = $resultado->fetch_object();
        
    $antigo = $linha->moedas;

    $novo = $antigo - $cobrado;

    $sql2 = "UPDATE `usuarios` SET `moedas` = '$novo' WHERE `cod_usuario`='$codif' ";
        
    if($conexao->query($sql2) == true)
    {
        echo"Foi";
    }
    else
    {
        echo"Não foi";
    }      
    
?>