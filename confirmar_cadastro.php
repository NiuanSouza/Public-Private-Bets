<?php

ini_set('display_errors', '0');

$email = $_POST['email'];
$nome = $_POST ["nome"];
$senha = $_POST ["senha"];


  if($nome == "" || $nome == null)
  {
    echo"O campo nome deve ser preenchido";
  }
  else if($email == "" || $email == null)
  {
    echo"O campo email deve ser preenchido";
  }
  else if($senha == "" || $senha == null)
  {
    echo"O campo senha deve ser preenchido";
  }
  else
  {
      include("conexao.php");

      $sql = "SELECT * FROM usuarios WHERE email='$email'";
    
      $resultado = $conexao->query($sql);

      $linha = $resultado->fetch_object();
  		  
      if($linha->email == $email)
      {
          echo"Esse email já foi cadastrado";
      }
        else
      {
        $sql2 = " INSERT INTO `usuarios`(`nome`, `senha`, `email`, `moedas`,`validado`) VALUES ('$nome','$senha','$email',0,'nao');";
            
        if($conexao->query($sql2) === TRUE) 
        {
          echo "Ok";
        }        
        else 
        {
          echo "Erro ao cadastrar";
        }      
      }
  }
?>
