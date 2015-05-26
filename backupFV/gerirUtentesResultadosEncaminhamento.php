<script>
function confirmarApagarDiligencia(){
	return confirm('Tem a certeza que deseja apagar a diligência?');
}
</script>
<?php
if (isset($_GET['elimD'])){
	$idEncaminhamento = $_GET['elimD'];
	$da->apagarEncaminhamento($idEncaminhamento);
	echo "<script>alert('Diligência eliminada com sucesso')</script>";
}

if (isset($_GET['f']) && !isset($_GET['i'])){
		$res = $da->getEncaminhamentos($_GET['f']);
		echo "<br/><br/><div class='ink-grid'>
				<table style='width:100%' class='ink-table'>
				<thead>
				<tr>
					<th style='width:10%'>Data</th>
					<th style='width:60%'>Texto</th>					
					<th style='width:10%'>Técnico</th>
					<th style='width:10%'>Instituição</th>
					<th style='width:10%'></th>
				</tr>
				</thead>
				<tbody>";	
		if (mysql_num_rows($res) == 0){
			echo "<tr><td colspan='5' align='center'>Sem diligências efetuadas!</td></tr>";
		}else{
			while($row = mysql_fetch_object($res)){
				echo "<tr>
						<td style='width:10%'>".substr($row->data,0,10)."</td>
						<td style='width:60%'>$row->texto</td>
						<td style='width:10%'>$row->TNome</td>
						<td style='width:10%'>$row->FNome</td>
						<td style='width:10%' align='right'>";
						if ($row->idTecnico == $_SESSION['id']){
							echo "<a href='gerirUtentes.php?f=".$row->idUtente."&e=$row->id'>
								<img title='Editar' src='img/edit.png' style='width:25px'/>
							</a>";
							echo "<a href='gerirUtentes.php?f=$row->idUtente&elimD=".$row->id."' onclick='return confirmarApagarDiligencia()'>
								<img title='Apagar diligência' src='img/delete.png' style='width:25px'/>
							</a>";
						}
				   echo "</td>
					</tr>";
			}	
		}		
		echo "
			
			<tr><td colspan='5' align='center'><input type='button' value='Inserir Diligência' class='ink-button green' onclick='makeDivVisible()'/></td></tr>
		</tbody></table>
			</div>
			<div class='ink-grid' id='encaminharUtentes' style='display:none; position: relative;'>
				<div style='width:24px; right:30px; top:2px; position: absolute; z-index: 20; '>";?>
					<img src='img/close.png' style='width:24px' title='Fechar' onclick='makeDivInvisible()' onmouseover="this.style.cursor='hand'" onmouseout="this.style.cursor='default'" />
				<?php
				echo "</div>
				
				<form class='ink-form' method='post' action='gerirUtentes.php?f=".$_GET['f']."'>
					<legend><h5> <font color='#1A9018'> Diligência Efetuada </font></h5></legend>
					<input type='hidden' name='idUtente' value='".$_GET['f']."' />
					<input type='hidden' name='idTecnico' value='".$_SESSION['id']."' /><br/>
					<input type='text' title='Data' class='ink-datepicker' name='data' data-initial-date=getDate() value = '".date('Y-m-d H:i:s')."'/><br/><br/>
					<textarea name='observacoes' style='width:100%' title='Observações' placeholder='Observações'></textarea><br/><br/>
					<center>
					<input type='submit' name='buttonInserirEncaminhamentoUtente' value='Guardar' class='ink-button green'/><br/>
					</center> 
				</form>
			</div>
			";		
		if (isset($_GET['c'])) {
		include_once('DataAccess.php');
		$da = new DataAccess();
		$da -> apagarEncaminhamento($_GET['c']);
		
		echo"
		<script>alert('Diligência eliminada com sucesso.');</script>";
		}
		if (isset($_GET['e']))
			verFormEditarEncaminhamento();
	}
?>