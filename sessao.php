<?php

    $sessao = $_POST["retorno"];    

    session_start();

    $_SESSION["codigo"] = $sessao;

?>