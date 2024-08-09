<?php

    echo"
        <script>

        $(document).ready(function(){";

        include("co_trocar.php");
        include("co_cadastro.php");

    echo" });
          </script>
          <div class=\"lr_content\"> 
          <div id=\"cadastro\">

              <h1  class=\"lr_titulo\" >Cadastro</h1>            
              <p class=\"lr_para\"> 
                <label >Seu nome</label>
                <input class=\"lr_campo\" id=\"nome_cad\" type=\"text\"/>
              </p>
                        
              <p class=\"lr_para\"> 
                <label class=\"lr_label\">Seu e-mail</label>
                <input class=\"lr_campo\" id=\"email_cad\" type=\"email\"/> 
              </p>
                        
              <p class=\"lr_para\"> 
                <label class=\"lr_label\">Sua senha</label>
                <input class=\"lr_campo\" id=\"senha_cad\" type=\"password\"/>
              </p>
                        
              <p class=\"lr_para\"> 
                <input type=\"submit\" class=\"lr_input\" id=\"btn_cadastro\"/> 
              </p>
                        
              <p class=\"lr_baixo\">Já tem conta?<input type=\"button\" class=\"btn_ir\" value=\"Logue-se\"></p>

          </div>
          </div>
    ";

?>