<?php
if ( isset ($_POST['buttonEditarUtente']) ){        	    
	
	$id = $_POST['idUtente'];
	$nome = $_POST['nome'];
	$morada = $_POST['morada'];
	$estado = $_POST['estado'];
	$dataNascimento = $_POST['dataNascimento'];
	$dataInscricao = $_POST['dataInscricao'];
	$idConcelho = $_POST['Concelho'];
	$idFreguesia = $_POST['Freguesia'];
	$idHabilitacoes = $_POST['Habilitacoes'];
	$NIF = $_POST['NIF'];
	if ($NIF == ""){
		$NIF = 'NULL';
	}
	$idEstadoCivil = $_POST['EstadoCivil'];
	$idGrupoEtario = $_POST['GrupoEtario'];
	$idSituacaoRegularizada = $_POST['SituacaoRegularizada'];
	$idGenero = $_POST['Genero'];
	$Telemovel = $_POST['Telemovel'];
	$Telefone = $_POST['Telefone'];
	$OutroTelefone = $_POST['OutroTelefone'];
	$Email = $_POST['Email'];
	$Naturalidade = $_POST['Naturalidade'];
	$Nacionalidade = $_POST['Nacionalidade'];
	$ultimaProfissaoExercida = $_POST['ultimaProfissaoExercida'];
	$ultimaProfissaoExercida2 = $_POST['ultimaProfissaoExercida2'];
	$Observacoes = $_POST['Observacoes'];
	
	//$idFrontOfficeSinalizador = $_POST['idFrontOfficeSinal'];
	//$idTecnico = $_SESSION['id'];		
	$interessesProfissionais1 = $_POST['interessesProfissionais1'];
	$interessesProfissionais2 = $_POST['interessesProfissionais2'];
	$interessesProfissionais3 = $_POST['interessesProfissionais3'];
	
	if ($_POST['pedidoInicialEmprego'] == 1)
		$pedidoInicialEmprego = $_POST['pedidoInicialEmprego'];
	else
		$pedidoInicialEmprego = -1;
					
	if ($_POST['pedidoInicialFormacao'] == 1){
		$pedidoInicialFormacaoQual = $_POST['pedidoInicialFormacaoQual'];
		$pedidoInicialFormacao = $_POST['pedidoInicialFormacao'];			
	}else{
		$pedidoInicialFormacao = -1;
		$pedidoInicialFormacaoQual = "";
	}
	
	if ($_POST['pedidoInicialOutra'] == 1){
		$pedidoInicialOutraQual = $_POST['pedidoInicialOutraQual'];
		$pedidoInicialOutra = $_POST['pedidoInicialOutra'];			
	}else{
		$pedidoInicialOutra = -1;
		$pedidoInicialOutraQual = "";			
	}
	
	if ($_POST['empregado'] == 1) $empregado = 1;
	if ($_POST['desempregado'] == 1) $desempregado = 1;
	if ($_POST['estudante'] == 1) $Estudante = 1;
	if ($_POST['outraSituacao'] == 1) $outraSituacao = 1;	
	
	if ($_POST['Telemovel'] == '') $Telemovel = 0;
	if ($_POST['Telefone'] == '') $Telefone = 0;
	if ($_POST['OutroTelefone'] == '') $OutroTelefone = 0;
	if ($_POST['Email'] == '') $Email = '';
	if ($_POST['ultimaProfissaoExercida'] == '') $ultimaProfissaoExercida = '';
	
	if ($empregado == 1){
		switch ($_POST['radioSituacaoEmprego']){
			 case 1: 
				$trabalhadorPrecario = 1;
				$PrestadorDeServicos = 0;
				$TrabalhadorContaOutrem = 0;
			 break;
			 case 2: 
				$trabalhadorPrecario = 0;
				$PrestadorDeServicos = 1;
				$TrabalhadorContaOutrem = 0;
			 break;
			 case 3: 
				$trabalhadorPrecario = 0;
				$PrestadorDeServicos = 0;
				$TrabalhadorContaOutrem = 1;
			 break;
		}
		//divEmpregado
		$EspecificacaoEmprego = $_POST['especificacaoEmprego'] ;
		//divDesempregado
		$semSubsidio = 0;
		$subsidioDesemprego = 0;
		$beneficiarioRSI = 0;
		$outrosSubsidios = 0;
		$QuaisOutrosSubsidios = "";
		$tempoDesempregado = -1;
		
	}else{	
		if ($desempregado == 1){		
			//divEmpregado
			$empregado = 0;
			$trabalhadorPrecario = 0;
			$PrestadorDeServicos = 0;
			$TrabalhadorContaOutrem = 0;
			$EspecificacaoEmprego = "";
			//divDesempregado
			$tempoDesempregado = $_POST['tempoDesempregado'];
			
			switch($_POST['situacaoDesemprego']){
				case 1:
					$semSubsidio = 0;
					$subsidioDesemprego = 1;
					$beneficiarioRSI = 0;
					$outrosSubsidios = 0;
					$QuaisOutrosSubsidios = "";
				break;
				case 2:
					$semSubsidio = 0;
					$subsidioDesemprego = 0;
					$beneficiarioRSI = 1;
					$outrosSubsidios = 0;
					$QuaisOutrosSubsidios = "";
				break;
				case 3:
					$semSubsidio = 0;
					$subsidioDesemprego = 0;
					$beneficiarioRSI = 0;
					$outrosSubsidios = 1;
					$QuaisOutrosSubsidios = $_POST['QuaisOutrosSubsidios'];
				break; 
				case 3:
					$semSubsidio = 1;
					$subsidioDesemprego = 0;
					$beneficiarioRSI = 0;
					$outrosSubsidios = 0;
					$QuaisOutrosSubsidios = '';
				break; 
			}
		}else{
			//se n tiver empregado nem desempregado!
			$empregado = -1;
			$trabalhadorPrecario = 0;
			$PrestadorDeServicos = 0;
			$TrabalhadorContaOutrem = 0;
			$EspecificacaoEmprego = "";
			$tempoDesempregado = -1;
			$semSubsidio = 0;
			$subsidioDesemprego = 0;
			$beneficiarioRSI = 0;
			$outrosSubsidios = 0;
			$QuaisOutrosSubsidios = "";
		}
	}
	
	if ($Estudante == 1)
		$estabelecimentoEnsino = $_POST['estabelecimentoEnsino'];
	else{
		$Estudante = 0;
		$estabelecimentoEnsino = "";
	}
	
	if ($outraSituacao == 1){
		if ($_POST['MedidasAtivasEmprego'] == 1){
			$MedidasAtivasEmprego = 1;
			$qualMedidasAtivasEmprego = $_POST['qualMedidasAtivasEmprego'];
		}else{
			$MedidasAtivasEmprego = 0;
			$qualMedidasAtivasEmprego = '';
		}	
		
		if ($_POST['Voluntariado'] == 1)
			$Voluntariado = 1;
		else
			$Voluntariado = 0;
			
		if ($_POST['FormacaoProfissional'] == 1){
			$FormacaoProfissional = 1;
			$qualFormacaoProfissional = $_POST['qualFormacaoProfissional'];
		}else{
			$FormacaoProfissional = 0;
			$qualFormacaoProfissional = '';
		}
			
		if ($_POST['Biscates'] == 1)
			$Biscates = 1;
		else
			$Biscates = 0;
	}else{
		$outraSituacao = 0;
		$MedidasAtivasEmprego = 0;
		$qualMedidasAtivasEmprego = '';
		$qualFormacaoProfissional = '';
		$Voluntariado = 0;
		$FormacaoProfissional = 0;
		$Biscates = 0;
	}
	
	if ($_POST['CartaDeConducao'] == 1){
		$cartaDeConducao = 1;
		$cartaDeConducaoCategoriaID = $_POST['CategoriaCarta'];
	}
	else{
		$cartaDeConducao = 0;
		$cartaDeConducaoCategoriaID = -1;
	}	
	
	if( $_POST['InscritoCentroEmprego'] == 1 ){
		$InscritoCentroEmprego = 1;
		$NumeroInscricaoCentroEmprego = $_POST['NumeroInscricaoCentroEmprego'];
	}else{
		$InscritoCentroEmprego = 0 ;
		$NumeroInscricaoCentroEmprego = "";
	}
	
	if ( $_POST['NISS'] == "")
		$NISS = -1;
	else 
		$NISS = $_POST['NISS'];
		
	if ( $_POST['tipoDocumentoIdentificacao'] == -1 )
	{
		$tipoDocumentoIdentificacao = -1;
		$numeroIdentificacao = -1;
	}
	else{
		$tipoDocumentoIdentificacao = $_POST['tipoDocumentoIdentificacao'];
		$numeroIdentificacao = $_POST['numIdentificacao'];
	}
		
	include_once('DataAccess.php');
	$da = new DataAccess();        
	
	$atualizado = $da->updateUtentes($id, $nome, $dataNascimento, $dataInscricao, $idConcelho, $idFreguesia, $idHabilitacoes, $NIF, $idEstadoCivil, 
	$trabalhadorPrecario, $PrestadorDeServicos, $TrabalhadorContaOutrem, $ultimaProfissaoExercida, $semSubsidio,
	$subsidioDesemprego, $EspecificacaoEmprego, $tempoDesempregado, $ultimaProfissaoExercida2, $beneficiarioRSI, $outrosSubsidios, $QuaisOutrosSubsidios, 
	$Estudante, $estabelecimentoEnsino, $idGrupoEtario,
	$idSituacaoRegularizada, $idGenero, $MedidasAtivasEmprego, $qualMedidasAtivasEmprego, $Voluntariado, $FormacaoProfissional, $qualFormacaoProfissional,
	$Biscates, $Telemovel, 
	$Telefone, $OutroTelefone, $Email, $Naturalidade, $Nacionalidade, $InscritoCentroEmprego, $NumeroInscricaoCentroEmprego,
	$Observacoes, $cartaDeConducao, $cartaDeConducaoCategoriaID, $interessesProfissionais1, $interessesProfissionais2, 
	$interessesProfissionais3, $empregado, $outraSituacao, $morada, $estado, $pedidoInicialEmprego, $pedidoInicialFormacao, $pedidoInicialFormacaoQual, 
	$pedidoInicialOutra, $pedidoInicialOutraQual, $NISS, $tipoDocumentoIdentificacao, $numeroIdentificacao);
	
	if ($atualizado == -1)
		echo "<script> alert('Erro. NIF já se encontra registado noutro utente.'); </script>";
	else{
		//tratamento do ficheiro de CV		
		if ($_FILES['file']['tmp_name'] != ""){
			//echo "<script>alert('Existe CV!')</script>";
			$nome = $id.".pdf";
			move_uploaded_file($_FILES['file']['tmp_name'], "CVs/".$nome);
			$da->updateCVUtente($id, $nome);
		}
		
		echo "<script> alert('Editado com sucesso'); </script>";
	}
}
?>