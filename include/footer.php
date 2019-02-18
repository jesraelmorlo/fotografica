
</div>
<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">

<script src="./js/jquery.min.js"></script>
<script src="./css/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip()

		$('.curtir').on('click', function(){
			var idFoto = $(this).attr('data-id');
			var idCurtidor = <?php echo (($_SESSION['id'] > 0) ? $_SESSION['id'] : 0) ?>;
			var idBotao = $(this);

			$.ajax({
			    type: "GET",
			    url: "./ajax.php",
			    data: {
			    		idFoto: idFoto,
			    		idCurtidor: idCurtidor, 
			    		acao: 'curtir'
			    },
			    dataType: "json",
			    success: function(result){
			        if (result.deuCerto == 1){
			        	$(idBotao).remove();
			        }
			        window.location = window.location;
			    }
			});			
		});

		$('.aprovar').on('click', function(){
			var idFoto = $(this).attr('data-id');
			var idBotao = $(this);

			$.ajax({
			    type: "GET",
			    url: "./ajax.php",
			    data: {
			    		idFoto: idFoto,
			    		acao: 'aprovar'
			    },
			    dataType: "json",
			    success: function(result){
			        if (result.deuCerto == 1){
			        	$(idBotao).remove();
			        }
			        window.location = window.location;
			    }
			});			
		});


	});
</script>

</body>
</html>