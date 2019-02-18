<?php
	require_once"include/header.php";

	$nomeFoto = rand().'_'. $_FILES['arquivo']['name'];
	$caminhoFoto = "./fotos/";

	if (!(is_dir($caminhoFoto)))
		mkdir($caminhoFoto, 0777, true);

	// Validar a extenção do arquivo, se é JPEG, JPG ou PNG
	$fileExtensions = ['jpeg','jpg','png']; //extensões válidas
	$fileName 		= $_FILES['arquivo']['name'];       //nome
	$fileExtension = explode('.',$fileName);            //extensão
	$fileExtension = end($fileExtension);
	if (!in_array($fileExtension,$fileExtensions)) {

	}
	else{
		move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminhoFoto.$nomeFoto);

		$sql = "INSERT INTO fotos (
								caminho_foto,
								nome_foto,
								usuario_upload
								) 
								VALUES 
								(
								'".$caminhoFoto.$nomeFoto."',
								'".$nomeFoto."',
								".$_SESSION['id'].")";
		mysqli_query($fotografica, $sql);
		//header("Location: fotos.php");
		echo '<script>window.location = "fotos.php";</script>';
	}
?>