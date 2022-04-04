<?php
//include("../seguranca.php");
include("ini.php");
?>

  
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Serviço de Busca de Tarefas
            </h1>

        </section>

    <meta charset="utf-8">
    <title> Critiside</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <script src="jquery.bootgrid.min.js" integrity="sha256-S952WuaxC9XbI06xeWuSuSuvTewXEQQOU2OYBe7kdIs=" crossorigin="anonymous"></script>
    <table id="grid-data-api" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" data-url="">
        <thead>
        <tr>
            <th data-column-id="idjob" data-type="numeric" id='identifier'> ID</th>
            <th data-column-id="solicitante">Solicitante</th>
            <th data-column-id="colaborador">Colaborador</th>
            <th data-column-id="data_pedido">Data de Pedido</th>
            <th data-column-id="hora_pedido">Hora do Pedido</th>
            <th data-column-id="data_entrega">Data de Entrega</th>
            <th data-column-id="hora_entrega">Hora da Entrega</th>
            <th data-column-id="status">Status de Pedido</th>
            <th data-column-id="evento">Evento</th>
            <th data-column-id="data_evento">Data do Evento</th>
            <th data-column-id="hora_evento">Hora do Evento</th>
            <th data-column-id="observacao">Observação</th>
            <th data-column-id="categoria">Categoria</th>

            <th data-column-id="commands" data-formatter="commands" data-sortable="false" ></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script>
        $(document).ready(function(){
            var grid = $("#grid-data-api").bootgrid({
                ajax: true,
                url: "mod_select.php",
                formatters: {
                    "commands": function(column, row)
                    {
                        return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.idusuario + "\"><span class=\"fa fa-pencil-alt\"></span></button> " +
                            "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.idusuario + "\"><span class=\"fa fa-trash-alt\"></span></button>";
                    }
                }
            }).on("loaded.rs.jquery.bootgrid", function()
            {
                grid.find(".command-edit").on("click", function(e)
                {
                    alert("You pressed edit on row: " + $(this).data("row-id"));
                }).end().find(".command-delete").on("click", function(e)
                {
                    alert("You pressed delete on row: " + $(this).data("row-id"));
                });
            });
        });
    </script>

<?php
include("rest.php");
