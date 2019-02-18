<?php
	require_once"include/header.php";
	/*
	- exibir fotos aprovadas:
	-- criar em miniaturas

	- poder curtir fotos 
	- ordernar fotos pelas mais curtidas.
	-- *validar uma curtida por foto por usuário. ok
	- poder realizar upload de foto
	*/

	$sql = "SELECT COUNT(c.id_foto) as countCurtidas, 
				group_concat(c.curtidor) as curtidores,
				f.id_foto, f.caminho_foto, f.nome_foto, f.aprovada FROM fotos f 
			left join curtidas c on c.id_foto = f.id_foto
			group by f.id_foto
			order by countCurtidas desc";

	$prepara   = mysqli_query($fotografica, $sql);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Administração Fotos</title>
</head>

<style type="text/css">
	.container {
	  position: relative;
	  width: 50%;

	}	
	.divimg {
	  width: 320px;
	  height: 220px;
	  float: left !important;
	  padding-right: 10px;
	}
	.divimg img{
	  width: 320px;
	  height: 220px;
	  border-radius: 50px;
	  padding-top: 10px;
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
						if ($registro->aprovada == 0) { ?>
							<button data-id="<?= $registro->id_foto ?>" class="aprovar btn btn-link btn-sm" name="aprovar">Aprovar</button>
					<?php }?>
				</div>

			<?php } ?>

		</div>
	</div>	
</div>

<?php
require_once "include/footer.php";
?>	

