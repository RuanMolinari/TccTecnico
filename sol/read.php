<?php
include("../seguranca_sol.php");
include("connect.php");
include("ini.php");

$executa = $db->prepare("SELECT
  job.*,
  evento.nome AS nome_evento,
  evento.local AS local,
  evento.hora AS hora,
  Count(categoria_has_job.categoria_idcategoria) AS material,
  usuario.nome AS nome_colaborador,
  Date_Format(job.data_pedido, '%d/%m/%Y %T') AS data_pe,
  Date_Format(job.data_entrega, '%d/%m/%Y ') AS data_en
FROM
  job
  LEFT JOIN evento ON job.evento = evento.idevento
  LEFT JOIN categoria_has_job ON categoria_has_job.job_idjob = job.idjob
  LEFT JOIN usuario ON job.colaborador = usuario.idusuario
WHERE
  job.idjob = :idjob
GROUP BY
  categoria_has_job.job_idjob
ORDER BY
  job.data_pedido DESC");


$executa->bindParam(':idjob', $_GET['id']);
$executa->execute();

$linha = $executa->fetch(PDO::FETCH_OBJ);

$e = $db->prepare("SELECT
  categoria_job.nome AS nome,
  tipo.nome AS tipo
FROM
  categoria_has_job
  INNER JOIN categoria_job ON categoria_has_job.categoria_idcategoria = categoria_job.idcategoria_digital
  INNER JOIN tipo ON categoria_job.tipo = tipo.idtipo
WHERE
  categoria_has_job.job_idjob = :idjob");
$e->bindParam(':idjob', $_GET['id']);
$e->execute();




?>

        <div class="col-lg-4 col-sm-6">
            <div class="card">
				
				
                Data de Registro: <?php echo $linha->data_pe; ?><br>
				 Data de Entrega: <?php echo $linha->data_en; ?><br>
                Colaborador:  <?php echo $linha ->nome_colaborador; ?><br>
                Observação:  <?php echo $linha->observacao; ?><br>
<?php
while($categoria = $e->fetch(PDO::FETCH_OBJ)){ ?>

                Categoria:  <?php echo $categoria->nome;?> Tipo: <?php echo $categoria->tipo;?> <br>

<?php } ?>				
				<?php
				if($linha->nome_evento<>''){
                    echo 'Evento:' . $linha->nome_evento . '<br>';
                    echo 'Local do Evento:' . $linha->local . '<br>';
                    echo 'Hora do Evento:' . $linha->hora . '<br>';
				}else{

				}
					?><br>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
                                                
                                                $ex = $db->prepare("SELECT
  arquivo_job.*
FROM
  arquivo_job
  INNER JOIN usuario ON arquivo_job.user = usuario.idusuario
WHERE
  arquivo_job.job_idjob = :job_idjob AND 
  usuario.hierarquia = 3");
                        $ex->bindParam(':job_idjob', $_GET['id']);
                        $ex->execute();

                                                //aqui vai o select e while
        if ($ex->rowCount()>0) {
        ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Arquivos Solicitante
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <?php
                                                while ($li = $ex->fetch(PDO::FETCH_OBJ)) {
                          echo '<br><a target="down" href="../upload/' . $li->caminho . '" download >' . $li->nome_original . '</a></br>';
                                                }

        ?>
      </div>
    </div>
  </div>
      <?php
      }
      ?>

<?php

    $ex = $db->prepare("SELECT
  arquivo_job.*
FROM
  arquivo_job
  INNER JOIN usuario ON arquivo_job.user = usuario.idusuario
WHERE
  arquivo_job.job_idjob = :job_idjob AND 
  (usuario.hierarquia = 1 OR usuario.hierarquia = 2)");
												$ex->bindParam(':job_idjob', $_GET['id']);
												$ex->execute();
 if ($ex->rowCount()>0) {
     ?>
     <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="headingTwo">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Arquivos Colaborador
            </a>
          </h4>

         </div>

         <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
             <div class="panel-body">
              <form id="formulario_aceite" action="aceito.php" method="post">
                <input type="hidden" name="idjob" value="<?php echo $linha->idjob; ?>">
                 
                 <?php
                 $itens_aprovar = 0;
                 while ($li = $ex->fetch(PDO::FETCH_OBJ)) {
                    if ($li->aprovado=='aguardando'){
                     echo '  <br><input type="checkbox" name="arquivo[' . $li->id_arquivo . ']" value="1"> ';
                     $itens_aprovar++;
                    }else if($li->aprovado=='sim'){
                      echo '<label class="label label-success">Aprovado</label>';
                    }else if($li->aprovado=='não'){
                      echo '<label class="label label-danger">Reprovado</label>';
                    }
                    echo '<a target="down" href="../upload/' . $li->caminho . '" download >' . $li->nome_original . '</a></br>';
                 }

                 //aqui vai o select e while
                if ($itens_aprovar){
                 echo '<button type="button" class="btn btn-success" id="aceitar">Aceitar</button>
                 <button type="button" class="btn btn-danger" id="recusar">Recusar</button>';
               }
                 ?>
                 <input type="hidden" value="" name="tipo" id="tipo">
               </form>
             </div>
         </div>
     </div>
         <?php
         }
         ?>

</div>
				<a class="btn btn-info" href="my.php" role="button">Voltar</a>
                
            </div>
        </div>





<script>

        $(document).ready(function() {
            $("#aceitar").click(function(){
              $("#tipo").val("sim");
              $(this).parent().submit();
            });

            $("#recusar").click(function(){
              $("#tipo").val("não");
              $(this).parent().submit();
            });

            // bind 'myForm' and provide a simple callback function
            $('#formulario_aceite').ajaxForm({
                // dataType identifies the expected content type of the server response
                dataType:  'json',

                // success identifies the function to invoke when the server response
                // has been received
                success:   function(data){
                    if (data.status==1) {
                        alert(data.mensagem);
                        location.reload();
                    }else{
                        alert(data.mensagem);
                    }
                }
            });
        });
</script>
    <style>
        .index-content a:hover{
            color:black;
            text-decoration:none;
        }
        .index-content{
            margin-bottom:20px;
            padding:50px 0px;

        }
        .index-content .row{
            margin-top:20px;
        }
        .index-content a{
            color: black;
        }
        .index-content .card{
            background-color: #FFFFFF;
            padding:0;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius:4px;
            box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);

        }
        .index-content .card:hover{
            box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3);
            color:black;
        }
        .index-content .card img{
            width:100%;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }
        .index-content .card h4{
            margin:20px;
        }
        .index-content .card p{
            margin:20px;
            opacity: 0.65;
        }
        .index-content .blue-button{
            width: 100px;
            -webkit-transition: background-color 1s , color 1s; /* For Safari 3.1 to 6.0 */
            transition: background-color 1s , color 1s;
            min-height: 20px;
            background-color: #002E5B;
            color: #ffffff;
            border-radius: 4px;
            text-align: center;
            font-weight: lighter;
            margin: 0px 20px 15px 20px;
            padding: 5px 0px;
            display: inline-block;
        }
        .index-content .blue-button:hover{
            background-color: #dadada;
            color: #002E5B;
        }
        @media (max-width: 768px) {

            .index-content .col-lg-4 {
                margin-top: 20px;
            }
        }
    </style>
<?php

include("rest.php");