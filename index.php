<!DOCTYPE html>
<html>
<head>
	<title>Fotografica</title>
</head>

<style type="text/css">
	
.container{
	text-align: center;
	padding-top: 175px;

}
.menu{
	background-color:#cce6ff;
	border-radius:25px;
}


</style>

<body>


<div class="container">
<div class="row">
	<div class="menu col-8 col-sm-12 col-md-12 col-lg-12 col-xl-12 loginBox">

		<h4> &nbsp; Bem Vindo Usuário 
			<br>
			<small>Preencha os dados abaixo para entrar</small>
		</h4>

		<form name="login" method="POST" action="login.php">
		<p>
		<label>
			Usuário: <br>
			<input type="text" name="usuario" placeholder="Nickname..." required="">
		</label>	
		</p>

		<p>
			<label>
				Senha: <br>
				<input type="password" name="senha" placeholder="Senha..." required>
			</label>
		</p>
		
		<p class="loginzinho text-center">
			Não possui uma conta?
			<a href="cadastro.php">Cadastre-se</a>
		</p>
		<p>
			<input class="col-6 col-sm-6 col-md-5 col-lg-5 col-xl-4" type="submit" name="logar" class="btn" value="Entrar">
		</p>

		</form>
	</div>
</div>

</div>


</body>
</html>

<?php
require_once"include/footer.php";
?>