<?php


try{
include ("../conecao.php");
include ("../seguranca_sol.php");



$executa = $db->prepare("UPDATE usuario SET nome=:nome, fone=:fone WHERE idusuario=:idusuario");
$executa->bindParam(':idusuario', $_SESSION['idusuario']);
$executa->bindParam(':nome', $_POST['nome']);
$executa->bindParam(':fone', $_POST['fone']);


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
