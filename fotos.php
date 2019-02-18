<?php
	require_once"include/header.php";
	/*
	- exibir fotos aprovadas:
	-- criar em miniaturas e full screen -> (poder curtir)

	- poder curtir fotos 
	- ordernar fotos pelas mais curtidas.
	-- *validar uma curtida por foto por usuário. ok
	- poder realizar upload de foto
	*/

	$sql = "SELECT COUNT(c.id_foto) as countCurtidas, 
				group_concat(c.curtidor) as curtidores,
				f.id_foto, f.caminho_foto, f.nome_foto FROM fotos f 
			left join curtidas c on c.id_foto = f.id_foto
			WHERE f.aprovada = 1 
			group by f.id_foto
			order by countCurtidas desc";

	$prepara   = mysqli_query($fotografica, $sql);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Fotos</title>
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
	  color: #2ecc71;
	  font-size: 16px;
	  cursor: pointer;
	  border-radius: 5px;
	}
	.divimg .btn:hover {
		color: #2ecc71;
	}	
</style>
<body>


<div class="container">
	<div class="row foto">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<?php while ($registro = mysqli_fetch_object($prepara)) { ?>
				
				<div class="divimg col-sm-12 col-md-12 col-lg-6 col-xl-4">
					<img src="<?= $registro->caminho_foto ?>" data-html="true" data-toggle="tooltip" title="<span><?= $registro->countCurtidas ?> curtida(s)</span>">					
					<?php 
						$curtidores = explode(',', $registro->curtidores);
						if (!(in_array($_SESSION['id'], $curtidores))) { ?>
							<button data-id="<?= $registro->id_foto ?>" class="curtir btn btn-link btn-sm" name="curtir">Curtir</button>
					<?php }?>
				</div>

			<?php } ?>

		</div>
	</div>	
				

	<div class="row foto">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<form method="POST" action="upload.php" id="form-upload" enctype="multipart/form-data">
				<div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<p>Arquivo:</p>
					<input type="file" class="form-control" name="arquivo" id="arquivo">

				</div>
				<br>
				<div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-4">
			    	<button class="btn btn-success" name="upload" id="upload">Upload</button>
			    </div>
			</form>
		</div>
	</div>
</div>

<?php
require_once "include/footer.php";
?>	

