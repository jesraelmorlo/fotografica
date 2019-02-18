<?php
	// destruir sessao ativa
    session_destroy();
    // criar sessao nova
    session_start();
     unset($_SESSION['autenticado']);
    // redirecionar pra pagina de login
    //header("Location: index.php");			
    echo '<script>window.location = "index.php";</script>';
?>