<?php
	include('importarBibliotecas.php');

	if (!isset($_SESSION['id']) || $_SESSION['idTiposDePermissoes'] == 3 )
		echo "<script>window.location='index.php'</script>";
?>
<script src='scriptFormUtentes.js'></script>
<script>
	function makeDivVisible(){
		document.getElementById('encaminharUtentes').style.display='block';
	}
	function makeDivInvisible(){
		document.getElementById('encaminharUtentes').style.display='none';
	}
	function makeDivEdInvisible(){
		document.getElementById('editarEncaminharUtentes').style.display='none';
	}
</script>
<?php

include('menu.php');

include('gerirUtentesFormEditarUtente.php');

include('gerirUtentesFormEditarEncaminhamento.php');

include('gerirUtentesPOSTEditarUtente.php');
      
include('gerirUtentesFormPesquisa.php');
	
if (isset($_POST['NIF']) || isset($_GET['n'])){ //pesquisar utentes por NIF
	include_once('DataAccess.php');
	$da = new DataAccess();
	if (isset($_POST['NIF'])){
		$nif = $_POST['NIF'];
		$nome = $_POST['Nome'];
		$idFrontOfficeSinalizador = $_POST['frontoffice'];
		$emailTecnico = $_POST['email'];
		$interesseProfissional = $_POST['interesseProfissional'];
		$escolaridade = $_POST['Escolaridade'];
		$situacaoEmprego = $_POST['situacaoEmprego'];
		$estado = $_POST['estado'];
		$res = $da->getUtentes($nif, $nome, $idFrontOfficeSinalizador, $emailTecnico, $interesseProfissional, $escolaridade, $situacaoEmprego, $estado);
	}else{
		$nif = $_GET['n'];
		$res = $da->getUtenteNIF($nif);
	}
}else{ 
	//pesquisar utente depois de clicar em Encaminhar
	if (isset($_GET['f'])){
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->getUtente($_GET['f']);
	}
	
	//inserir encaminhamento
	if (isset($_POST['buttonInserirEncaminhamentoUtente'])){
		$idUtente = $_POST['idUtente'];
		$idTecnico = $_POST['idTecnico'];
		$data = $_POST['data'];
		$texto = $_POST['observacoes'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$da->inserirEncaminhamento($data, $texto, $idTecnico, $idUtente);
		echo "<script>alert('Diligência inserida com sucesso')</script>";
	}else{
		//editar encaminhamento
		if (isset($_POST['buttonEditarEncaminhamento'])){
			$id = $_POST['id'];
			$idUtente = $_POST['edit_idUtente'];
			$idTecnico = $_POST['edit_idTecnico'];
			$data = $_POST['edit_data'];
			$texto = $_POST['edit_observacoes'];
			include_once('DataAccess.php');
			$da = new DataAccess();
			$da->editarEncaminhamento($id, $data, $texto, $idTecnico, $idUtente);
			echo "<script>alert('Diligência editada com sucesso')</script>";
		}
	}
}
	
if (isset($_POST['NIF']) || isset($_GET['f']) || isset($_GET['n'])){	
	echo "<div class='ink-grid'>
			<table style='width:100%' class='ink-table'>
				<thead>
				<tr>
					<th style='width:25%' align='left'>Nome</th>
					<th style='width:15%' align='left'>Pedido Inicial</th>
					<th style='width:10%' align='left'>Situação</th>
					<th style='width:15%' align='left'>Habilitações</th>
					<th style='width:20%' align='left'>Interesse Profissional</th>						
					<th style='width:15%'></th>
				</tr>
				</thead>
				<tbody>";	
				
	while($row = mysql_fetch_object($res)){			
		if ($row->interesseProfissional1 != -1)
			$nomeIP = $da->getInteresseProfissional($row->interesseProfissional1);			
		else
			$nomeIP = "---";
			
		if ($row->idHabilitacoes != -1)
			$Habilitacao = $da->getHabilitacao($row->idHabilitacoes);			
		else
			$Habilitacao = "---";
		
		$situacaoProfissional="";
		switch ($row->empregado){
			case 1: $situacaoProfissional = "Empregado";
			break;
			case 0: $situacaoProfissional = "Desempregado";
			break;	
		}
				
		if ($row->Estudante == 1){
			if ($situacaoProfissional != "") $situacaoProfissional .= ", ";
			$situacaoProfissional .= "Estudante";
		}
			
		if ($row->outraSituacao == 1){
			if ($situacaoProfissional != "") $situacaoProfissional .= ", ";
			$situacaoProfissional .= "OutraSituacao";
		}
		
		if($situacaoProfissional == "") $situacaoProfissional="---";
		
		$pedidoInicial = "";
		if($row->pedidoInicialEmprego == 1)
			$pedidoInicial = "Emprego";
		if($row->pedidoInicialFormacao == 1){
			if ($pedidoInicial != "")
				$pedidoInicial .= ", Formação";
			else
				$pedidoInicial = "Formação";
		}
		if($row->pedidoInicialOutra == 1){
			if ($pedidoInicial != "")
				$pedidoInicial .= ", Outra";
			else
				$pedidoInicial = "Outra";
		}
			
		echo "<tr>
				<td>
					<a href='gerirUtentes.php?i=$row->a&f=$row->a' title='Detalhes do utente'><img src='img/info.png' style='width:25px'/> 
						<font color='black'>$row->nome</font>
					</a>
				</td>
				<td>$pedidoInicial</td>
				<td>$situacaoProfissional</td>
				<td>$Habilitacao</td>
				<td>$nomeIP</td>
				<td align='right'>
					
					
					";
					if ($row->Email != "")
						echo "<a href='enviarEmail.php?i=$row->id' target='_blank'><img title='Enviar E-mail para utente' src='img/mail.png' style='width:20px'/></a>&nbsp;";
					echo "<a href='gerirUtentes.php?f=$row->a'><img title='Diligências efetuadas' src='img/forward.png' style='width:20px'/></a>
					<br/>";
					if ($row->CV != "")
						echo "<a href='CVs/$row->CV' target='_blank'><img title='Download do CV' src='img/cv.png' style='width:20px'/></a>&nbsp;";
					
					
				echo "
					
					<a href='gerirUtentes.php?d=$row->a' onclick='return confirmarApagarUtente()'><img title='Apagar utente' src='img/delete3.png' style='width:20px'/></a>					
				</td>
			</tr>";
	}
	echo "</tbody>
		  </table>
		</div>";
} 
	
if (isset($_GET['d'])) {
	include_once('DataAccess.php');
	$da = new DataAccess();
	$da -> deleteUtente($_GET['d']);
	
	echo"
	<script>alert('Utente eliminado com sucesso.');</script>";
}
		
include('gerirUtentesResultadosEncaminhamento.php');
		
if(isset($_GET['i'])){
	include_once('DataAccess.php');
	$da = new DataAccess();
	$res = $da->getUtente($_GET['i']);		
	//ver campos do utente!!
	verFormEditarUtente();
}
	
include('footer.php');
?>

	</body>
</html>