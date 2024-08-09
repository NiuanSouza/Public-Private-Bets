<?php
    
    session_start();
        
    $tipoDP = $_POST["tipoPesquisa"];    

    $_SESSION['pesquisa'] = $tipoDP; 

?>