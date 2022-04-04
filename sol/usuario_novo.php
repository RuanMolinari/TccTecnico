<?php

include ("../seguranca_sol.php");

include ("ini.php");
?>

<form id="formulario" method="post" action="insere.php">
<h3>Insira seu Nome</h3>
<label>Nome:</label>
<input type="text" name="nome" placeholder="Nome"><br>
<label>Fone:</label>
<input name="fone" onkeypress="mascara(this, '## ####-####')" maxlength="12" required placeholder="Telefone"></h5><br>
<button type="submit" class="btn btn-success">Enviar</button>

</form>
<script type="text/javascript">
$(document).ready(function() {
                // bind 'myForm' and provide a simple callback function
                $('#formulario').ajaxForm({
                    // dataType identifies the expected content type of the server response
                    dataType:  'json',

                    // success identifies the function to invoke when the server response
                    // has been received
                    success:   function(data){
                        if (data.status==1) {
                            alert(data.mensagem);
                            $("#formulario").trigger('reset');
                            document.location='index.php';
                        }else{
                            alert(data.mensagem);
                        }
                    }
                })
            });


function mascara(t, mask){
            var i = t.value.length;
            var saida = mask.substring(1,0);
            var texto = mask.substring(i)
            if (texto.substring(0,1) != saida){
                t.value += texto.substring(0,1);
            }
        }
    </script>

<?php
include ("rest.php");
