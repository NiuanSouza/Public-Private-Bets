<?php 
	
    include("conexao.php");

    $novo = $_POST['novo'];
    $elemento = $_POST['elemento'];

    session_start();

    $codi = $_SESSION["codigo"];

    if($elemento == "nome")
    {
        $sql = "UPDATE `usuarios` SET `nome` = '$novo' WHERE cod_usuario='$codi' ";
        $conexao->query($sql);

    }

    if($elemento == "nascimento")
    {
      $sql = "UPDATE `usuarios` SET `nascimento` = '$novo' WHERE cod_usuario='$codi' ";
      $conexao->query($sql);
    }

    if($elemento == "apelido")
    {
      $sql = "UPDATE `usuarios` SET `apelido` = '$novo' WHERE cod_usuario='$codi' ";
      $conexao->query($sql);
    }

    if($elemento == "email")
    {
      $sql = "UPDATE `usuarios` SET `email` = '$novo' WHERE cod_usuario='$codi' ";
      $conexao->query($sql);
    }

    if($elemento == "cpf")
    {
      $sql = "UPDATE `usuarios` SET `cpf` = '$novo' WHERE cod_usuario='$codi' ";
      $conexao->query($sql);
    }

    if($elemento == "moedas")
    {
      $sql = "UPDATE `usuarios` SET `moedas` = '$novo' WHERE cod_usuario='$codi' ";
      $conexao->query($sql);
    }


?>