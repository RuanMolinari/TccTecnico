<?php

include('conecao.php');

if ($_POST['email'] == '') {

	$res['status'] = 3;
	echo json_encode($res);
	exit;

} 

if ($_POST['senha'] == '') {

	$res['status'] =  4;
	echo json_encode($res);
	exit;

}

$usuario = $_POST['email'];
$senha = $_POST['senha'];

if (strpos($usuario, '@uniuv.edu.br') !== false) {
	$user_email = $usuario;
}else{
    $user_email = $usuario . "@uniuv.edu.br";
}

$login = 0;

$consulta = $db->prepare("SELECT * FROM usuario WHERE Email = :user AND Senha = :senha;");
$consulta->bindParam(':user',$user_email, PDO::PARAM_STR);
$consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
$consulta->execute();

while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {

	$codigo = $linha->user;
	$nome = $linha->nome;

	if ($linha->senha==$senha){

		$login = 1;

	}

}

if($login <> 1){

	$explode = explode("@", $user_email);

	$user = $explode[0];

	$mbox = imap_open("{pop3.uniuv.edu.br:993/imap/novalidate-cert/ssl}INBOX", $user, $senha);

	if ($mbox) {
		$consulta2 = $pdo->prepare("SELECT * FROM usuario WHERE Email = :user LIMIT 1;");
		$consulta2->bindParam(':user',$user_email, PDO::PARAM_STR);
		$consulta2->execute();
		$res = $consulta2->fetch(PDO::FETCH_OBJ);
		if($consulta2->rowCount()>0){

			$codigo = $res->Codigo;
			$nome = $res->Nome;		

			$login = 1;
			
		}

	}

}

$res = [];

if ($login == 1) 
{
	SESSION_START();
	$_SESSION["user"] = $usuario;
	$_SESSION["nome"] = $nome;
	$_SESSION["idusuario"] = $codigo;
	$res['status'] = 1;

} else {

	$res['status'] = 2;

}


echo json_encode($res);
?>
