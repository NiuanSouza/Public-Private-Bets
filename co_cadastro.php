<?php 

    echo "
  
                $(\"#btn_cadastro\").click(function(){
                    
                    var v_nome = $(\"#nome_cad\").val();
                    var v_email = $(\"#email_cad\").val();
                    var v_senha = $(\"#senha_cad\").val();


                    $.post(\"confirmar_cadastro.php\",
                    {
                        nome: v_nome,
                        email: v_email,
                        senha: v_senha
                    },
                    function(retorno)
                    {
                        if(retorno == \"Ok\")
                        {
                            alert(\"Cadastro efetuado com sucesso\");
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