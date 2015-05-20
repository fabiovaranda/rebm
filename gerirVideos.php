<?php
include('importarBibliotecas.php');
include('menu.php');

if (isset($_POST['nome'])){
	$nome = $_POST['nome'];
	$nome = str_replace("'","´",$nome);
	$link = $_POST['link'];
	include_once('DataAccess.php');
	$da = new DataAccess();
	$da->insertVideo($nome, $link);
	echo "<script>alert('Vídeo inserido com sucesso');</script>";
}else{
	if (isset($_GET['el'])){
		$id = $_GET['el'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$da->deleteVideo($id);
		echo "<script>alert('Vídeo eliminado com sucesso');</script>";
	}
}
?>

<script>
	function confirmarEliminar(){
		return confirm('Tem a certeza que deseja eliminar?');
	}
</script>

<div class='ink-grid'>
	<?php
		echo "
			<h4> <font color='#1A9018'> Vídeos </font><h4>
			<table width='50%' border='0'>
			";
		
		include_once ('DataAccess.php');
		$da = new DataAccess();
		$res = $da->getVideos();
		while($row = mysql_fetch_object($res)){
			echo "
				<tr>
					<td >
						$row->nome [<font size='1'>$row->link</font>]
					</td>
					<td>
						<a href='gerirVideos.php?el=$row->id' onclick='return confirmarEliminar()'><img src='img/delete.png' style='width:20px'/></a>
					</td>
				</tr>
			";
		}
		
		echo "</table><hr/>";
	?>
</div>
<div class='ink-grid'>
    <form class='ink-form' method='post' action='gerirVideos.php'> 
		<fieldset>
		<legend><h4> <font color='#1A9018'> Inserir Vídeo </font><h4></legend>
		<table width='100%' border='0'>
			<tr>
				<td width='20%'>
					<input type='text' style='width:90%' name='nome' placeholder='Nome' required/>  
				</td>
				<td width='70%'>
					<input type='text' style='width:90%' name='link' placeholder='Link' required/>  
				</td>
				<td width='10%'>
					<input type='submit' class='ink-button green' value='Inserir'/>
				</td>
			</tr>
		</table>
		</fieldset>
	</form>
</div>
<?php include('footer.php');?>