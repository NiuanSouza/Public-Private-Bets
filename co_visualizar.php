<?php 


echo "

    <script>

  
    $(\"#administrador\").click(function(){
 
        $.post(\"estado.php\", {estado: \"administrador\"});

        $.post(\"conteudo.php\",
        {
            escolha: 'Apostas'
        },
        function(resultado)
        {
            $(\"#conteudo\").html(resultado)
        });
    });

    $(\"#participando\").click(function(){
 
        $.post(\"estado.php\", {estado: \"participando\"});

        $.post(\"conteudo.php\",
		{
				escolha: 'Apostas'
		},
		function(resultado)
		{
			$(\"#conteudo\").html(resultado)
		});
    });

    </script>
";
?>