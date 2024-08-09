<?php 

    echo "
  
                $(\"#btn_login\").click(function(){
                    
                    var v_email = $(\"#email_login\").val();
                    var v_senha = $(\"#senha_login\").val();

                    $.post(\"confirmar_login.php\",
                    {
                        email: v_email,
                        senha: v_senha
                    },
                    function(retorno)
                    {
                        if(retorno == \"recarregar\")
                        {
                            alert(\"Login efetuado com sucesso\");
                            location.reload(true);
                        }
                        else
                        {
                            alert(retorno);
                        }
                    });

                });
    ";
?>
