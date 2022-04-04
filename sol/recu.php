<?php
try{
    include("../../seguranca.php");
    include("../../conecao.php");

    $re = não;
  $executa = $db->prepare("UPDATE arquivo_job SET aprovado=:aprovado WHERE id_arquivo=:id_arquivo");
$executa->bindParam(':id_arquivo', $_GET['id_arquivo']);
$executa->bindParam(':aprovado', $re;


$resultado = $executa->execute();

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
    echo $e->getMessage();
}