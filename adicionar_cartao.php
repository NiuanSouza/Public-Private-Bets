<?php 
	
    include("conexao.php");

    $nome = $_POST['nome'];
    $numero = $_POST['numero'];
    $validade = $_POST['validade'];

    session_start();

    $codi = $_SESSION["codigo"];

    $sql = " INSERT INTO `cartao` (`dono`, `nome_cartao`, `numero`, `vencimento`, `validado`) VALUES ('$codi', '$nome', '$numero', '$validade', 'sim') ";
    
    $conexao->query($sql);

    echo"Cartão cadastrado";

?>