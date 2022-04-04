<?php

include ("../seguranca_sol.php");

include ("ini.php");
?>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="1https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="1https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <script src="jquery.validate.js"></script>

   
<form id="formulario" enctype="multipart/form-data" role="form" action="job/inserir.php" method="post" class="f1" >

                    		
                    		<div class="f1-steps">
                    			<div class="f1-progress">
                    			    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                    			</div>
                    			<div class="f1-step active">
                    				<div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    				<p>Artes Gráficas</p>
                    			</div>
                    			<div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    				<p>Evento</p>
                    			</div>
                    		    <div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-twitter"></i></div>
                    				<p>Conclusão</p>
                    			</div>
                    		</div>
                    		
                    		<fieldset>
                                <h4>Deseja Alguma Arte Gráfica?</h4>
                                <div>
                                <button type="button" class="btn btn-primary collapsed simArtes" data-toggle="collapse" data-target="#artes" aria-expanded="false" aria-controls="artes" >Sim</button>

                                <button type="button" class="btn btn-warning btn-next naoArtes">Não</button>
                                </div>

                                <div id="artes" class="collapse">
                                    <div class="container-fluid">

                                    <div class="row">
                                        <label class="control-label">Data de Entrega</label>
                                        <input type="date" class="form-control" name="data_entrega" min="<?php echo date("Y-m-d", strtotime("tomorrow")); ?>" required data-valid-messages="??????">
                                    </div>
                                        <label id="categoria[]-error" class="error" for="categoria[]" style="display: none;">Selecione pelo menos 1 categoria.</label>
                                        <div class="row">
                                    <button class="btn btn-primary" data-toggle="collapse" data-target="#digital" aria-expanded="false" aria-controls="digital">
                                        Digital
                                    </button>
                                        </div>
                                    </div>
                                    <div class="collapse  in" id="digital">
                                    <div class="container-fluid">
                                        <div class="row">

                                            <?php
                                                include("connect.php");
                                                $resultado = $db->query("SELECT * FROM categoria_job where tipo=1;");
                                            while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
                                            echo "<div><label><input type='checkbox' required name='categoria[]' value='{$linha->idcategoria_digital}'> {$linha->nome}</label></div>";
                                            }

                                            //aqui vai o select e while
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                   <br>
                                    <div>

                                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#impresso" aria-expanded="true" aria-controls="digital">
                                        Impresso
                                    </button></div>
                                    <div class="collapse in" id="impresso">
                                        <div class="container-fluid">
                                            <div class="row">

                                                <?php
                                                include("connect.php");
                                                $resultado = $db->query("SELECT * FROM categoria_job where tipo=2;");
                                                while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
                                                echo "<div><label><input type='checkbox' name='categoria[]' value='{$linha->idcategoria_digital}'> {$linha->nome}</label></div>";
                                                }

                                                //aqui vai o select e while
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="f1-buttons">
                                        <button type="button" class="btn btn-next">Proximo</button>

                                    </div>
                                </div>

                            </fieldset>

                            <fieldset>
                                <h4>Evento</h4>
                                <!--<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#evento-opcoes" aria-expanded="false" aria-controls="evento-opcoes">Mostrar/Esconder</button>-->
                                <div id="evento-sim-nao">
                                    <button type="button" name="eve" value="1" class="btn btn-primary collapsed" id="evento-sim" data-toggle="collapse" data-target="#evento-opcoes" aria-expanded="false" aria-controls="evento-opcoes" >Sim</button>

                                <button type="button" class="btn btn-warning btn-next">Não</button>
                                </div>
                                 <div id='evento-opcoes' class="collapse">
                                    <div class="form-group">
                                            <label class="control-label">Descrição do Evento</label>
                                            <input maxlength="100" type="text" name="nome" class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Local</label>
                                            <input maxlength="100" type="text" name="local" class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Data do evento</label>
                                            <input type="date" name="data" class="form-control" min="<?php echo date("Y-m-d", strtotime("tomorrow")); ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Hora do evento</label>
                                            <input type="time" name="hora" class="form-control" required />
                                        </div>
                                     <div class="f1-buttons">
                                         <button type="button" class="btn btn-previous">Voltar</button>
                                         <button type="button" class="btn btn-next">Proximo</button>
                                     </div>
                                 </div>


                            </fieldset>

                            <fieldset>
                                <h4>Conclusão</h4>
					<div class="form-group">
                        <label class="control-label">Observação</label>
                        <textarea maxlength="150" class="form-control" name="observacao" ></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Enviar Aquivo</label>
                        <input type="file" name="arquivo[]" multiple="multiple" /><br><br>
                    </div>
                                    <button type="button" class="btn btn-previous">Voltar</button>
                                    <button type="submit" class="btn btn-submit">Enviar</button>
                                </div>
                            </fieldset>

                    	</form>

<script>
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
                            document.location='my.php';
                        }else{
                            alert(data.mensagem);
                        }
                    }
                });
    $("#mostra-evento").on("click", function(){
        $(this).hide();
        $("#evento-opcoes").fadeIn();
    });


    $(".naoArtes").on("click", function(){
        $('#evento-sim-nao').hide();
        $('#evento-sim').trigger('click');
    });
    $(".simArtes").on("click", function(){
        $('#evento-sim-nao').show();
    });
    $("#formulario").validate();
});




</script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->


<?php
include ("rest.php");

