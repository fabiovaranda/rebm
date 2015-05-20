<html>
	<head>
		<title>Inserir Produto</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="foundation/css/foundation.css" />
		<script src="foundation/js/vendor/modernizr.js"></script>
	</head>
	<body>
		<div class='row'>
			<div class='large-4 panel columns'>
				<form method='post' action='index2.php'>
				<div class='row'>
					<div class='large-12 columns'>
						Nome: <input type='text' name='nomeProduto' required/>
					</div>
				</div>
				<div class='row'>
					<div class='large-12 columns'>
						Preço: <input type='text' placeholder='Preço' name='precoProduto' required/>
					</div>
				</div>
				<div class='row'>
					<div class='large-12 columns'>
						Quantidade: <input type='text' name='quantidadeProduto'/>
					</div>
				</div>
				<div class='row'>
					<div class='large-6 large-centered columns'>
						<input type='submit' class='medium secondary button' value='Inserir' />
					</div>
				</div>
				</form>
				
			</div>
			
		</div>
		
		
		
		
		
		<?php
			if (isset($_POST['precoProduto'])){
				//formulário foi submetido
				$nomeProduto = $_POST['nomeProduto'];
				$precoProduto = $_POST['precoProduto'];
				$quantidadeProduto = $_POST['quantidadeProduto'];
				echo $nomeProduto." ".$precoProduto." ".$quantidadeProduto;
			}
		?>
		<script src="foundation/js/vendor/jquery.js"></script>
		<script src="foundation/js/foundation.min.js"></script>
		<script>
		  $(document).foundation();
		</script>
	</body>
</html>