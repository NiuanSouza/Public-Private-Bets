<?php

    include("conexao.php");

    session_start();

    $cod = $_SESSION["codigo"];

    $sql = "SELECT * FROM usuarios WHERE cod_usuario='$cod' ";

    $resultado2 = $conexao->query($sql);

    $linha = $resultado2->fetch_object();

    echo"

    <script> 

    var cpf = document.querySelector(\"#fCPF\");

    $(document).ready(function(){
     
      if(fCPF.value) fCPF.value = fCPF.value.match(/.{1,3}/g).join(\".\").replace(/\.(?=[^.]*$)/,\"-\");
   });

    cpf.addEventListener(\"blur\", function(){
      var tamanho = (fCPF.value).length;
      if(tamanho == 11)
      {
       if(fCPF.value) fCPF.value = fCPF.value.match(/.{1,3}/g).join(\".\").replace(/\.(?=[^.]*$)/,\"-\");
      }
    });

    $(\"#btn_atualizar\").click(function(){

      var v_nome = $(\"#fname\").val();
      var v_nascimento = $(\"#fnascimento\").val();
      var v_apelido = $(\"#fapelido\").val();
      var v_email = $(\"#femail\").val();
      var v_cpfcomponto = $(\"#fCPF\").val();

      var v_cpf = v_cpfcomponto.replace('.', '');

      var v_cpf = v_cpf.replace('.', '');

      var v_cpf = v_cpf.replace('-', '');

      if(v_nome != \"$linha->nome\")
      {
        $.post(\"editar.php\",{novo: v_nome, elemento: \"nome\"});
      }

      if(v_nascimento != \"$linha->nascimento\")
      {
        $.post(\"editar.php\",{novo: v_nascimento, elemento: \"nascimento\"});
      }

      if(v_apelido != \"$linha->apelido\")
      {
        $.post(\"editar.php\",{novo: v_apelido, elemento: \"apelido\"});
      }
      
      if(v_email != \"$linha->email\")
      {
        $.post(\"editar.php\",{novo: v_email, elemento: \"email\"});
      }

      if(v_cpf != \"$linha->cpf\")
      {
        $.post(\"editar.php\",{novo: v_cpf, elemento: \"cpf\"});
      }

      if(\"$linha->validado\" == \"nao\")
      {
        $.post(\"idade.php\",{data: v_nascimento},
        function(retorno)
        {
          if(retorno >= '18')
          {
            $.post(\"confirCPF.php\",{cpf: v_cpf},
            function(retorno2)
          {
            if(retorno2 == \"truetrue\")
            {
              $.post(\"validar.php\",function(retorno3)
              {                     
                  if(retorno3 == \"recarregar\")
                  {
                    alert(\"Você validou sua conta\");
                    location.reload(true);
                  }
              });
            }
            else
            {
              alert(\"CPF invalido\");
            }
          });

          }
          else
          {
            alert(\"Você não tem idade suficiente para apostar\");
            
          }
        });
      }
    });

  </script>

    <style>
    .inputT{
      height: 24px;
      width: 50%; 
      padding: 3px ;
      margin: 8px 0;
    }

    h2
    {
      font-size: 25px;   
    }

    .button {
      background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      -webkit-transition-duration: 0.4s; /* Safari */
      transition-duration: 0.4s;
      float:right;
    }
    
    .button2:hover {
      box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
    }
    
    </style>
";


  echo "                    
  
  <div class=\"container\">
  <div class=\"row\">
      <div class=\"col-md-9\">
          <div class=\"products-heading\">
              <h2>Nome Completo:</h2>
              <input type=\"text\" class=\"inputT\" id=\"fname\" name=\"fname\" value=\"$linha->nome\">
          </div>

              <div class=\"products-heading\">
              
              <h2 >Nascimento :</h2>

              ";

              if($linha->nascimento == "" || $linha->nascimento == null || $linha->nascimento == "0000-00-00")
              {
                  echo" <input  type=\"date\" id=\"fnascimento\" name=\"fnascimento\">";
              }
              else
              {
                $dataTime = $linha->nascimento;

                $date = substr($dataTime,0,10);

                if($linha->validado == "sim")
                {
                  echo" <input type=\"date\" id=\"fnascimento\" name=\"fnascimento\"value=\"$date\" disabled>";
                }
                else
                {
                  echo" <input type=\"date\" id=\"fnascimento\" name=\"fnascimento\"value=\"$date\">";
                }
              }

              echo"

              </div>
              <div class=\"products-heading\">

              <h2>Apelido :</h2>

              ";

              if($linha->apelido == "" || $linha->apelido == null)
              {
                echo" <input type=\"text\" class=\"inputT\"  id=\"fapelido\" name=\"fapelido\"> ";
              }
              else
              {
              echo" <input type=\"text\" class=\"inputT\"  id=\"fapelido\" name=\"fapelido\" value=\"$linha->apelido\"> ";
              }

              echo"

              </div>

              <div class=\"products-heading\">

              <h2>Email :</h2>
              <input type=\"text\" class=\"inputT\"  id=\"femail\" name=\"femail\"  value=\"$linha->email\">
              </div>	

              <div class=\"products-heading\">
              
              <h2>CPF :</h2>

              ";

              if($linha->cpf == "" || $linha->cpf == null)
              {
                  echo"<input type=\"text\"   id=\"fCPF\" name=\"fCPF\" maxlength=\"11\">";
              }
              else
              {
                if($linha->validado == "sim")
                {
                  echo"<input type=\"text\"   id=\"fCPF\" name=\"fCPF\" maxlength=\"11\" value=\"$linha->cpf\"  disabled/>";
                }
                else
                {
                  echo"<input type=\"text\"   id=\"fCPF\" name=\"fCPF\" maxlength=\"11\" value=\"$linha->cpf\"/>";
                }
              }

              echo"

              </div>	

              <br>
              <br>

              <button class=\"button button2\" id=\"btn_atualizar\" >Atualizar</button>

      </div>
  </div>
</div>";
?>