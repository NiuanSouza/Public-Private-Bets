<?php

echo"
<script>

$(document).ready(function(){";

 include("co_trocar.php");
 include("co_login.php");

    echo"         });
    </script>

      <div class=\"lr_content\"> 
      <div id=\"login\">
                    
          <h1 class=\"lr_titulo\" >Login</h1>
          <p class=\"lr_para\" >  
            <label class=\"lr_label\">Seu e-mail</label>
            <input class=\"lr_campo\" id=\"email_login\" type=\"text\" />
          </p>
          
          <p class=\"lr_para\"> 
            <label class=\"lr_label\">Sua senha</label>
            <input class=\"lr_campo\" id=\"senha_login\" type=\"password\" /> 
          </p>
          
          <p class=\"lr_para\"> 
            <input type=\"checkbox\" id=\"manterlogado\"> 
            <label>Manter-me logado</label>
          </p>
          
          <input class=\"lr_input\" type=\"submit\" id=\"btn_login\" />
          
          <p class=\"lr_baixo\">Ainda não tem conta? <input type=\"button\" class=\"btn_ir\" value=\"Cadastre-se\"></p>

      </div>
      </div>
    ";
?>