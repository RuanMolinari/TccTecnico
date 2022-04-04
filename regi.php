<?php
include("conecao.php");
?>
<h1>Bem Vindo</h1><br>
		
		<form class="form" action="imap.php" method="POST" id="formulario">
		<label>Digite seu E-mail por Favor</label>
			<input type="text" name="email" placeholder="E-mail" required>
			<input type="password" name="senha" placeholder="Senha" required>
			
		<button type="submit" id="login-button">Login</button>	
			
		</form>