<?php
require_once "include/header.php";
?>

<?php
// receber dados do formulário de LOGIN
if (isset($_POST['usuario']) && isset($_POST['senha']))  {

	// receber dados
	$usuario 	= $_POST['usuario'];
	$senha   	= $_POST['senha'];
	

	// tempo do cookie
	if (isset($_POST['manter'])) {
		$manter = true;
	} else {
		$manter = false;
	}
	
	// verificar se os campos foram preenchidos
	if ( !empty($usuario) && !empty($senha) ) {

		// verificar se o usuário existe no bando de dados
		$sql = "SELECT count(*) FROM usuarios 
				WHERE nick = '".$usuario."'";

		$prepara = mysqli_query($fotografica,$sql);
		$total   = mysqli_fetch_array($prepara);

		// usuario verificar se houve retorno
		if ($total['count(*)'] > 0) {

			// criptografar senha
			$senha_crypt = hash('sha512', $senha);

			$sql = "SELECT id, nick, nome, senha, admin FROM usuarios WHERE 
							nick = '".$usuario."' AND
							senha = '".$senha_crypt."'";

			$prepara = mysqli_query($fotografica,$sql);
			$registro= mysqli_fetch_array($prepara);	  	
			$total   = mysqli_num_rows($prepara);

			// SENHA | usuário e senha conferem
			if ($total > 0) {

				# COOKIE
				// autenticar / criar sessao

				if ($manter == false) {

					session_destroy();
					session_start();

					$_SESSION['autenticado']	= 'sim';
					$_SESSION['id'] 			= $registro['id'];
					$_SESSION['nome'] 			= $registro['nome'];

				} else {
					//session_destroy();
					//session_start();

					setcookie('autenticado', 	'sim', 				time() + (TEMPO), "/");
					setcookie('id',				$registro['id'], 	time() + (TEMPO), "/");
					setcookie('nome', 			$registro['nome'], 	time() + (TEMPO), "/");
					setcookie('admin', 			$registro['admin'], time() + (TEMPO), "/");					
					
					$_SESSION['autenticado']	= 'sim';
					$_SESSION['id'] 			= $registro['id'];
					$_SESSION['nome'] 			= $registro['nome'];

				}

				// redirect pra index.php
				echo '1';
				if ($registro['admin'] == 1){
					//header("Location: index_admin.php");
					echo '<script>window.location = "index_admin.php";</script>';
				}
				else{
					echo '<script>window.location = "fotos.php";</script>';
					//header("Location: fotos.php");					
				}

			} else {
				echo 'Dados Não Conferem com os Dados do Banco';
			}

		} else {
			echo 'Usuário não existe!';
		}	  
	}
}


?>

