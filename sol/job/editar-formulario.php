<?php

include("../../../conecao.php");

$executa = $db->prepare("SELECT * FROM usuario WHERE idusuario=:idusuario");
$executa->bindParam(':idusuario', $_GET['id']);

$executa->execute();

$linha = $executa->fetch(PDO::FETCH_OBJ);



?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Editar user</title>
</head>
<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<center>



 <form action="editar.php" method="post">
	Nome: <input type="text" name="nome" required value="<?php echo $linha->nome; ?>"><br>
	SUS: <input type="text" name="sus" required value="<?php echo $linha->sus; ?>"><br>
	Data Nascimento: <input type="date" name="nasci" required value="<?php echo $linha->nasci; ?>"><br>
	Telefone: <input type="fone" name="fone" required value="<?php echo $linha->fone; ?>"><br>
	 <input type="hidden" name="codigo" value="<?php echo $linha->codigo; ?>">
     <button type="submit">Salvar</button>
     <a type="button" class="btn btn-primary" href="listar.php">Voltar</a>
 </center>
 
 </form>
</body>
</html>
