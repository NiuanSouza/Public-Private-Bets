<?php 
	
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if($email == "" || $email == null)
    {
        echo"O campo email deve ser preenchido";
    }
    else
    {
        if($senha == "" || $senha == null)
        {
            echo"O campo senha deve ser preenchido";
        }
        else
        {
            include("conexao.php");

            $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";

            $resultado = $conexao->query($sql);

            $linha = $resultado->fetch_object();

            error_reporting(0);
            
            if($linha->email == $email)
            {
                    session_start();

                    $_SESSION["codigo"] = $linha->cod_usuario;
                    
                    echo"recarregar";
            }
            else
            {
                echo"Sua conta não foi encontrada";
            }	
                
        }
    }

?>