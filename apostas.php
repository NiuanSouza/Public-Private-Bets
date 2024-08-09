<?php 

include("co_visualizar.php");

session_start();

$estado = $_SESSION["estatos"];

echo"

<script> 

  $(\"#btn_criar\").click(function()
  {
    $.post(\"conteudo.php\",
    {
      escolha: \"Criar\"
    },
    function(resultado)
    {
      $(\"#conteudo\").html(resultado);
    });
  });

  $(\".visualizar\").click(function()
  {
      var codigo = $(this).attr(\"id\");

      $.post(\"visualizar_aposta.php\",
      {
        cod_jogo: codigo,
        volta: \"Apostas\"
      },
      function(resultado)
      {
        $(\"#conteudo\").html(resultado);
      });
  });

  </script>
";

	echo"

    <section class=\"ftco-section\">
    <div class=\"container\">
        <div class=\"row justify-content-center\">
            <div class=\"col-md-6 text-center mb-5\">

            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"table-wrap\">
                    <table class=\"table table-striped\">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nome</th>
                          <th>Criador</th>
                          <th>Participantes</th>
                          <th>Visibilidade</th>
                          <th>Inscrição</th>
                          <th>Visualizar</th>
                        </tr>
                      </thead>
                      <tbody> ";
         

    $id = $_SESSION["codigo"];

    $sql = "";
    include("conexao.php");
    
      if($estado == "administrador")
      {
        $sql = " SELECT * FROM jogos WHERE criador='$id' ";
      }
      else
      {
        $sql = "SELECT jogos.cod_jogo, jogos.nome, jogos.criador, jogos.visibilidade, jogos.situacao, jogos.us_atuais, jogos.us_maximos FROM jogos INNER JOIN registro_jogos ON jogos.cod_jogo = registro_jogos.cod_jogo WHERE cod_usuario='$id'";
      }

    $resultado = $conexao->query($sql);

    $linha1 = $resultado->fetch_object();

    error_reporting(0);

    if($linha1->cod_jogo == "" || $linha1->cod_jogo == null)
    {
      if($estado == "participando")
      {
        echo"<tr>
        <td colspan='7'>Não foram encontrados registros de apostas em que você participando</td>
         </tr>";
      }
      else
      {
        echo"<tr>
        <td colspan='7'>Não foram encontrados registros de apostas em que você administrando</td>
         </tr>";
      }

    }
    else
    {
        if($estado == "administrador")
        {
          $sql2 = " SELECT * FROM jogos WHERE criador='$id' ";
        }
        else
        {
          $sql2 = "SELECT jogos.cod_jogo, jogos.nome, jogos.criador, jogos.inscricao,jogos.visibilidade, jogos.situacao, jogos.us_atuais, jogos.us_maximos FROM jogos INNER JOIN registro_jogos ON jogos.cod_jogo = registro_jogos.cod_jogo WHERE cod_usuario='$id'";
        }

        $resultado2 = $conexao->query($sql2);
      
        while($linha = $resultado2->fetch_object())
        {

          echo"
          <tr>
          <td>$linha->cod_jogo</td>
          <td>$linha->nome</td>
          ";

          $sql3 = "SELECT nome, apelido FROM `usuarios` WHERE cod_usuario='$linha->criador';";
          $resultado3 = $conexao->query($sql3);
          $linha3 = $resultado3->fetch_object();
          
          if($linha3->apelido == "" || $linha3->apelido == null)
          {
            echo"<td>$linha3->nome</td>";
          }
          else
          {
            echo"<td>$linha3->apelido</td>";
          }

          echo"
          <td>$linha->us_atuais/$linha->us_maximos</td>
          <td>$linha->visibilidade</td>";

          if($linha->inscricao == "Ativo")
          {
            echo" <td>Aberta</td> ";
          }
          else
          {
            echo" <td>Fechado</td> ";
          }

          if($linha->inscricao == "Ativo")
          {
            echo"<td><a id=\"$linha->cod_jogo\" class=\"btn btn-success visualizar\" >Visualizar</a></td>";
          }
          else if($linha->situacao == "Ativo")        
          {
            echo"<td><a id=\"$linha->cod_jogo\" class=\"btn btn-warning visualizar\" >Visualizar</a></td>";
          }
          else
          {
            echo"<td><a id=\"$linha->cod_jogo\" class=\"btn btn-danger visualizar\" >Visualizar</a></td>";
          }

          echo"</tr> ";
        }
      
        
      }  
      
                        echo"
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

";
if($estado == "participando")
{
    echo"
    <fieldset>
      <div id=\"escolha\">
        <input type=\"radio\" id=\"participando\"
        name=\"contact\" value=\"participando\" checked>
        <label for=\"participando\">Participando</label>

        <input type=\"radio\" id=\"administrador\"
        name=\"contact\" value=\"administrador\">
        <label for=\"administrador\">Administrador</label>

    </fieldset>
    ";
}
else
{
  echo"
  <fieldset>
    <div id=\"escolha\">
      <input type=\"radio\" id=\"participando\" name=\"contact\" value=\"participando\">
      <label for=\"participando\">Participando</label>

      <input type=\"radio\" id=\"administrador\" name=\"contact\" value=\"administrador\" checked>
      <label for=\"administrador\">Administrador</label>

  </fieldset>
  ";
}

include("conexao.php");

$idn = $_SESSION["codigo"];

$sqly = "SELECT * FROM usuarios WHERE cod_usuario='$idn' ";

$resultador = $conexao->query($sqly);

$linhar = $resultador->fetch_object();

if($linhar->validado == "sim")
{
  echo"
  <div class=\"center\">
  <button class=\"button button2\" id=\"btn_criar\" >Criar Aposta</button>
  </div>";
}

echo"

<br>
<br>


<style>

.center
{
  height: 25vh;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
}

.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  margin-right: auto;
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

#escolha{

    border: 1px solid white; 
    text-align: center;
}
</style>
";

    
?>