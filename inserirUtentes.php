<?php include('importarBibliotecas.php'); ?>
<script src='scriptFormUtentes.js'></script>
<?php include('menu.php'); ?>
<br/>
<?php
	
	if ( isset ($_POST['nome']) ){     
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
		
		$idFrontOfficeSinalizador = $_POST['idFrontOffice'];
		$idTecnico = $_SESSION['id'];		
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
			$EspecificacaoEmprego = $_POST['especificacaoEmprego'] ;
			
			$semSubsidio = 0;
			$subsidioDesemprego = 0;
			$beneficiarioRSI = 0;
			$outrosSubsidios = 0;
			$QuaisOutrosSubsidios = "";
			$tempoDesempregado = -1;
		}else{
			if ($desempregado == 1){
				$empregado = 0;
				$trabalhadorPrecario = 0;
				$PrestadorDeServicos = 0;
				$TrabalhadorContaOutrem = 0;
				$EspecificacaoEmprego = "";
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
					case 4:
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
		
		if ($_POST['NISS'] == '')
			$NISS = -1;
		else
			$NISS = $_POST['NISS'];
		
		if ($_POST['tipoDocumentoIdentificacao'] != -1)
		{
			$tipoDocumentoIdentificacao = $_POST['tipoDocumentoIdentificacao'];
			$numIdentificacao = $_POST['numIdentificacao'];
		}
		else{
			$tipoDocumentoIdentificacao = -1;
			$numIdentificacao = -1;
		}
        include_once('DataAccess.php');
        $da = new DataAccess();
        
		$inserido = $id = $da->inserirUtentes($nome, $dataNascimento, $dataInscricao, $idConcelho, $idFreguesia, $idHabilitacoes, $NIF, $idEstadoCivil, 
		$trabalhadorPrecario,
		$PrestadorDeServicos, $TrabalhadorContaOutrem, $ultimaProfissaoExercida, $semSubsidio, $subsidioDesemprego, $EspecificacaoEmprego,
		$tempoDesempregado, $ultimaProfissaoExercida2, $beneficiarioRSI, $outrosSubsidios, $QuaisOutrosSubsidios, 
		$Estudante, $estabelecimentoEnsino, $idGrupoEtario,
		$idSituacaoRegularizada, $idGenero, $MedidasAtivasEmprego, $qualMedidasAtivasEmprego, $Voluntariado, $FormacaoProfissional, $qualFormacaoProfissional, 
		$Biscates, $Telemovel, 
		$Telefone, $OutroTelefone, $Email, $Naturalidade, $Nacionalidade, $InscritoCentroEmprego, $NumeroInscricaoCentroEmprego,
		$Observacoes, $idFrontOfficeSinalizador, $idTecnico, $cartaDeConducao, $cartaDeConducaoCategoriaID, $interessesProfissionais1, 
		$interessesProfissionais2, $interessesProfissionais3, $empregado, $outraSituacao, $morada, $estado, $pedidoInicialEmprego, $pedidoInicialFormacao, 
		$pedidoInicialFormacaoQual, $pedidoInicialOutra, $pedidoInicialOutraQual, $NISS, $tipoDocumentoIdentificacao, $numIdentificacao);  
		
		if ($inserido == -1)
			echo "<script>
			alert('Erro. NIF já registado noutro utente.');
			window.location='gerirUtentes.php?n=".$NIF."';
			</script>";
		else{
			//tratamento do ficheiro de CV		
			if (isset($_FILES['file']['tmp_name'])){
				//echo "<script>alert('Existe CV!')</script>";
				$nome = $id.".pdf";
				move_uploaded_file($_FILES['file']['tmp_name'], "CVs/".$nome);
				$da->updateCVUtente($id, $nome);
			}
			/*****************************/
			echo "<script>
			alert('Inserido com sucesso');
			window.location='inserirUtentes.php';
			</script>";
		}
    }
	
	//pesquisar por NIF antes de tentar inserir utente
	if(isset($_SESSION['id']) && !isset($_POST['NIF'])){
		echo "
		<div class='ink-grid'>
			<form class='ink-form' method='post' action='' id='formNIF' onsubmit='return verificarNumDigits()'>
				<h3><font color='#1A9018'>Inserir Utente</font></h3>
				<table width = '100%'>
					<tr>
						<td>
							<label>NIF</label>
							<input type='text' name='NIF' id='NIFS' onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/> 
							<input type='submit' class='ink-button green' value='Pesquisar Utente'>   
							<a href='inserirUtentes.php?sn=1' class='ink-button'>Inserir Utente sem NIF</a>  
						</td>	
					</tr>
					
				</table>
			</form>
		</div>
		";
	}
	
	//mostrar todos os campos para inserir novo utente
	if(isset($_SESSION['id']) && (isset($_POST['NIF']) || isset($_GET['sn']))){
		include_once('DataAccess.php');
		$da = new DataAccess();
		
		if (isset($_POST['NIF'])){
			$res = $da->getUtenteNIF($_POST['NIF']);		
			if(mysql_num_rows($res)>0)
				echo "<script>window.location='gerirUtentes.php?n=".$_POST['NIF']."'</script>";
			$nif = $_POST['NIF'];
		}else
			$nif = '';
		
        echo "
        <div class='ink-grid'>
			<form class='ink-form' method='post' action='inserirUtentes.php' id='formInserirUtente' enctype='multipart/form-data'>
			<legend><h4> <font color='#1A9018'> Inserir Utente </font><h4></legend>			
			<fieldset>
				<table style='width:100%;  border-collapse:separate; border-spacing:0 5px;' >
					<tr>
						<td width='10%'></td>
						<td width='10%'></td>
						<td width='10%'></td>
						<td width='10%'></td>
						<td width='10%'></td>
						<td width='10%'></td>
						<td width='10%'></td>
						<td width='10%'></td>
						<td width='10%'></td>
						<td width='10%'></td>
					</tr>
					<tr bgcolor='#C8C8C8' style='border-style: solid; border-width: 1px; border-color: gray;'>
						<td><label>Pedido Inicial</label></td>
						<td>
							<input type='checkbox' id='pedidoInicialEmprego' name='pedidoInicialEmprego' value='1'/>
							<label for='pedidoInicialEmprego'>Emprego</label>
						</td>
						<td align='right'>
							<input type='checkbox' id='pedidoInicialFormacao' name='pedidoInicialFormacao' value='1' onclick='verificarTxtPIF()'/>
							<label for='pedidoInicialFormacao'>Formação</label>
						</td>
						<td colspan='3'>
							<input type='text' name='pedidoInicialFormacaoQual' id='pedidoInicialFormacaoQual' style='width:95%' disabled placeholder='Qual?'/>
						</td>
						<td align='right'>
							<input type='checkbox' id='pedidoInicialOutra' name='pedidoInicialOutra' value='1' onclick='verificarTxtPIO()'/>
							<label for='pedidoInicialOutra'>Outra</label>
						</td>
						<td colspan='3'>							
							<input type='text' name='pedidoInicialOutraQual' id='pedidoInicialOutraQual' style='width:95%' disabled placeholder='Qual?'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>NIF</label>
						</td>
						<td colspan='2'>
							<input type='text' name='NIF' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='width:90%' value='".$nif."'/> 
						</td>
						<td colspan='3'>
							<label>Data de Inscrição</label>
							<input type='text' name='dataInscricao' class='ink-datepicker' id='dataInscricao'  data-initial-date=getDate() value = '".date('Y-m-d H:i:s')."' required/> 
						</td>
						<td colspan='6' align='right'>
							<label>Estado</label>
							<select name='estado'>";
								$resEU = $da->getEstadosUtentes();
								while($rowEU = mysql_fetch_object($resEU)){
									echo "<option value='$rowEU->id'>$rowEU->estado</option>";
								}
							echo "</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>NISS</label>
						</td>
						<td colspan='2'>
							<input type='text' name='NISS' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='width:90%'/> 
						</td>
						<td colspan='4'>
							<label>Tipo de documento de identificação</label>
							<select name='tipoDocumentoIdentificacao' style='width:40%' onchange='verificarDI(this.value)'>
								<option value = '-1'></option>";
								$resDI = $da->getTiposDocumentos();
								while ($rowDI = mysql_fetch_object($resDI)){
									echo  "<option value='$rowDI->id'>$rowDI->tipo</option>";
									}
							echo"</select>
						</td>
						<td colspan='4'>
							<label>Número de Identificação</label>
							<input type='text' name='numIdentificacao' id='numIdentificacao' style='width:45%' disabled/> 
						</td>
					<tr/>
					
					<tr>
						<td>
							<label>Nome</label>
						</td>
						<td colspan='4'>
							<input type='text'  style='width:100%' name='nome' required/>
						</td>
						<td align='right'>
							<label>Morada</label>
						</td>
						<td colspan='4'>
							<input type='text'  style='width:99%' name='morada'/>
						</td>
					</tr>					
					<tr>
						<td>
							<label>Concelho</label>	
						</td>
						<td colspan='2'>					
								<select name='Concelho' style='width:90%'>
									<option value='-1'></option>
									<option value='1'>Barreiro</option>
									<option value='2'>Moita</option>
									<option value='3'>Outro</option>
								</select>
						</td>
						<td colspan='4'>
							<label>Freguesia</label>
							<select name='Freguesia' style='width:73%'>
								<option value='-1'></option>
								<option value='1'>Alto Seixalinho, Santo André e Verderena</option>
								<option value='2'>Barreiro e Lavradio</option>
								<option value='3'>Palhais e Coina</option>
								<option value='4'>Santo António da Charneca</option>
								<option value='5'>Alhos Vedros</option>
								<option value='6'>Baixa da Banheira</option>
								<option value='7'>Gaio-Rosário</option>
								<option value='8'>Moita</option>
								<option value='9'>Sarilhos Pequenos</option>
								<option value='10'>Vale da Amoreira</option>
							</select>
						</td>
						<td colspan='3'>
							<label>Data de Nascimento</label>
							<input type='text' name='dataNascimento' class='ink-datepicker' style='width:55%'  placeholder='aaaa-mm-dd'/> 
						</td>
					</tr>
					<tr>
						<td>
							<label>Género</label>
						</td>
						<td colspan='2'>
							<select name='Genero' style='width:90%'>
								<option value='-1'></option>
								<option value='2'>Masculino</option>
								<option value='1'>Feminino</option>
							</select> 
						</td>
						<td colspan='3'>
								<label>Estado Civil</label>
								<select name='EstadoCivil' style='width:60%' >
									<option value='-1'></option>
									<option value='1'>Solteiro</option>
									<option value='2'>Casado</option>
									<option value='3'>Viúvo</option>
									<option value='4'>Divorciado</option>
									<option value='5'>Comunhão</option>
								</select>
						</td>
						<td colspan='4'>
							<label>Habilitações (último ciclo completo)</label>
							<select name='Habilitacoes' style='width:41%' >
								<option value='-1'></option>
								<option value='1'><4º ano</option>
								<option value='2'>1º ciclo</option>
								<option value='3'>2º ciclo</option>
								<option value='4'>3º ciclo</option>
								<option value='5'>Ensino Secundário</option>
								<option value='6'>Ensino Superior</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>Grupo Etário</label>
						</td>
						<td colspan='2'>
							<select name='GrupoEtario' style='width:90%'>
								<option value='-1'></option>
								<option value='1'><15</option>
								<option value='2'>15-19</option>
								<option value='3'>20-24</option>
								<option value='4'>25-34</option>
								<option value='5'>35-44</option>
								<option value='6'>45-54</option>
								<option value='7'>55-64</option>
								<option value='8'>>65</option>
							</select>
						</td>
						<td colspan='4'>
							<label>Naturalidade</label>
							<input type='text' style='width:68%' name='Naturalidade' />
						</td>
						<td colspan='3'>
							<label>Nacionalidade</label>
							<input type='text' style='width:68%' name='Nacionalidade' />	
						</td>
					</tr>
					<tr>
						<td>
							<label>Telemóvel</label>
						</td>
						<td colspan='2'>
							<input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='width:90%' name='Telemovel'/>  
						</td>
						<td colspan='4'>	
							<label>Telefone</label>
							<input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57'  name='Telefone' style='width:36%'/>&nbsp;
							<input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='OutroTelefone' style='width:37%' placeholder='Outro Telefone'/>
						</td>
						<td colspan='3'>
							<label>Email</label>
							<input type='text' style='width:87%'  name='Email'/>  
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<label>Situação no País Regularizada</label>
						</td>
						<td colspan='1'>
							<select name='SituacaoRegularizada' style='width:80%'>
								<option value='-1'></option>
								<option value='1'>Sim</option>
								<option value='2'>Não</option>
							</select> 
						</td>
						<td colspan='4'>
							<label>Inscrito Centro de Emprego</label>
								<select name='InscritoCentroEmprego' style='width:15%' onchange='verificarICE(this.value)'>
									<option value='-1'></option>
									<option value='1'>Sim</option>
									<option value='2'>Não</option>
								</select> 
								<input type='text' id='NumeroInscricaoCentroEmprego' name='NumeroInscricaoCentroEmprego' style='width:29%' placeholder='N.º Inscrição CE' disabled/>
						</td>
						<td colspan='4'>
							<label>Carta de Condução</label>
								<select name='CartaDeConducao' style='width:25%' onchange='verificarCarta(this.value)'>
									<option value='-1'></option>
									<option value='1'>Sim</option>
									<option value='2'>Não</option>
								</select> 
								";
								
								$res = $da->getCategoriasCartaConducao();
								echo"<select name='CategoriaCarta' id='CategoriaCarta' style='width:32%' disabled>
									<option value='-1'>Categoria</option>
										";
										while($row = mysql_fetch_object($res)){
											echo "<option value='".$row->id."'>".$row->categoria."</option>";
										}
									echo"
									</select>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<label>Última Profissão Exercida</label>
						</td>
						<td colspan='5'>
							<select name='ultimaProfissaoExercida2' title='Área Profissional' style='width:92%'>
								<option value='-1'></option>";
								$resIP = $da->getInteressesProfissionais();
								while($rowIP = mysql_fetch_object($resIP)){
									echo "<option value=$rowIP->id>$rowIP->interesseProfissional</option>";
								}
					  echo "</select>
						</td>
						<td colspan='5'>
							<input type='text' placeholder='Qual?' style='width:100%' name='ultimaProfissaoExercida'/>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<label>Situação Face ao Emprego</label>
						</td>
						<td colspan='5'>
							<ul>
								<li style='display: inline;'>
									<input type='checkbox' id='empregado' name='empregado' value='1' onclick='verificarSFE()' />
									<label for='empregado'>Empregado</label>
								</li>
								<li style='display: inline; margin-left: 1em;'>
									<input type='checkbox' id='desempregado' name='desempregado' value='1' onclick='verificarSFE()' />
									<label for='desempregado'>Desempregado</label>
								</li>
								<li style='display: inline; margin-left: 1em;'>
									<input type='checkbox' id='estudante' name='estudante' value='1' onclick='verificarSFE()' />
									<label for='estudante'>Estudante</label>
								</li>
								<li style='display: inline; margin-left: 1em;'>
									<input type='checkbox' id='outraSituacao' name='outraSituacao' value='1' onclick='verificarSFE()' />
									<label for='outraSituacao'>Outra Situação</label>
								</li>
							</ul>
						</td>
					
					</tr>
					<tr>
						<td colspan='10'>
							<div class='highlight' id='divEmpregado' name='divEmpregado' style='display:none'>
								<label>Empregado</label><br/>
									<table style='width:100%;  border-collapse:separate; border-spacing:0 5px;' >
										<tr>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
										</tr>
										<tr>
											<td colspan='6'>
											<ul>
												<li style='display: inline;'>
													<label>
														<input type='radio' id='radioSituacaoEmprego' name='radioSituacaoEmprego' value='1' checked>
														Trabalhador Precário
													</label>
												</li>
												<li style='display: inline; margin-left: 1em;'>
													<label>
														<input type='radio' id='radioSituacaoEmprego' name='radioSituacaoEmprego' value='2' >
														Prestador de Serviços
													</label>
												</li>
												<li style='display: inline; margin-left: 1em;'>
													<label>
														<input type='radio' id='radioSituacaoEmprego' name='radioSituacaoEmprego' value='3' >
														Trabalhador por conta de outrém
													</label>
												</li>
											</ul>
											</td>
											<td colspan='4'>
												<select name='especificacaoEmprego' title='Especificação Área Profissional' style='width:90%'>
													<option value='-1'></option>";
													$resIP = $da->getInteressesProfissionais();
													while($row = mysql_fetch_object($resIP)){
														echo "<option value=$row->id>$row->interesseProfissional</option>";
													}
										  echo "</select>
											</td>
										</tr>
									</table>
						</td>
					<tr>
						<td colspan='10'>
							<div class='highlight' id='divDesempregado' name='divDesempregado' style='display:none'>
									<table style='width:100%;  border-collapse:separate; border-spacing:0 5px;' >
										<tr>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
										</tr>
										<tr>
											<td colspan='5'>
												<label>Desempregado há</label>
												<select name='tempoDesempregado' id='tempoDesempregado'>";
													$resDD = $da->getDesempregadoDesde();
													while($rowDD = mysql_fetch_object($resDD)){
														echo "<option value='$rowDD->id'>$rowDD->tempo</option>";
													}
										  echo "</select>
											</td>
										</tr>
										<tr>
											<td colspan='6'>
												<ul>
													<li style='display: inline;'>
														<label>
															<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='4' checked onclick='verificarD(this)' />
															Sem Subsídio
														</label>
													</li>
													<li style='display: inline;'>
														<label>
															<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='1' onclick='verificarD(this)' />
															Subsídio de Desemprego
														</label>
													</li>
													<li style='display: inline; margin-left: 1em;'>
														<label>
															<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='2' onclick='verificarD(this)' />
															Beneficiário RSI
														</label>
													</li>
													<li style='display: inline; margin-left: 1em;'>
														<label>
															<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='3' onclick='verificarD(this)' />
															Outros Subsídios
														</label>
													</li>
												</ul>
											</td>
											<td colspan='4'>
											<input type='text' style='width:90%'  id='QuaisOutrosSubsidios' name='QuaisOutrosSubsidios' placeholder='Quais outros subsídios?' disabled/>
											</td>
										</tr>
									</table>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan='10'>
							<div class='highlight' id='divEstudante' name='divEstudante' style='display:none'>
								<label>Estudante</label><br/>
									<table style='width:100%;  border-collapse:separate; border-spacing:0 5px;' >
										<tr>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
											<td width='10%'></td>
										</tr>
										<tr>
											<td colspan='10'>
												<input type='text' style='width:60%'  id='estabelecimentoEnsino' name='estabelecimentoEnsino' placeholder='Estabelecimento de Ensino' />
											</td>
										</tr>
									</table>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan='10'>
							<div class='highlight' id='divOutraSituacao' name='divOutraSituacao' style='display:none'>
								<label>Outra Situação</label><br/>
								<ul style='list-style-type: none;'>
									<li>
										<input type='checkbox' id='os4' name='Biscates' value='1' />
											<label for='os4'>Biscates</label>
									</li>
									<li>
										<input type='checkbox' id='os2' name='Voluntariado' value='1' />
											<label for='os2'>Voluntariado</label>
									</li>
									<li >
										<input type='checkbox' id='os1' name='FormacaoProfissional' value='1' onclick='enableFormacaoProfissional()'/>
										<label for='os1'>Formação Profissional</label>
										<input type='text' name='qualFormacaoProfissional' id='qualFormacaoProfissional' style='width:95%' disabled placeholder='Qual?'/>
									</li>									
									<li>
										<input type='checkbox' id='os3' name='MedidasAtivasEmprego' value='1' onclick='enableMedidasAtivasEmprego()'/>
										<label for='os3'>Medidas Ativas de Emprego</label>
										<input type='text' name='qualMedidasAtivasEmprego' id='qualMedidasAtivasEmprego' style='width:95%' disabled placeholder='Qual?'/>
									</li>
									
								</ul>
							</div>
						</td>
					</tr>
					 
					
					
					<tr>
						<td colspan='1'>
							<label>
								Interesses Profissionais
							</label>
						</td>
						<td colspan='3'>
							<label>1ª Escolha</label>
												<select name='interessesProfissionais1' title='1ª Escolha' style='width:80%'>
													<option value='-1'></option>";
													$resIP = $da->getInteressesProfissionais();
													while($row = mysql_fetch_object($resIP)){
														echo "<option value=$row->id>$row->interesseProfissional</option>";
													}
										  echo "</select>
						</td>
						<td colspan='3'>
							<label>2ª Escolha</label>
												<select name='interessesProfissionais2' title='2ª Escolha' style='width:80%'>
													<option value='-1'></option>";
													$resIP = $da->getInteressesProfissionais();
													while($row = mysql_fetch_object($resIP)){
														echo "<option value=$row->id>$row->interesseProfissional</option>";
													}
										  echo "</select>
						</td>
						<td colspan='3'>
							<label>3ª Escolha</label>
												<select name='interessesProfissionais3' title='3ª Escolha' style='width:100%'>
													<option value='-1'></option>";
													$resIP = $da->getInteressesProfissionais();
													while($row = mysql_fetch_object($resIP)){
														echo "<option value=$row->id>$row->interesseProfissional</option>";
													}
										  echo "</select>
						</td>
					</tr>
					<tr>
						<td colspan='10'>
							<label>Observações</label>
						</td>
					</tr>
					<tr>
						<td colspan='10'>
							<textarea name='Observacoes' cols='50' rows='5' style='width: 100%'></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<label>Anexar CV</label>
						</td>
						<td colspan='10'>
							<input type='file' name='file' class='ink-button' accept='application/pdf' />
						</td>
					</tr>
					<tr>
						<td colspan='2'><br/>
							<label>Front Office Sinalizador</label>
						</td>
						<td colspan='2'><br/>";
						$da = new DataAccess();
						$resFO = $da -> getFrontOfficeSinalizador($_SESSION['id']);
						$rowFO = mysql_fetch_object($resFO);
						echo"
							<input type='text' style='width:80%' name='FrontOfficeSinalizador' value='".$rowFO->FNome."' disabled/>
							<input type='hidden' name='idFrontOffice' value='$rowFO->FID'/>
						</td>
						<td colspan='4'>
							<br/>
							<label>Nome do técnico</label>
							<input type='text' style='width:37%' name='NomeTecnico' value='".$rowFO->TNome."' disabled/>
						</td>
					</tr>
					<tr>
						<td colspan='10'>
						<br/>
							<input type='submit' class='ink-button green' value='Inserir Utente' />
						</td>
					</tr>
				</table>
			</fieldset>
			</form>
        </div>";
      }


?>

<?php include('footer.php'); ?>
<script>
	document.getElementById('dataInscricao').value = new Date().toDateInputValue();
</script>
</body>
</html>