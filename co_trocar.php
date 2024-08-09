<?php 

    echo"


            $(\".btn_ir\").click(function(){
                
                var atual = $(\"#conteudo\").attr(\"valor\");

                if(atual == \"cadastro\")
                {
                    $(\"#conteudo\").attr(\"valor\",\"login\");

                    $.post(\"login.php\", function(retorno){

                        $(\"#conteudo\").html(retorno);
                    });
                }

                else
                {
                    $(\"#conteudo\").attr(\"valor\",\"cadastro\");

                    $.post(\"cadastro.php\", function(retorno){

                        $(\"#conteudo\").html(retorno);
                    });
                }
            });
";

?>