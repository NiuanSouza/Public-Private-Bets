<?php

    include("conexao.php");

    session_start();

    $cod = $_SESSION["codigo"];

    $sql = "SELECT * FROM usuarios WHERE cod_usuario='$cod' ";

    $resultado2 = $conexao->query($sql);

    $date = date('Y-m-d');

    $linha = $resultado2->fetch_object();

    echo"

    <script> 

    $(document).ready(function() {

      $(\"#fcodigo\").val(Math.floor((Math.random() * 99999999999) + 1));
      
      $(\"#btn_criar\").click(function()
      {
        var v_codigo = $(\"#fcodigo\").val();

        var v_titulo = $(\"#ftitulo\").val();

        var t_titulo = v_titulo.length;
        
        var v_descri = $(\"#fdescri\").val();

        var t_descri = v_descri.length;
        
        var v_fmin = $(\"#fmin\").val();

        var t_fmin = v_fmin.length;
        
        var v_fmax = $(\"#fmax\").val();

        var t_fmax = v_fmax.length;
        
        var v_fdatafinal = $(\"#fdatafinal\").val();

        var v_montante = $(\"#fmon\").val();

        var t_montante = v_montante.length;

        var v_montante_final = $(\"#fmonFinal\").val();
        
        var v_visibilidade = $(\"#fvisibilidade\").find(\":selected\").val();
        
        var v_categoria = $(\"#fclass\").find(\":selected\").val();

        if(t_titulo != 0)
        {
          if(t_descri != 0)
          {
            if(t_fmin != 0 && v_fmin > 1)
            {
              if(t_fmax != 0)
              {
                if(v_fmax >= v_fmin)
                {
                  if(v_fdatafinal != \"\")
                  {
                    if(t_montante != \"\")
                    {
                      if(v_categoria != 0)
                      {
                        if(v_montante_final <= $linha->moedas)
                        {
                          var quantidade_alternativas = $(\".alts\").length;

                          if(quantidade_alternativas == 2)
                          {
                            var v_alter1 = $(\"#falt1\").val();

                            var v_alter2 = $(\"#falt2\").val();

                            if(v_alter1 != \"\" && v_alter2 != \"\")
                            {
                              $.post(\"confirmar_aposta.php\",
                              {
                                cod_jogo: v_codigo, 
                                nome: v_titulo, 
                                descricao: v_descri,
                                us_minimos: v_fmin,
                                us_maximos: v_fmax,
                                dt_final: v_fdatafinal,
                                visibilidade: v_visibilidade,
                                montantante: v_montante ,
                                cod_categoria: v_categoria,
                                custo: v_montante_final
                              
                              },
                              
                              function(resultado)
                              {
                                if(resultado == 'Foi')
                                {
                                  var valores = [v_alter1,v_alter2]

                                  $.post(\"confirmar_alternativas.php\",
                                  {
                                    quantidade: quantidade_alternativas, 
                                    valor: valores, 
                                    cod_jogo: v_codigo
                                  },
                                  
                                  function(resultado2)
                                  {
                                    if(resultado == 'Foi')
                                    {                                      
                                      $.post(\"confirmar_cobranca.php\",
                                      {
                                        cobrado: v_montante_final
                                      },
                                      function(resultado3)
                                      {
                                        if(resultado3 == 'Foi')
                                        {
                                          alert(\"Aposta criada com sucesso\");
                                          location.reload(true);
                                        }
                                      });
                                    }
                                    else
                                    {
                                      alert(\"Algo deu errado ao cadastrar as alternativas\");
                                    }
                                  });
                                }
                                else
                                {
                                  alert(\"Algo deu errado\");
                                }
                              });
                            }
                            else
                            {
                              alert(\"Preencha as alternativas.\");
                            }

                          }
                          else if(quantidade_alternativas == 3)
                          {
                            var v_alter1 = $(\"#falt1\").val();

                            var v_alter2 = $(\"#falt2\").val();

                            var v_alter3 = $(\"#falt2\").val();

                            if(v_alter1 != \"\" && v_alter2 != \"\" && v_alter3 != \"\")
                            {
                              $.post(\"confirmar_aposta.php\",
                              {
                                cod_jogo: v_codigo, 
                                nome: v_titulo, 
                                descricao: v_descri,
                                us_minimos: v_fmin,
                                us_maximos: v_fmax,
                                dt_final: v_fdatafinal,
                                visibilidade: v_visibilidade,
                                montantante: v_montante ,
                                cod_categoria: v_categoria,
                                custo: v_montante_final
                              
                              },
                              
                              function(resultado)
                              {
                                if(resultado == 'Foi')
                                {
                                  var valores = [v_alter1,v_alter2,v_alter3]

                                  $.post(\"confirmar_alternativas.php\",
                                  {
                                    quantidade: quantidade_alternativas, 
                                    valor: valores, 
                                    cod_jogo: v_codigo
                                  },
                                  
                                  function(resultado2)
                                  {
                                    if(resultado == 'Foi')
                                    {                                      
                                      $.post(\"confirmar_cobranca.php\",
                                      {
                                        cobrado: v_montante_final
                                      },
                                      function(resultado3)
                                      {
                                        if(resultado3 == 'Foi')
                                        {
                                          alert(\"Aposta criada com sucesso\");
                                          location.reload(true);
                                        }
                                      });
                                    }
                                    else
                                    {
                                      alert(\"Algo deu errado ao cadastrar as alternativas\");
                                    }
                                    
                                  });
                                }
                                else
                                {
                                  alert(\"Algo deu errado ao cadastrar a aposta\");
                                }
                              });
                            }
                            else
                            {
                              alert(\"Preencha as alternativas.\");
                            }

                          }
                        }
                        else
                        {
                            alert(\"Você não tem P-coins suficientes para iniciar a aposta.\");
                        }
                      }
                      else
                      {
                        alert(\"Selecione uma categoria.\");
                      }
                    }
                    else
                    {
                      alert(\"Digite o montante inicial da aposta.\");
                    }
                  }
                  else
                  {
                    alert(\"Selecione a data de termino da aposta.\");
                  }
                }
                else
                {
                  alert(\"O numero de usuarios maximos é menor que os mínimos.\");
                }
              }
              else
              {
                alert(\"Digite o numero de usuarios maximos da aposta.\");
              }
            }
            else
            {
              alert(\"O numero de usuarios minimos é 2.\");
            }
          }
          else
          {
            alert(\"Digite a descrição da aposta\");
          }
        }
        else
        {
          alert(\"Digite o titulo da aposta\");
        }
        
      });

      $(\"#fclass\").change(function()
      {
        var categoria = $(\"#fclass\").find(\":selected\").val();

      
        if(categoria == 0)
        {
          $(\"#classe\").html(\"\");

          $(\"#Montante\").hide();

        }
        else
        {
          $.post(\"conteudo_categoria.php\",
          {
            escolha: categoria
          },
          function(resultado)
          {
            $(\"#classe\").html(resultado);

            $(\"#Montante\").show();

            var v_montante = parseFloat($(\"#fmon\").val());

            if(categoria == 1)
            {
              var v_final = (v_montante * 1.25).toFixed(0);
            }
            else if(categoria == 2)
            {
              var v_final = (v_montante * 1.35).toFixed(0);
            }

            $(\"#fmonFinal\").val(v_final);

          });  

        }
      
      });

      $(\".fild2\").keyup(function() 
      {
          $(\".fild2\").val(this.value.match(/[0-9]*/));
      });

      $(\".fild\").keyup(function() 
      {
          $(\".fild\").val(this.value.match(/[0-9]*/));
      });

      $(\".fmon\").keyup(function() 
      {
          $(\".fmon\").val(this.value.match(/[0-9]*/));
      });

      $(\".fmon\").keyup(function() 
      {
          var v_montante = parseFloat($(\".fmon\").val());

          var categoria = $(\"#fclass\").find(\":selected\").val();

          if(categoria == 1)
          {
            var v_final = (v_montante * 1.25).toFixed(0);

            $(\"#fmonFinal\").val(v_final);

          }
          else if(categoria == 2)
          {
            var v_final = (v_montante * 1.35).toFixed(0);

            $(\"#fmonFinal\").val(v_final);

          }
      });

    });

  </script>


    <style>
    .inputT{
      width: 400px;
      height: 24px;
      padding: 3px ;
      margin: 8px 0;
    }
    
    .inputC
    {
      width: 100px;
      height: 24px;
      padding: 3px ;
      margin: 8px 0;
    }

    .inputD
    {
      width: 100%;
      height: 115px;
      padding: 3px ;
      margin: 8px 0;
    }

    inputS
    {
      width: 90px;
      height: 24px;
      padding: 3px ;
      margin: 8px 0;
    }

    .inputTN
    {
      width: 43px; 
      height: 24px;
      padding: 2px ;
      margin: 6px 0;
    }

    .inputTM
    {
      width: 100px; 
      height: 24px;
      padding: 2px;
      margin: 6px 0;
    }

    .para
    {
      color: red;   
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
      <h2 for=\"ftitulo\">Código da aposta:</h2>
      <input type=\"text\" class=\"inputC\" id=\"fcodigo\" name=\"fcodigo\" maxlength=\"11\" disabled><br>
   </div>

        <div class=\"products-heading\">
          <h2 for=\"ftitulo\">Titulo da aposta:</h2>
          <input type=\"text\" class=\"inputT\" id=\"ftitulo\" name=\"ftitulo\" maxlength=\"50\"><br>
       </div>

       <div class=\"products-heading\">
       <h2>Descrição:</h2>
       <textarea type=\"text\" class=\"inputD\" id=\"fdescri\" name=\"fdesc\" maxlength=\"500\"></textarea>
    </div>
       
          <div class=\"products-heading\">
              <h2>Usuario minimos:</h2>
              <input type=\"text\" class=\"inputTN fild\" maxlength=\"4\" id=\"fmin\" name=\"fmin\"><br>
          </div>	

          <div class=\"products-heading\">
            <h2>Usuario maximos:</h2>
            <input type=\"text\" class=\"inputTN fild2\" maxlength=\"4\" id=\"fmax\" name=\"fmax\"><br>
          </div>

          <div class=\"products-heading\">
            <h2>Data de finalização da aposta:</h2>
            <input type=\"date\" id=\"fdatafinal\" name=\"fdatafinal\" min=\"$date\"><br>
          </div>

          <div class=\"products-heading\">
            <h2>Visibilidade:</h2>
            <select id=\"fvisibilidade\" class=\"inputS\">
              <option value=\"Publica\">Publica</option>
              <option value=\"Privada\">Privada</option>
            </select>

          </div>

          <div class=\"products-heading\">
            <h2>Montante inicial:</h2>
            <input type=\"text\" class=\"inputTM fmon\" maxlength=\"11\" id=\"fmon\" name=\"fmon\"><br>
            <p class=\"para\">Aviso: 25% da quantidade de P-coins colocados aqui serão o valor de incrição da aposta.</p>
          </div>

          <div class=\"products-heading\">
            <h2>Categoria da aposta:</h2>

            <select id=\"fclass\" class=\"inputS\">
            <option value=\"0\"></option>
            ";
           
                $sqlclass = "SELECT * FROM `categoria` WHERE situacao='Ativo'";

                $resultadoclass = $conexao->query($sqlclass);

                while($linhaclass = $resultadoclass->fetch_object())
                {
                  echo"<option class=\"opition\" value=\"$linhaclass->cod_categoria\">$linhaclass->nome</option>";
                }
            echo"

          </select>
          <p class=\"para\">Aviso: O valor para criar a aposta muda de acordo com a categoria escolhida.</p>

          </div>

          <div id=\"classe\"> </div>

          <div class=\"products-heading\" id=\"Montante\" style=\"display:none;\">
            <h2>Valor para criar aposta:</h2>
            <input type=\"text\" class=\"inputTM\" maxlength=\"11\" id=\"fmonFinal\" name=\"fmonFinal\" disabled><br>
        </div>

            <button class=\"button button2\" id=\"btn_criar\" >Criar aposta</button>
      </div>
  </div>
</div>";
?>