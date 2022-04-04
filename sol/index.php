<?php
include("../seguranca.php");
if (isset($_SESSION['usuario_novo']) AND $_SESSION['usuario_novo']==1){
	header("location: usuario_novo.php");
	exit;
}

include("ini.php");

?>

           <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
            </h1>

        </section>



<?php
include("rest.php");