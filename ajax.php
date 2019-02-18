<?php 

require_once "include/config.php";
require_once "include/connect.php";

if (isset($_GET['acao']) && $_GET['acao'] == 'curtir') {
	// inicializa variavel de validacao
	$erro     = false;
	$msg_erro = '';

	// pegar os dados
	$idFoto       = $_GET['idFoto'];
	$idCurtidor   = $_GET['idCurtidor'];	

	// verifica se tem NAO erro de validacao
	if ($erro ==  false) {
		// sql (insert)
		$sql = "INSERT INTO curtidas (
								id_foto,
								curtidor								
								) 
								VALUES 
								(
								".$idFoto.",
								".$idCurtidor.")";
								//var_dump($sql);exit;
		if (mysqli_query($fotografica, $sql)) {
			$arr = array('deuCerto' => 1);
		}	
		else{
			$arr = array('deuCerto' => 0);
		}

		$response = json_encode($arr);
		echo $response;
	}
}
else if (isset($_GET['acao']) && $_GET['acao'] == 'aprovar') {
	// inicializa variavel de validacao
	$erro     = false;
	$msg_erro = '';

	// pegar os dados
	$idFoto       = $_GET['idFoto'];

	// verifica se tem NAO erro de validacao
	if ($erro ==  false) {
		// sql (insert)
		$sql = "UPDATE fotos set aprovada = 1 WHERE id_foto = ".$idFoto;
								//var_dump($sql);exit;
		if (mysqli_query($fotografica, $sql)) {
			$arr = array('deuCerto' => 1);
		}	
		else{
			$arr = array('deuCerto' => 0);
		}

		$response = json_encode($arr);
		echo $response;
	}	
}
?>
