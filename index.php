<?php 

    session_start();

    if(isset($_SESSION["codigo"]) && $_SESSION["codigo"] != "" )
    {
        $cod = $_SESSION["codigo"];
        include("site.php");
    }
    else
    {
        include("inicio.php");
    }

?>