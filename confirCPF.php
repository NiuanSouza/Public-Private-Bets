<?php

 $cpf = $_POST['cpf'];
  
    if(strlen($cpf) != 11) 
    {
        echo"false";
    }
    elseif(preg_match('/(\d)\1{10}/', $cpf)) 
    {
        echo"false";
    }
    else
    {
        for ($t = 9; $t < 11; $t++) 
        {
            for ($d = 0, $c = 0; $c < $t; $c++) 
            {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) 
            {
                echo" false";
            }
            else
            {
                echo "true";
            }
        }
    }

?>