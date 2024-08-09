<!doctype html>
<html>
<head>
	<title>PPBets</title>
	<meta charset="utf-8">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet\" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="icon" type="image/png" sizes="16x16"  href="/favicons/favicon-16x16.png">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>
	<script src="js/owl.carousel.min.js" type="text/javascript"></script>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/main.js" type="text/javascript"></script>
	<script src="jquery-3.6.0.min.js"></script>

	<style>
  #conteudo
  {
    
    border: 1px solid white; 
	margin-top: 15px;
	margin-bottom: 100px;
	margin-right: auto;
	margin-left: auto;
    
  }

  #navber
  {
	display: inline;
	float: center;
	text-align: center;
    width: 100%;

  }

</style>
	<script>

	window.onload = function(){
		
		$.post("PBPV.php", {tipoPesquisa: "Publicas"});
		$.post("estado.php", {estado: "participando"});

		$("#Publicas").toggleClass("active");

		$.post("conteudo.php",
			{
				escolha: "Publicas"
			},
			function(resultado)
			{
				$("#conteudo").html(resultado)
			});


	}	


	$(document).ready(function(){

		$(".dropdown").mouseover(function(){

			$(this).next(".dropdown-menu").toggle();

		});

		$("#sair").click(function(){

			$.post("sair.php",function(retorno)
                    {
                        if(retorno == "recarregar")
                        {
                            alert("Você saiu da sessão");
                            location.reload(true);
                        }
                    });
				});

		$(".mudar").click(function(){

			$(".mudar"). removeClass('active');
			$(".dropdown"). removeClass('active');
			
			var v_escolhido = $(this).attr('id');

			if(v_escolhido == "Privadas" || v_escolhido == "Publicas")
			{
				$.post("PBPV.php", {tipoPesquisa: v_escolhido});

				$(this).toggleClass("active");
			}
			else
			{
				$(this).toggleClass("active");
			}

			$.post("conteudo.php",
			{
				escolha: v_escolhido
			},
			function(resultado)
			{
				$("#conteudo").html(resultado);
			});
		});



	});
	</script>


</head>
<body>


	
	<section id="top">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					
				</div>
				<div class="col-md-3 clearfix">
					<ul class="login-cart">
					<li></li>
						<li> <img src="images/P-coins.png" width="25">

						<?php 
						include("conexao.php");

						$id = $_SESSION["codigo"];

						$sql = "SELECT * FROM usuarios WHERE cod_usuario='$id' ";
					
						$resultado = $conexao->query($sql);

						$linha = $resultado->fetch_object();

						if($linha->validado == "sim")
						{
							echo"$linha->moedas";
						}
						else
						{
							echo"$linha->moedas   - Conta não validada";
						}

						?>
						</li>
						<li>
							<br>
							
						</li>
					</ul>
				</div>
			</div> 
		</div>	
			
	</section>  
	
	<header>
		<div class="container">
		<div class="row">
		<div class="col-md-12">
		<a href="#">
		<img src="images/logo1.png" alt="logo">
		</a>
		</div>
		</div>	
		</div>	
	</header> 

	<nav class="navbar navbar-default">
		<div class="container">

		      	<ul class="nav navbar-nav nav-main" id="navber">
		        	<li><a class="mudar" id="Publicas">PUBLICAS</a></li>
					<li><a class="mudar" id="Privadas">PRIVADAS</a></li>
					<li><a class="mudar" id="P_Coins">P-COINS</a></li>
					<li><a class="mudar" id="Apostas">APOSTAS</a></li>
					<li><a class="mudar" id="Informacoes">INFORMAÇÕES DO USUARIO</a></li>
					<li><a class="mudar" id="sair">SAIR</a></li>
		        </ul>
		
		</div>
	</nav>

		    
	<div id="conteudo"></div>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="block clearfix">
						<a href="#">
							<img src="images/footer-logo.png">
							<br>
							
						</a>
						<br>
						<p>
							O PPbets é uma plataforma onde busca formar um grupo de usuários ativos, e legítimos, que façam apostas seguras, para que possam ter entretenimento e algum lucro dentro da lei. Deste modo, reduz apostas ilegais e perigosas, que ocorrem em locais clandestinos, colocando em risco a integridade física e mental das pessoas. 
					</div>
				</div>
				<div class="col-md-4">
					<div class="block">
						<h4>INFORMAÇÕES</h4>
			
						<p> <i class="fa  fa-mobile"></i> <span>Telefone:</span> (+55) 12 98808-9087</p>

						<p> <i class="fa  fa-mobile"></i> <span>Telefone:</span> (+55) 12 98262-0922</p>
 
						<p class="mail"><i class="fa  fa-envelope"></i> <span>Email: </span> PPBets@gmail.com</p>
					</div>
				</div> 
				
			</div> 
		</div> 
		

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="cash-out pull-left">
							<li>
								<a href="#">
									<img src="images/American-Express.png" alt="">	
								</a>
							</li>
							<li>
								<a href="#">
									<img src="images/PayPal.png" alt="">	
								</a>
							</li>
							<li>
								<a href="#">
									<img src="images/Maestro.png" alt="">	
								</a>
							</li>
							<li>
								<a href="#">
									<img src="images/Visa.png" alt="">	
								</a>
							</li>
							<li>
								<a href="#">
									<img src="images/Visa-Electron.png" alt="">	
								</a>
							</li>
						</ul>
						<p class="copyright-text pull-right">Public Private Beta @2022 Designed by NextWave NI Empreendi</p>
					</div>	>	
				</div>	
			</div>	
		</div>	
	</footer> 
	
	<a id="back-top" href="#"></a>
</body>
</html>