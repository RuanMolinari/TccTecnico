<?php
include ("connect.php");

include ("../seguranca_sol.php");

include ("ini.php");



/*
$executa = $db->prepare("SELECT * FROM job WHERE solicitante=:solicitante");
$executa->bindParam(':solicitante', $_SESSION['idusuario']);


$executa->execute();
$linha = $executa->fetch(PDO::FETCH_OBJ);*/


$executa = $db->prepare("SELECT job.*,
  evento.nome AS nome_evento,
  Count(categoria_has_job.categoria_idcategoria) AS material,
  usuario.nome AS nome_solicitante,
  DATE_FORMAT(data_pedido,'%d/%m/%Y %T') as data_pe,
  DATE_FORMAT(data_entrega,'%d/%m/%Y ') as data_en
FROM
  job
  LEFT JOIN evento ON job.evento = evento.idevento
  LEFT JOIN categoria_has_job ON categoria_has_job.job_idjob = job.idjob
  INNER JOIN usuario ON job.solicitante = usuario.idusuario

where
 job.solicitante = :solicitante
  
  
GROUP BY
  categoria_has_job.job_idjob
  
  order by job.data_pedido desc");
$executa->bindParam(':solicitante', $_SESSION['idusuario']);

$executa->execute();



?>


    <div class="container-fluid">
        <div class="index-content">
        <?php while($linha = $executa->fetch(PDO::FETCH_OBJ)): ?>
            <div class="col-lg-4 col-sm-6"><br>

                <div class="card border-danger mb-3">

                        <input type="hidden" name="idjob" value="<?php echo $linha->idjob; ?>">


                        <div>
                            <?php

                            if ($linha->material==0){
                                echo '<label class="label label-danger">Não tem material</label>';
                            }else {
                                echo '<label class="label label-success">Com material</label>';
                            }
                            ?>
                        </div>
                        <div>
                            <?php

                            if ($linha->colaborador==0){
                                echo '<label class="label label-success">Não tem colaborador</label>';
                            }else {
                                echo '<label class="label label-danger">Com colaborador</label>';
                            }
                            ?>
                        </div>
                        <div>
                            <?php

                            if ($linha->nome_evento==''){
                                echo '<label class="label label-danger">Não tem Evento</label>';
                            }else {
                                echo '<label class="label label-success">Com evento</label>';
                            }
                            ?>
                        </div>

                        Data de Registro: <?php echo $linha->data_pe; ?><br>
                        Observação:  <?php echo $linha->observacao; ?><br>
                        <a type="submit" href="read.php?id=<?php echo $linha->idjob; ?>" class="blue-button">Informações</a>

                </div>
            </div>
        <?php endwhile; ?>

        </div>
    </div>

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
include ("rest.php");

