<?php

    $cod_jogo = $_POST["cod_jogo"]; 
        
    include("conexao.php");

    error_reporting(0);


    session_start();


    $cod = $_SESSION["codigo"];

    $sqlmoeda = "SELECT moedas FROM `usuarios` WHERE cod_usuario='$cod';";
    $resultadomoeda = $conexao->query($sqlmoeda);
    $linhamoeda = $resultadomoeda->fetch_object();

    $sql = "SELECT * FROM jogos WHERE cod_jogo='$cod_jogo'";

    $resultado = $conexao->query($sql);

    $linha = $resultado->fetch_object();

    echo"
        <style>

        .inputT
        {
            width: 400px;
            height: 24px;
            padding: 3px ;
            margin: 8px 0;
        }

        h2
        {
            font-size: 25px;   
        }

        .button 
        {
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

        .red 
        {
            background-color: red;
        }

        #btn_participar
        {
            float:right;
        }

        #btn_terminar
        {
            float:right;
        }

        #btn_denunciar
        {
            float:right;
        }

        #alters
        {
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: justify;
            text-decoration: none;
        }


        </style>

    ";


  echo "  

  <div id=\"informacoes\">

    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-9\">

            <div class=\"products-heading\">
              <h2 id=\"$linha->cod_jogo\">Código do jogo: $linha->cod_jogo</h2>
            </div>	

            <div class=\"products-heading\">
              <h2>Titilo da aposta: $linha->nome</h2>
            </div>

            <div class=\"products-heading\">
                <h2>Usuario minimos: $linha->us_minimos</h2>
            </div>

            <div class=\"products-heading\">
                <h2>Usuario atuais: $linha->us_atuais/$linha->us_maximos</h2>
            </div>

            <div class=\"products-heading\">
                <h2>Estado da inscrição: $linha->inscricao</h2>
            </div>

            <div class=\"products-heading\">
                <h2>Data de criação da aposta: </h2>
                <input type=\"date\" value=\"$linha->dt_cricao\" disabled>
            </div>

            <div class=\"products-heading\">
                <h2>Data de termino da aposta: </h2>
                <input type=\"date\" value=\"$linha->dt_final\" disabled>
            </div>


            ";

            $sql3= "SELECT nome FROM `categoria` WHERE cod_categoria='$linha->cod_categoria'";
            $resultado3 = $conexao->query($sql3);
            $linha3 = $resultado3->fetch_object();

            echo"
            <div class=\"products-heading\">
                <h2>Categoria do jogo: $linha3->nome</h2>
            </div>
            ";
            
            $sql2= "SELECT nome, apelido FROM `usuarios` WHERE cod_usuario='$linha->criador';";
            $resultado2 = $conexao->query($sql2);
            $linha2 = $resultado2->fetch_object();

            if($linha2->apelido == "" || $linha2->apelido == null)
            {
                
                echo"
                <div class=\"products-heading\">
                <h2>Nome do criador: $linha2->nome </h2>";
            }
            else
            {
                echo"
                <div class=\"products-heading\">
                <h2>Nome do criador: $linha2->apelido </h2>";
            }

            $preco = $linha->montantante / 4;

            $ganho = ($linha->montantante / 4 ) + ($linha->custo / 20);

            echo"

            <div class=\"products-heading\">
                <h2 id=\"$preco\">Valor de participação da aposta: $preco</h2>
            </div>

            <div class=\"products-heading\">
                <h2 id=\"$ganho\">Valor recebido ao ganhar: $ganho</h2>
            </div>

            <div class=\"products-heading\">
                <h2>Alternativas:</h2>
            </div>
            ";

            $sql5= "SELECT * FROM `alternativa_jogos` WHERE cod_jogo='$linha->cod_jogo';";
            $resultado5 = $conexao->query($sql5);

            $sql6= "SELECT * FROM `registro_jogos` WHERE `cod_usuario`='$cod' AND `cod_jogo`='$linha->cod_jogo' ";
            $resultado6 = $conexao->query($sql6);
            $linha6 = $resultado6->fetch_object();

            if($linha->situacao == "Ativo")
            {
                if($cod == $linha->criador)
                {

                    echo"  
                    <div id=\"alternativas\">
                        <div class=\"container\">
                            <div class=\"row\">
                                <div class=\"col-md-9\">";

                    if($linha->dt_final == date('Y-m-d'))
                    {
                        echo"    
                        <fieldset>
        
                        ";
        
                        while($linha5 = $resultado5->fetch_object())
                        {
                            echo"
                            <input type=\"radio\" value=\"$linha5->cod_alternativa\" class=\"codigo_alternativa\" id=\"$linha5->cod_alternativa\" name=\"codigo_alternativa\">
                            <label for=\"$linha5->cod_alternativa\">$linha5->alternativa</label> <br>
                            ";
                        }
        
                        echo"

                        </fieldset> 
                        
                        </div></div></div>
                        
                        ";

                        if($linha->us_atuais < $linha->us_minimos)
                        {
                            echo"
                                <div class=\"products-heading\">
                                <h2>Não foi atingindo a quantida de jogadores minimos para realizar a aposta: </h2>                           </div>

                                <button class=\"button button2 red\" id=\"btn_sair\">Voltar</button>
                                </div>

                            ";
                        }
                        else
                        {
                            echo"

                            <button class=\"button button2 red\" id=\"btn_sair\">Voltar</button>
                            <button class=\"button button2\" id=\"btn_terminar\">Terminar aposta</button>
                            </div>
                            ";
                        }
                        


                    }
                    else
                    {
                        while($linha5 = $resultado5->fetch_object())
                        {   
                            echo"
                            <div class=\"products-heading\">
                                <h2 id=\"$linha5->cod_alternativa\" >$linha5->alternativa</h2>
                            </div>	
                            ";
                        }

                        echo"
                                <button class=\"button button2 red\" id=\"btn_sair\">Voltar</button>
                        ";
                    }

                    echo"
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                }
                else if($linha6->cod_registro != null )
                {
                    while($linha5 = $resultado5->fetch_object())
                    {   
                        echo"

                        <div class=\"products-heading\">
                            <h2 id=\"$linha5->cod_alternativa\" >$linha5->alternativa</h2>
                        </div>	
                        ";
                    }

                    echo"
                        <button class=\"button button2 red\" id=\"btn_sair\">Voltar</button>
                    </div>
                    </div>
                    </div>
                    </div>
                
                    ";
                }
                else
                {
                    echo"    
                    <fieldset>

                    <div id=\"alters\">

                    ";

                        while($linha5 = $resultado5->fetch_object())
                        {
                            echo"
                            <input type=\"radio\" value=\"$linha5->cod_alternativa\" class=\"codigo_alternativa\" id=\"$linha5->cod_alternativa\" name=\"codigo_alternativa\">
                            <label for=\"$linha5->cod_alternativa\">$linha5->alternativa</label>
                            <br>  ";
                        }

                    echo"
                        </div>
                    </fieldset>

                    <br>
                    </div>                    <button class=\"button button2 red\" id=\"btn_sair\">Voltar</button>

                    <button class=\"button button2\" id=\"btn_participar\">Participar da aposta</button>
    
                    </div>
                    <br>


                    

                    ";

                }
            }
            else
            {
                if($cod == $linha->criador)
                {
                    echo"
                        <div id=\"alternativas\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col-md-9\">";

                    while($linha5 = $resultado5->fetch_object())
                    {   
                        echo"

                        <div class=\"products-heading\">
                            <h2 id=\"$linha5->cod_alternativa\" >$linha5->alternativa</h2>
                        </div>	
                        ";
                    }

                    $sql9= "SELECT * FROM `alternativa_jogos` WHERE cod_jogo='$linha->cod_jogo' AND situacao='Certa'";
                    $resultado9 = $conexao->query($sql9);

                    $linha9 = $resultado9->fetch_object();

                    echo"
                    </div>
                    </div>
                    </div>
                    </div>

                    <div class=\"products-heading\">
                    <h2>Aposta finalizada:</h2>
                    <br>
                    <br>
                    <h2>Alternativa correta:   $linha9->alternativa </h2>
                    </div>	
                    <br>
                        <button class=\"button button2 red\" id=\"btn_sair\">Voltar</button>
                        <button class=\"button button2 red\" id=\"btn_denunciar\">Reportar Erro</button>
                        
                    ";
                }
                else
                {

                    echo"
                    <div id=\"alternativas\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-md-9\">";

                while($linha5 = $resultado5->fetch_object())
                {   
                    echo"

                    <div class=\"products-heading\">
                        <h2 id=\"$linha5->cod_alternativa\" >$linha5->alternativa</h2>
                    </div>	
                    ";
                }

                $sql8= "SELECT * FROM `alternativa_jogos` WHERE cod_jogo='$linha->cod_jogo' AND situacao='Certa'";
                $resultado8 = $conexao->query($sql8);

                $linha8 = $resultado8->fetch_object();

                echo"
                </div>
                </div>
                </div>
                </div>

                <div class=\"products-heading\">
                <h2>Aposta finalizada </h2>
                <br>
                </div>	
                <div class=\"products-heading\">

                <h2>Alternativa correta:   $linha8->alternativa </h2>
                </div>	

                <div class=\"products-heading\">

                ";

                
                $sql10= "SELECT * FROM `registro_jogos` WHERE cod_usuario='$cod' ";
                $resultado10 = $conexao->query($sql10);

                $linha10 = $resultado10->fetch_object();

                if($linha10->cod_alternativa == $linha8->cod_alternativa )
                {
                    echo"<h2>Alternativa escolhida:   $linha8->alternativa - Parabens você vence ganhou </h2>";
                }
                else
                {
                    $sql11= "SELECT * FROM `alternativa_jogos` WHERE cod_jogo='$linha->cod_jogo' AND cod_alternativa='$linha10->cod_alternativa'";
                    $resultado11 = $conexao->query($sql11);
    
                    $linha11 = $resultado11->fetch_object();

                    echo"<h2>Alternativa escolhida:   $linha11->alternativa - Você perdeu o jogo </h2>";
                }

                echo"
                </div>	
                <br>
                    <button class=\"button button2 red\" id=\"btn_sair\">Voltar</button>
                    <button class=\"button button2 red\" id=\"btn_denunciar\">Denunciar</button>
                    
                ";
                }
            }

            echo"

            </div>



        </div>
      </div>
    </div>
  </div>

  
";

echo"

<script> 

$(\"#btn_sair\").click(function()
{
    $.post(\"conteudo.php\",
    {
        escolha: \"Privadas\"
    },
    function(resultado)
    {
        $(\"#conteudo\").html(resultado)
    });
});

$(\"#btn_denunciar\").click(function()
{
    $.post(\"conteudo.php\",
    {
        escolha: \"Denuncia\"
    },
    function(resultado)
    {
        $(\"#conteudo\").html(resultado)
    });
});

$(\"#btn_participar\").click(function()
{
    var ganho = \"$ganho\";

    var cod_jogo = \"$cod_jogo\";

    var preco = parseInt(\"$preco\");

    var moedas = parseInt(\"$linhamoeda->moedas\");

    var alternativa = $(\"input[name='codigo_alternativa']:checked\").val();
    
    if(moedas > preco || moedas == preco)
    {
        if(alternativa != \"\" && alternativa != null)
        {
            $.post(\"confirmar_registro.php\",
            {
                cod_jogo: cod_jogo,
                cod_alternativa: alternativa,
                montantante: ganho
            },
            function(resultado)
            {
                if(resultado == 'Foi')
                {                                      
                    $.post(\"confirmar_cobranca.php\",
                    {
                        cobrado: preco
                    },
                    function(resultado2)
                    {
                        if(resultado2 == 'Foi')
                        {
                            alert(\"Inscrição concluida com sucesso.\");
                            location.reload(true);
                        }
                    });
                }
            });
        }
        else
        {
            alert(\"Porfavor selecione uma alternativa.\");
        }
    }
    else
    {
        alert(\"Você não tem P-coins o suficiente para participar da aposta.\");
    }
});


$(\"#btn_terminar\").click(function()
{
    var alternativa = $(\"input[name='codigo_alternativa']:checked\").val();

    var cod_jogo = \"$cod_jogo\";

    if(alternativa != \"\" && alternativa != null)
    {
        $.post(\"confirmar_finalizacao.php\",
        {
            cod_jogo: cod_jogo,
            cod_alternativa: alternativa        
        },
        function(resultado)
        {
            if(resultado == 'Foi')
            {                                      
                alert(\"Aposta terminada com sucesso.\");
                location.reload(true);                
            }
        });
    }
    else
    {
        alert(\"Porfavor selecione uma alternativa.\");
    }

});

</script>
";




?>