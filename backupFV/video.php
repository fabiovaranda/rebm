<?php
include('importarBibliotecas.php');
include('menu.php');     
?>  
<div class='showcase'>  
    <div class='ink-grid'>
    
    <h4><font color='#1A9018'>Videos</font></h4>
	<div class="column-group gutters">
		
		<?php
			include_once ('DataAccess.php');
			$da = new DataAccess();
			$res = $da->getVideos();
			while($row = mysql_fetch_object($res)){
				echo "
					<div class='large-50 medium-50 small-100'>
						<h4>$row->nome</h4>
						<iframe width='500' height='315' src='$row->link' frameborder='0' allowfullscreen></iframe>
					</div>
				";
			}
			
		?>
	
	</div>
</div>

</div>
<?php include('footer.php');?>