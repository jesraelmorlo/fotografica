<?php
require_once "include/header.php";

// capturar
	if (isset($_POST['adicionar'])) {

		// inicializa variavel de validacao
		$erro     = false;
		$msg_erro = '';

		// pegar os dados
		
		$nome       = addslashes(trim($_POST['nome']));
		$senha      = addslashes(trim($_POST['senha']));
		$usuario	= addslashes(trim($_POST['usuario']));

		# validar dados

		// campos vazios
		if ( empty($nome) || empty($senha) || empty($usuario) ) {
			$erro = true;
			$msg_erro .= "Os campos devem estar preenchidos <br>";
		}

		// verifica se tem NAO erro de validacao
		if ($erro ==  false) {

            $senha_crypt = hash('sha512', $senha);
			// sql (insert)
			$sql = "INSERT INTO usuarios (
										nome,
										nick,
										senha,
										admin
										) 
										VALUES 
										(
										'".$nome."',
										'".$usuario."',
									    '".$senha_crypt."',
									    0
										)";
			if (mysqli_query($fotografica, $sql)) {
				echo '<div class="boxSucesso">Cadastrado com sucesso</div>';
				//header("Location: index.php");					
				echo '<script>window.location = "index.php";</script>';

$nome		 ='';
$senha		 ='';
$usuario 	 ='';
				
			} else {
				echo '<div class="boxErro">Deu pau na kombi ' . $sql . ' </div>';
			}

		# code...
		} else {
			// tem erro
			echo '<div class="boxErro">' . $msg_erro . ' </div>';
		}

	 }else {
		// inicializar as variáveis

$nome 			='';
$senha 			='';
$usuario 		='';

	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
</head>

<style type="text/css">
	.container {
	  position: relative;
	  width: 50%;

	}	
	.divimg {
	  
	  float: left !important;
	  padding-right: 2px;
	}
	.divimg img{
	  width: 320px;
	  height: 220px;
	  border-radius:25px; 


	}

	.divimg .btn {
	  /*position: absolute;*/
	  z-index: 9999;
	  float: right;
	  padding: 13px 26px 35px 0px !important;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  color: white;
	  font-size: 16px;
	  cursor: pointer;
	  border-radius: 5px;
	}
</style>
<body>

<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 formCadastro">
			<form action="#" method="POST">
				<p>
					<h4>Insira Seus Dados Abaixo Para Se Cadastrar</h4>
				</p>
				<p>
					Digite seu Nome:<br>
				<input type="text" class="form-control" name="nome" required placeholder="Digite seu nome...">
				</p>

				<p>
					Digite seu nome de Usuário:<br>
				<input type="text" class="form-control" name="usuario" required placeholder="Digite seu nome de Usuário...">
				</p>

				<p>
					Digite sua Senha:<br>
				<input type="password" class="form-control" name="senha" required placeholder="Digite sua senha...">
				</p>
				<p>
					<input type="submit" class="btn btn-success" id="btnAdicionar" name="adicionar" value="Cadastrar">
				</p>
				<p>
					Possui uma conta?<a href="index.php">Logar</a>
				</p>
			</form>
		</div>
	</div>
</div>

<?php
require_once "include/footer.php";
?>