<?php 
	
    include("pesquisa.php");

    include("conexao.php");

$cod = $_SESSION["codigo"];

$sqly = "SELECT * FROM usuarios WHERE cod_usuario='$cod' ";

$resultado4 = $conexao->query($sqly);

error_reporting(0);


$linhar = $resultado4->fetch_object();

if($linhar->validado == "sim")
{
    echo"
    
    <script> 

    $(\".ver_mais\").click(function()
    {
        var codigo = $(this).attr(\"id\");

        $.post(\"visualizar_aposta.php\",
        {
          cod_jogo: codigo
        },
        function(resultado)
        {
          $(\"#conteudo\").html(resultado);
        });
    });

    </script>
  ";
}
else
{
    echo"
    
    <script> 

  $(\".ver_mais\").click(function()
  {
    alert(\"Valide sua conta para visualizar as apostas.\");
  });

  </script>";
}

    error_reporting(0);

    
    if(isset($_POST["filtro"]) && $_POST["filtro"] != "")
    {

        $codigo_jogo = $_POST["filtro"];

        echo"
         
        <link rel=\"stylesheet\" href=\"css/tsyle.css\"> 

        <form class=\"search-container\">
        <input type=\"text\" id=\"search-bar\" placeholder=\"Busca\" value=\"$codigo_jogo\">
        <a class=\"pesquisa\" ><img class=\"search-icon\" src=\"http://www.endlessicons.com/wp-content/uploads/2012/12/search-icon.png\"></a>
        </form> ";

        include("conexao.php");

        $sql = "SELECT * FROM jogos WHERE situacao='Ativo' AND visibilidade='privada' AND cod_jogo=$codigo_jogo ";

        $resultado = $conexao->query($sql);

        $linha = $resultado->fetch_object();

        if($linha->cod_jogo != "" || $linha->cod_jogo != null)
        {

            
        echo "
        <section id=\"blog\">
        <div class=\"container\">
        <div class=\"row\">
        <div class=\"col-md-9 clearfix\">
        <ul class=\"blog-zone\">";
            echo"					    <li>
            <div class=\"blog-icon\">
                <i class=\"fa  fa-pencil\"></i>
            </div>
            <div class=\"blog-box\">
                
                
                <div class=\"blog-post-body clearfix\">
                    <h2>$linha->nome</h2>
                </a>
                <div class=\"blog-post-tag\">
                    <div class=\"block\">
                        <i class=\"fa fa-clock-o\"></i>
                        <p>Código: $linha->cod_jogo:</p>
                    </div>
                    <div class=\"block\">
                    <i class=\"fa fa-user\"></i>
                    ";
    
                        $sql3 = "SELECT nome, apelido FROM `usuarios` WHERE cod_usuario='$linha->criador';";
                        $resultado3 = $conexao->query($sql3);
                        $linha3 = $resultado3->fetch_object();
                        
                        if($linha3->apelido == "" || $linha3->apelido == null)
                        {
                            echo"<p>Criador: $linha3->nome</p>";
                        }
                        else
                        {
                            echo"<p>Criador: $linha3->apelido</p>";
                        }
    
                echo"</div>
                    <div class=\"block\">
                        <i class=\"fa fa-tags\"></i>
                        <p>
                            Jogadores: $linha->us_atuais/$linha->us_maximos	
                        </p>
                    </div>
                    <div class=\"block\">
                        <i class=\"fa fa-comments\"></i>
                        <p> Data final: <input type=\"date\" id=\"datafina\" value=\"$linha->dt_final\" disabled></p>
                </div>
                </div>
                <p>$linha->descricao</p>
                <a id=\"$linha->cod_jogo\" class=\"btn btn-default btn-transparent pull-right ver_mais\" role=\"button\">
                    <span>Ver Mais</span>
                </a>
            </div>
            </div>	
        </li>";
        }
        else
        {
            echo"<br><br>
                    <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-md-9\">
                            <div class=\"products-heading\">
                                <h2>Aposta não encontrada</h2>
                            </div>	
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                ";
        }

        
        echo"					
        </div>	
        </div>	
        </div>	
        </div>	
        </section>	";
    }
    else
    {

        
        echo"
         
        <link rel=\"stylesheet\" href=\"css/tsyle.css\"> 

        <form class=\"search-container\">
        <input type=\"text\" id=\"search-bar\" placeholder=\"Busca\">
        <a class=\"pesquisa\" ><img class=\"search-icon\" src=\"http://www.endlessicons.com/wp-content/uploads/2012/12/search-icon.png\"></a>
        </form>

        <br><br>
                    <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-md-9\">
                            <div class=\"products-heading\">
                                <h2>Digite o código da aposta desejada</h2>
                            </div>	
                        </div>
                    </div>
                </div>
        
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                
        <style>

        #datafina
        {
        width: 98px; 
        }
    
        </style>

      ";


    }
    
?>