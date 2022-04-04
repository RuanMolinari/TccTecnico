<?php




	session_start();
include("conecao.php");
	$explode = explode("@", $_POST['user']);
	$user = $explode[0];
	
	$execute = $db->prepare("SELECT * FROM usuario WHERE status=1 AND user=:user");
	$execute->BindParam(':user', $user);
	$resultado = $execute->execute();

	if ($execute->rowCount()==1) {
		$linha = $execute->fetch(PDO::FETCH_OBJ);

		if ($linha->senha=='' OR strpos($linha->email, '@uniuv.edu.br') !== false){
		    //verifica no email
            //verificar senha no email, através do PHPMailer com IMAP


            if (verifica_senha_email($_POST['user'], $_POST['senha'])){
                $_SESSION['acesso_liberado'] = 1;
                $_SESSION['user'] = $linha->user;
                $_SESSION['idusuario'] = $linha->idusuario;
                $ret['hierarquia'] = $_SESSION['hierarquia'] = $linha->hierarquia;
                $ret['status'] = true;
				if ($linha->nome==''){
					$_SESSION['usuario_novo'] = 1;
				}
            }else{
                $ret['mensagem'] = 'Usuario ou senha incorretos.';
                $ret['status'] = false;
            }
        }else{
            $senha = md5($_POST['senha']);

            if($linha->user==$user AND $linha->senha==$senha){
                $_SESSION['acesso_liberado'] = 1;
                $_SESSION['user'] = $linha->user;
                $_SESSION['idusuario'] = $linha->idusuario;
                $ret['hierarquia'] = $_SESSION['hierarquia'] = $linha->hierarquia;
                $ret['status'] = true;
            }else{
                $ret['mensagem'] = 'Usuario ou senha incorretos';
                $ret['status'] = false;
            }
        }

    }else{

        if (verifica_senha_email($_POST['user'], $_POST['senha'])){
    
			
			//explode user
			$st = 1;
			$hi = 3;

			$executa = $db->prepare("INSERT INTO usuario (nome,senha,hierarquia,email,status,user, fone) VALUES ('','',:hierarquia,:email,:status,:user, '')");
			$executa->bindParam(':hierarquia', $hi);
			$executa->bindParam(':email', $_POST['user']);
			$executa->bindParam(':status', $st);
			$executa->bindParam(':user', $user);

			$resultado = $executa->execute();

			if ($resultado){
				$ret['mensagem'] = 'Dados inseridos com sucesso!';
				$ret['status'] = true;
			}
			else{
				$ret['mensagem'] = $db->errorInfo();
				$ret['status'] = false;
			}
			
			$idusuario = $db->lastInsertId();
			
            $_SESSION['acesso_liberado'] = 1;
            $_SESSION['user'] = $user;
			$_SESSION['usuario_novo'] = 1;
            $_SESSION['idusuario'] = $idusuario; //tem q recuperar o id de um select
            $ret['hierarquia'] = $_SESSION['hierarquia'] = $hi;
            $ret['status'] = true;
        }else{
            $ret['mensagem'] = 'Usuario ou senha incorretos.';
            $ret['status'] = false;
        }
	}
	echo json_encode($ret);	

