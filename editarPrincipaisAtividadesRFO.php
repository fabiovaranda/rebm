<?php
 include('importarBibliotecas.php');
?>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script>
			tinymce.init({selector:'textarea'});
	</script>

	<?php
		if (isset($_POST['PrincipaisAtividadesRFO'])){
		//vamos editar!
			include_once 'DataAccess.php';
			$da = new DataAccess();
			$da->updatePrincipaisAtividadesRFO($_POST['PrincipaisAtividadesRFO']);
			echo "<script>alert('Principais Atividades editada com sucesso'); window.location='PrincipaisAtividades1.php'</script>";
		}
	?>
<body>
       <?php
        include('menu.php');
       ?>
<div class="ink-grid">
  <br>
  <h3> <font color="#1A9018"> Editar Principais Atividades </font></h3>
  <div class="column-group">
     <div class="ink-grid">
         <div class="large-30 medium-30 small-30">
             <img src = "img/objetivos1.jpg">.
         </div>
       <div class="large-5 medium-5 small-5">&nbsp;</div>
         <div class="large-65 medium-65 small-65">
			<?php
				include_once 'DataAccess.php';
				$da = new DataAccess();
				$res = $da->getPrincipaisAtividadesRFO();
				$row = mysql_fetch_object($res);
			?>
			<form method='post' action='editarPrincipaisAtividadesRFO.php'>
				<textarea name='PrincipaisAtividadesRFO'><?php echo $row->Texto; ?></textarea>
				<input type='submit' class='ink-button' value='Editar'/>
			</form>
        </div>                    
      </div>
    </div>
 </div>

	   <?php
        include('footer.php');
        ?> 
</body> 