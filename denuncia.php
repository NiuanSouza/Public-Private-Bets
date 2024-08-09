<?php

    include("conexao.php");

    session_start();

    $cod = $_SESSION["codigo"];

    $sql = "SELECT * FROM usuarios WHERE cod_usuario='$cod' ";

    $resultado2 = $conexao->query($sql);

    $linha = $resultado2->fetch_object();

    echo"

    <script> 

    $(document).ready(function() {

      $(\"#btn_sair\").click(function()
      {
          $.post(\"conteudo.php\",
          {
              escolha: \"Apostas\"
          },
          function(resultado)
          {
              $(\"#conteudo\").html(resultado)
          });
      });
    

    $(\"#btn_enviar\").click(function()
    {
        var content = $(\"#fdescri\").val();

          if(content != \"\")
          {
        
            alert(\"Reclamação enviada com sucesso, aguarde resposta.\");
            
            $.post(\"conteudo.php\",
            {
                escolha: \"Apostas\"
            },
            function(resultado)
            {
                $(\"#conteudo\").html(resultado)
            });
          }
          else
          {
            alert(\"Porfavor preencha o campo de reclamação.\");
          }
    });
  });

  </script>


    <style>

    .inputD
    {
      width: 100%;
      height: 115px;
      padding: 3px ;
      margin: 8px 0;
    }

    #btn_sair
    {
      background-color: red; /* Green */
    }

    #btn_enviar
    {
        float:right;
    }

    h2
    {
      font-size: 27px;   
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
       <h2>Escreva aqui sua reclamação ou denuncia:</h2>
       <textarea type=\"text\" class=\"inputD\" id=\"fdescri\" name=\"fdesc\" ></textarea>
    </div>
       
          <button class=\"button button2 red\" id=\"btn_sair\">Voltar</button>

            <button class=\"button button2\" id=\"btn_enviar\" >Enviar</button>
      </div>
  </div>
</div>";
?>