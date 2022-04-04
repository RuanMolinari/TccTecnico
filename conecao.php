<?php


$db = new PDO("mysql:host=localhost;dbname=agexcom", 'root', 'root');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


define('dir_base', $_SERVER['DOCUMENT_ROOT'] . '/ruan/tcc/');
define('url_base', 'http://localhost/ruan/tcc/');

function url($url){
	return url . $url;
}

function diretorio($caminho){
	return dir_base . $caminho;
}

function verifica_senha_email($email, $senha){
	
	$explode = explode("@", $email);

	$user = $explode[0];
	
	$mbox = imap_open("{pop3.uniuv.edu.br:993/imap/novalidate-cert/ssl}INBOX", $user, $senha);

    return ($mbox);

}