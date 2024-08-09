<?php

    include("conexao.php");

    session_start();

    $cod = $_SESSION["codigo"];

    $sql = "SELECT * FROM usuarios WHERE cod_usuario='$cod' ";

    $resultado2 = $conexao->query($sql);

    $linha = $resultado2->fetch_object();

    echo"

    <script> 

    $(\"#btn_sair\").click(function()
    {
      $.post(\"conteudo.php\",
      {
          escolha: \"P_Coins\"
      },
      function(resultado)
      {
          $(\"#conteudo\").html(resultado)
      });
    });

    $(\"#fnumber\").keyup(function() 
    {
      $(\"#fnumber\").val(this.value.match(/[0-9]*/));
    });

    $(\"#fvalidade\").keyup(function() 
    {
      $(\"#fvalidade\").val(this.value.match(/[0-9]*/));
    });

    $(\"#fvalidade\").keyup(function() 
    {
      var verificar = $(\"#fvalidade\").val();

      var t_verificar = verificar.length;

      if(t_verificar >= 2)
      {
        var primeiros = verificar.substr(-20, 2);
        
        if(primeiros <= 0 || primeiros > 12)
        {
          $(\"#fvalidade\").val(\"\");
        }
      }
    });
   
    $(\"#fvalidade\").blur(function()
    {
      var string = $(\"#fvalidade\").val();

      var tamanho = string.length;

      if(tamanho == 4)
      {
        var final  =  string.substring(0,2) + '/'  + string.substring(2);
      
        $(\"#fvalidade\").val(final);
      }

    });

    $(\"#fvalidade\").click(function()
    {
      var string = $(\"#fvalidade\").val();

      var tamanho = string.length;

      if(tamanho == 5)
      {
        var final = string.replace('/', '');

        $(\"#fvalidade\").val(final);
      }
    });



    $(\"#btn_adicionar\").click(function(){

      var v_nome = $(\"#fnomeC\").val();

      var t_nome = v_nome.length;

      var v_numero = $(\"#fnumber\").val();

      var t_numero = v_numero.length;

      var v_valido = $(\"#fvalidade\").val();

      var v_validade = v_valido.replace('/', '');

      var t_validade = v_validade.length;

      if(t_nome != 0)
      {
        if(t_numero == 16)
        {
          if(t_validade == 4)
          {
            $.post(\"adicionar_cartao.php\",
            {
              nome: v_nome, 
              numero: v_numero, 
              validade: v_validade
            },

            function(resultado)
            {
              alert(resultado);
            });

            $.post(\"conteudo.php\",
            {
              escolha: \"P_Coins\"
            },
            function(resultado)
            {
              $(\"#conteudo\").html(resultado);
            });
          }
          else
          {
            alert(\"Digite a validade do cartão corretamente\");
          }
        }
        else
        {
          alert(\"Digite o numero do cartão corretamente\");
        }
      }
      else
      {
        alert(\"Digite o nome do dono do cartão corretamente\");
      }

    });

  </script>


    <style>
    .inputT
    {
      width: 50%; 
      height: 24px;
      padding: 3px ;
      margin: 8px 0;
    }

    #fnumber
    {
      width: 140px; 
      height: 24px;
      padding: 3px ;
      margin: 8px 0;
    }

    #fvalidade
    {
      width: 60px; 
      height: 24px;
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
    }

    .red 
    {
      background-color: red; /* Green */
    }

    #btn_adicionar
    {
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
          <h2>Nome no cartão:</h2>
          <input type=\"text\" class=\"inputT\" id=\"fnomeC\" name=\"fnomeC\"><br><br>
       </div>
       
          <div class=\"products-heading\">
              <h2>Numero do cartão:</h2>
              <input type=\"text\" class=\"inputT\" maxlength=\"16\" id=\"fnumber\" name=\"fnumber\"><br><br>
          </div>	

          <div class=\"products-heading\">
          <h2>Data de validade:</h2>
          <input type=\"text\" placeholder=\"MM/YY\" class=\"inputT\" id=\"fvalidade\" maxlength=\"4\" name=\"fvalidade\"><br><br>
      </div>

              <br>
              <br>

              <button class=\"button button2 red\" id=\"btn_sair\">Voltar</button>

              <button class=\"button button2\" id=\"btn_adicionar\" >Adicionar</button>

      </div>
  </div>
</div>";
?>