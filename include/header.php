<?php
// inicializar sessao
session_start();
// session_destroy();
// session_start();


require_once "include/config.php";
require_once "include/connect.php";


// VERIFICAR SE NÃO ESTA NA PÁGINA LOGIN
	// retornar endereço da página
	$url 		= $_SERVER['PHP_SELF'];
	// transforma o endereço em vetor, usando / como
	// criterio de separação
	$vetor_url  = explode('/', $url);
	// pegar ultimo dado do vetor
	$pagina 	= end($vetor_url);

	// verifica se esta em qualquer página que não
	// seja a login.php
	if (($pagina != 'login.php') && ($pagina != 'cadastro.php') && ($pagina != 'index.php')) {

		// verifica se NAO esta autenticado

		if (!isset($_COOKIE['autenticado'])) {

			if(!isset($_SESSION['autenticado'])) {

				session_destroy();
				session_start();
				// redireciona pra login.php
				header("Location: index.php");

			}

		} else {
			
			if (isset($_COOKIE['autenticado'])) {
	
				$autenticado = $_COOKIE['autenticado'];
				$id 		 = $_COOKIE['id'];
				$nome 		 = $_COOKIE['nome'];

				session_destroy();
				session_start();

				setcookie('autenticado', 	$autenticado, 		time() + (TEMPO), "/");
				setcookie('id',				$id, 				time() + (TEMPO), "/");
				setcookie('nome', 			$nome, 				time() + (TEMPO), "/");			
			}
		}
	}

	if (isset($_SESSION['autenticado'])) {
		if ($_SESSION['autenticado'] == 'sim') {
			echo "<span> Usuário: ".$_SESSION['nome']."  |</span>&nbsp";
			echo "<a href='logoff.php'>Sair</a>";
		}
	} else {
		if ($pagina != 'cadastro.php')
			echo '<a href="login.php">Login/Cadastro</a>';
	}