<?php
function verFormEditarEncaminhamento(){
	include_once('DataAccess.php');
    $da = new DataAccess();
	$idEncaminhamento = $_GET['e'];
	$res = $da->getEncaminhamento($idEncaminhamento);
	$row = mysql_fetch_object($res);
	echo "
		<div class='ink-grid' id='editarEncaminharUtentes' style='display:block; position: relative;'>
			<div style='width:24px; right:30px; top:2px; position: absolute; z-index: 20; '>";?>
				<img src='img/close.png' style='width:24px' title='Fechar' onclick='makeDivEdInvisible()' onmouseover="this.style.cursor='hand'" onmouseout="this.style.cursor='default'" />
			<?php
			echo "</div>
			
			<form class='ink-form' method='post' action='gerirUtentes.php?f=".$_GET['f']."'>
				<legend><h5> <font color='#1A9018'> Editar Diligências Efetuadas de Utente </font></h5></legend>
				<input type='hidden' name='id' value='".$_GET['e']."' />
				<input type='hidden' name='edit_idUtente' value='$row->idUtente' />
				<input type='hidden' name='edit_idTecnico' value='$row->idTecnico' /><br/>
				<input type='text' title='Data' class='ink-datepicker' name='edit_data' value = '".substr($row->data,0,10)."' /><br/><br/>
				<textarea name='edit_observacoes' style='width:100%' title='Observações' placeholder='Observações'>$row->texto</textarea><br/><br/>
				<center>
				<input type='submit' name='buttonEditarEncaminhamento' value='Guardar' class='ink-button green'/><br/>
				</center> 
			</form>
		</div>
	";
}
?>