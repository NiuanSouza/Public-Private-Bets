<?php 
echo"

<style> 

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

  #cardis
  {
	border: none;
	color: black;
	padding: 15px 32px;
	text-align: justify;
	text-decoration: none;
  }

</style>

";

include("conexao.php");

session_start();

$idn = $_SESSION["codigo"];

$sqly = "SELECT * FROM usuarios WHERE cod_usuario='$idn' ";

$resultador = $conexao->query($sqly);

$linhar = $resultador->fetch_object();


if(isset($_SESSION["estado_cartao"]) && $_SESSION["estado_cartao"] == "valido" )
{

	$atual = $linhar->moedas;

echo "

<script> 

	$(\"#btn_adicionar\").click(function()
	{
		$.post(\"conteudo.php\",
		{
			escolha: \"Cartao\"
		},
		function(resultado)
		{
			$(\"#conteudo\").html(resultado);
		});
	});

	$(\"[name=codigo_cartao]\").click(function()
	{
		var cardnun = $(this).val();

		$.post(\"estadocard.php\", {estado: \"valido\", card: cardnun});

		$.post(\"conteudo.php\",
		{
			escolha: \"P_Coins\"
		},
		function(resultado)
		{
			$(\"#conteudo\").html(resultado);
		});

	});

	$(\".caption1\").click(function()
	{
		var v_valor = 1000;

		var total = v_valor +  $atual;

		$.post(\"confirmar_compra.php\",{adicional:total});

		location.reload(true);

	});

	$(\".caption5\").click(function()
	{
		var v_valor = 5000;	
		
		var total = v_valor +  $atual;

		$.post(\"confirmar_compra.php\",{adicional:total});

		location.reload(true);

	});

	$(\".caption8\").click(function()
	{
		var v_valor = 8000;		

		var total = v_valor +  $atual;

		$.post(\"confirmar_compra.php\",{adicional:total});

		location.reload(true);

	});

	</script>
";
}
elseif($linhar->validado == "sim")
{


echo "

<script> 

	$(\"#btn_adicionar\").click(function()
	{
		$.post(\"conteudo.php\",
		{
			escolha: \"Cartao\"
		},
		function(resultado)
		{
			$(\"#conteudo\").html(resultado);
		});
	});

	$(\"[name=codigo_cartao]\").click(function()
	{
		var cardnun = $(this).val();
		$.post(\"estadocard.php\", {estado: \"valido\", card: cardnun});

		$.post(\"conteudo.php\",
		{
			escolha: \"P_Coins\"
		},
		function(resultado)
		{
			$(\"#conteudo\").html(resultado);
		});
		
	});

	$(\".caption1\").click(function()
	{
		alert(\"Por favor selecione um cartão\");

	});

	$(\".caption5\").click(function()
	{	
		alert(\"Por favor selecione um cartão\");
	});

	$(\".caption8\").click(function()
	{
		alert(\"Por favor selecione um cartão\");

	});

	</script>
";
}
else
{
	echo "

<script> 

	$(\".caption1\").click(function()
	{

		alert(\"Você não pode comprar P-coins, acesse a aba de informações do usuario para validar sua conta\");

	});

	$(\".caption5\").click(function()
	{
		alert(\"Você não pode comprar P-coins, acesse a aba de informações do usuario para validar sua conta\");
	});

	$(\".caption8\").click(function()
	{
		alert(\"Você não pode comprar P-coins, acesse a aba de informações do usuario para validar sua conta\");
	});

	</script>
";
}

echo"

    <section id=\"catagorie\">
		<div class=\"container\">
			<div class=\"row\">
				<div class=\"col-md-12\">
					<div class=\"block\">
						<div class=\"block-heading\">
							<h2>COMPRE P-COINS AGORA</h2>
						</div>	
						<div class=\"row\">
						  	<div class=\"col-sm-6 col-md-4\">
							    <div class=\"thumbnail\">
							    	<a class=\"catagotie-head\">
										<img src=\"images/P_coins1.jpg\" alt=\"...\">
										<h3>1000</h3>
									</a>
							      	<div class=\"caption1\">
							        
							        		<a class=\"btn btn-default btn-transparent\"  id=\"pcoin_1\" role=\"button\">
							        			<span>R$2.00</span>
							        		</a>
							        	</p>
							      	</div>
							    </div>
						  	</div>	
						  	<div class=\"col-sm-6 col-md-4\">
							    <div class=\"thumbnail\">
							    	<a class=\"catagotie-head\">
										<img src=\"images/P_coins5.jpg\" alt=\"...\">
										<h3>5000</h3>
									</a>
							      	<div class=\"caption5\">
							        	
							        		<a  class=\"btn btn-default btn-transparent\"  role=\"button\">
							        			<span>R$5.50</span>
							        		</a>
							        	</p>
							      	</div>	
							    </div>	
						  	</div>

						  	<div class=\"col-sm-6 col-md-4\">
							    <div class=\"thumbnail\">
							    	<a class=\"catagotie-head\">
										<img src=\"images/P_coins8.jpg\" alt=\"...\">
										<h3>8000</h3>
									</a>
							      	<div class=\"caption8\" >
								        
								        	<a  class=\"btn btn-default btn-transparent\" role=\"button\">
								        		<span>R$8.25</span>
								        	</a>
								        </p>
								    </div>	
							    </div>	
						  	</div>	
						</div>	
					</div>	
				</div>	
			</div>
		</div>	
	</section>	
";

if($linhar->validado == "sim")
{

echo"  


<fieldset>


<div class=\"cardis\">

<p>Selecione o cartão a ser usado:</p>


";

$ide = $_SESSION["codigo"];

$sql = " SELECT * FROM cartao WHERE dono='$ide' ";

$resultado = $conexao->query($sql);

while($linha = $resultado->fetch_object())
{
	$nume = $linha->numero;
	if(isset($_SESSION['number_cartao']) &&  $_SESSION['number_cartao'] == "$linha->numero")
	{

		echo"
			<input type=\"radio\" id=\"$linha->codigo_cartao\" name=\"codigo_cartao\" value=\"$linha->numero\" checked>
			<label for=\"$linha->codigo_cartao\"> Cartão: $linha->numero </label>
			<br>  ";
	}
	else
	{
		echo"
			<input type=\"radio\" id=\"$linha->codigo_cartao\" name=\"codigo_cartao\" value=\"$linha->numero\">
			<label for=\"$linha->codigo_cartao\"> Cartão: $linha->numero </label>
			<br>  ";
	}
}


echo"


<button class=\"button button2\" id=\"btn_adicionar\" >Adicionar um cartão</button>

</div>

</div>
</fieldset>

";

}

?>