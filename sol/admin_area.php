<!DOCTYPE html>
<head>
	<meta charset="utf-8">
		<title> Critiside</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="jquery.bootgrid.min.js" integrity="sha256-S952WuaxC9XbI06xeWuSuSuvTewXEQQOU2OYBe7kdIs=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="jquery.bootgrid.fa.min.js" integrity="sha256-u/DZtNLWZSvkNdIL4PTQzEJUAFLzM758asxZnhd+5R4=" crossorigin="anonymous"></script>
</head>

<body>
	<table id="grid-data-api" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" data-url="">
		<thead>
			<tr>
				<th data-column-id="idusuario" data-type="numeric" id='identifier'> ID</th>
				<th data-column-id="nome">Nome</th>
				<th data-column-id="fone">Fone</th>
				<th data-column-id="email">E-Mail</th>
				<th data-column-id="user">Usuário</th>
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
</body>
</html>