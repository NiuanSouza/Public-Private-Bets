<?php 
   
   session_start();

if(isset($_SESSION["pesquisa"]) && $_SESSION["pesquisa"] != "" && $_SESSION["pesquisa"] == "Privadas"  )
{
        echo "
        <script>
  
                $(\".pesquisa\").click(function(){
                    
                    var v_conteudo = $(\"#search-bar\").val();

                    $.post(\"privadas.php\",
                    {
                        filtro: v_conteudo,
                    },
                    function(resultado)
                    {
                            $(\"#conteudo\").html(resultado)
                        
                    });

                });

                </script> ";
}
elseif(isset($_SESSION["pesquisa"]) && $_SESSION["pesquisa"] != "" && $_SESSION["pesquisa"] == "Publicas")
{
    echo "
    <script>

            $(\".pesquisa\").click(function(){
                
                var v_conteudo = $(\"#search-bar\").val();

                $.post(\"publicas.php\",
                {
                    filtro: v_conteudo,
                },
                function(resultado)
                {
                        $(\"#conteudo\").html(resultado)
                    
                });

            });

            </script> ";
}

?>
