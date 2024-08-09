<?php        
        session_start();

        if(isset($_POST["estado"]))
        {
                $estado = $_POST["estado"];    
                $_SESSION['estado_cartao'] = $estado; 
        }

        if(isset($_POST["card"]))
        {
                $nu_card = $_POST["card"];    
                $_SESSION['number_cartao'] = $nu_card; 
        }

?>