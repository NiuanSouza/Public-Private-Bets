<?php 
	
    include("conexao.php");

    $novo = $_POST['adicional'];

    session_start();

    $codif = $_SESSION["codigo"];


    $sql = "UPDATE `usuarios` SET `moedas` = '$novo' WHERE cod_usuario='$codif' ";
    
    $conexao->query($sql);
    
?>