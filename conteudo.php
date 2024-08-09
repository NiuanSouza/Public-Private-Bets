<?php

    $escolha = $_POST["escolha"];    

    if($escolha == "Publicas")
    {
        include("publicas.php");
    }
    else if($escolha == "Privadas")
    {

        include("privadas.php");
    }
    else if($escolha == "P_Coins")
    {
        include("comprar.php");
    }
    else if($escolha == "Apostas")
    {
        include("apostas.php");
    }
    else if($escolha == "Informacoes")
    {
        include("usuario.php");
    }
    else if($escolha == "Cartao")
    {
        include("cartao.php");
    }
    else if($escolha == "Criar")
    {
        include("criar.php");
    }
    else if($escolha == "Denuncia")
    {
        include("denuncia.php");
    }

?>