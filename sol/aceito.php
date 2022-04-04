<?php


try{
include ("../conecao.php");
include ("../seguranca_sol.php");



$executa = $db->prepare("UPDATE arquivo_job SET tipo=:aprovado WHERE id_arquivo=:id_arquivo");
$executa->bindParam(':id_arquivo', $_post['id_arquivo']);
$executa->bindParam(':aprovado', $_POST['tipo']);


$resultado = $executa->execute();

    if ($resultado){
        $ret['status'] = 1;
        $ret['mensagem'] = 'Dados inseridos com sucesso!';
        $_SESSION['usuario_novo'] = 0;
    }
    else{
        $ret['status'] = 0;
        $ret['mensagem'] = 'Erro ao inserir';
    }

    echo json_encode($ret);
}catch(PDOException  $e){
    echo $e->getMessage();
}
?>
