<?php
 include('importarBibliotecas.php');
?> 
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script>
			tinymce.init({selector:'textarea'});
	</script>

	<?php
		if (isset($_POST['missao'])){
		//vamos editar!
			include_once 'DataAccess.php';
			$da = new DataAccess();
			$da->updateMissao($_POST['missao']);
			echo "<script>alert('Missão e Visão editada com sucesso'); window.location='missaoevisao.php'</script>";
		}
	?>
	
	
    <body>
        <?php
        include('menu.php');
       ?>
	   <div class="ink-grid">
	     <div class='column-group gutters'>
        <br/>
        <div class='large-50'>
            <h3><font color='#1A9018'>Editar Missão e Visão</font></h3>
        </div>
        <div class='large-30'>&nbsp;</div>
        <div class='large-20 push-right'>
          
        </div>
    </div>
 
  <div class="column-group">
      <div class="ink-grid">   
        <div class="large-30 medium-30 small-30">
            <img src="img/112.jpg">
        </div>
        <div class="large-5 medium-5 small-5">
            &nbsp;
        </div>
        <div class="large-65 medium-65 small-65">
            <?php
				include_once 'DataAccess.php';
				$da = new DataAccess();
				$res = $da->getMissao();
				$row = mysql_fetch_object($res);
			?>
            <form method='post' action='editarMissao.php'>
				<textarea name='missao'><?php echo $row->texto; ?></textarea>
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