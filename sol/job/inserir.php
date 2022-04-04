<?php

try{
    include("../../seguranca_sol.php");


    include("../connect.php");

    if (!isset($_POST['data_entrega']) OR !isset($_POST['data'])) {
        throw new Exception("Tamanho de arquivo muito grande.");
    }

	$db->beginTransaction();

    date_default_timezone_set('America/Sao_Paulo');

    if ($_POST['data_entrega']!=''){
        $ww = date_create($_POST['data_entrega']);
        $entrega = date_format($ww,"Y/m/d H:i:s");
    }else {
        //data do evento
        $ww = date_create($_POST['data']);
        $entrega = date_format($ww, "Y/m/d H:i:s");
    }
    $uu = date_create($_POST['data']);
    $data = date_format($uu, "Y/m/d H:i:s");
        //inserir o evento se necessario
    if (isset($_POST['nome']) AND $_POST['nome']<>'') {


            $executa = $db->prepare("INSERT INTO evento (data, hora, nome, local) VALUES (:data, :hora, :nome, :local)");
            $executa->bindParam(':data', $data);
            $executa->bindParam(':hora', $_POST['hora']);
            $executa->bindParam(':nome', $_POST['nome']);
            $executa->bindParam(':local', $_POST['local']);
            $evento = $executa->execute();

            $evento = $db->lastInsertId();
     }






    $executa = $db->prepare("INSERT INTO job (evento, data_entrega, data_pedido, status, observacao, solicitante) VALUES (:evento, :data_entrega, NOW() , 1, :observacao, :solicitante)");
    $executa->bindParam(':evento', $evento);
    $executa->bindParam(':data_entrega', $entrega);
	$executa->bindParam(':observacao', $_POST['observacao']);
    $executa->bindParam(':solicitante', $_SESSION['idusuario']);
    $resultado = $executa->execute();

    $idjob = $db->lastInsertId();





    if (isset($_POST['categoria'])){
        foreach($_POST['categoria'] as $idcat){
            $a = $db->prepare("INSERT INTO categoria_has_job VALUES (:idcategoria, :idjob )");
            $a->bindParam(":idjob", $idjob);
            $a->bindParam(":idcategoria", $idcat);
            $resultado = $a->execute();
        }

    }


    $diretorio = "../../upload";

    if(!is_dir($diretorio)){
        echo "Pasta $diretorio nao existe";
    }else{
        if (isset($_FILES['arquivo'])) {
			
			$arquivo = $_FILES['arquivo'];
			for ($controle = 0; $controle < count($arquivo['name']); $controle++){


				$nome_arquivo = uniqid() . "." . pathinfo($arquivo['name'][$controle], PATHINFO_EXTENSION);
				$destino = $diretorio."/".$nome_arquivo;

				if($arquivo['error'][$controle]<>0 OR !move_uploaded_file($arquivo['tmp_name'][$controle], $destino)){
					throw new Exception("Erro ao realizar upload");
				}else{
					$a = $db->prepare("INSERT INTO `arquivo_job` (`user`, `job_idjob`, `observacao`, `caminho`, `nome_original`) VALUES  (:user, :idjob, :observacao, :arquivo, :nome_original )");
					$a->bindParam(":idjob", $idjob);
					$a->bindParam(":arquivo", $nome_arquivo);
					$a->bindParam(':user', $_SESSION['idusuario']);
                    $a->bindParam(":observacao", $_POST['observacao']);
					$a->bindParam(":nome_original", $arquivo['name'][$controle]);
					$resultado = $a->execute();
				}

			}
		}
    }

    $db->commit();


    if ($resultado){
        $ret['status'] = 1;
        $ret['mensagem'] = 'Dados inseridos com sucesso!';
    }
    else{
        $ret['status'] = 0;
        $ret['mensagem'] = 'Erro ao inserir';
    }

	echo json_encode($ret);
	
}catch(PDOException  $e){
	//echo $e->getMessage();

    $ret['status'] = 0;
    //$ret['mensagem'] = 'Erro ao inserir';
    $ret['mensagem'] = $e->getMessage();
    echo json_encode($ret);

    $db->rollBack();
}
?>






