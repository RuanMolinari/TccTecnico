<?php

session_start();
if (!isset($_SESSION['acesso_liberado']) or $_SESSION['acesso_liberado']<>1){
	header("Location: /ruan/tcc/index.html");
	exit;
}



