<?php
        
        $tipoES = $_POST["estado"];    

        session_start();

        $_SESSION['estatos'] = $tipoES; 

?>