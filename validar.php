<?php 
	    
    include("conexao.php");

    session_start();

    $codi = $_SESSION["codigo"];

    $sql = "UPDATE `usuarios` SET `validado` = 'sim' WHERE cod_usuario='$codi' ";
    $conexao->query($sql);

    echo"recarregar";
?>