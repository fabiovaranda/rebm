<?php
	include('importarBibliotecas.php');
?>
<?php

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

function verFormEditarUtente(){
	include_once('DataAccess.php');
	$da = new DataAccess();
	$res = $da->getUtente($_GET['i']);
	$row = mysql_fetch_object($res);
	echo "<br/>
	<div class='ink-grid'>
			<form class='ink-form' method='post' action='gerirUtentes.php?i=".$_GET['i']."' id='formUtente' onSubmit='return validarFormulario()' enctype='multipart/form-data'>
			<legend><h4> <font color='#1A9018'> Utente </font><h4></legend>			
			<fieldset>
				<input type='hidden' name='idUtente' value='".$_GET['i']."'/>
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
						<td>";
							if ($row->pedidoInicialEmprego == 1)
								echo "<input type='checkbox' id='pedidoInicialEmprego' name='pedidoInicialEmprego' value='1' checked/>";
							else		
								echo "<input type='checkbox' id='pedidoInicialEmprego' name='pedidoInicialEmprego' value='1'/>";
							echo "<label for='pedidoInicialEmprego'>Emprego</label>
						</td>
						<td align='right'>";
							if ($row->pedidoInicialFormacao == 1)
								echo "<input type='checkbox' id='pedidoInicialFormacao' name='pedidoInicialFormacao' value='1' onclick='verificarTxtPIF()' checked/>";
							else
								echo "<input type='checkbox' id='pedidoInicialFormacao' name='pedidoInicialFormacao' value='1' onclick='verificarTxtPIF()'/>";
							echo "<label for='pedidoInicialFormacao'>Formação</label>
						</td>
						<td colspan='3'>";
							if ($row->pedidoInicialFormacao == 1)
								echo "<input type='text' name='pedidoInicialFormacaoQual' id='pedidoInicialFormacaoQual' style='width:95%' value='$row->pedidoInicialFormacaoQual' placeholder='Qual?'/>";
							else
								echo "<input type='text' name='pedidoInicialFormacaoQual' id='pedidoInicialFormacaoQual' style='width:95%' disabled placeholder='Qual?'/>";
						echo "
						</td>
						<td align='right'>";
							if ($row->pedidoInicialOutra == 1)
								echo "<input type='checkbox' id='pedidoInicialOutra' name='pedidoInicialOutra' value='1' onclick='verificarTxtPIO()' checked/>";
							else
								echo "<input type='checkbox' id='pedidoInicialOutra' name='pedidoInicialOutra' value='1' onclick='verificarTxtPIO()'/>";
							echo "<label for='pedidoInicialOutra'>Outra</label>
						</td>
						<td colspan='3'>";							
							if ($row->pedidoInicialOutra == 1)
								echo "<input type='text' name='pedidoInicialOutraQual' id='pedidoInicialOutraQual' style='width:95%' value='$row->pedidoInicialOutraQual' placeholder='Qual?'/>";
							else
								echo "<input type='text' name='pedidoInicialOutraQual' id='pedidoInicialOutraQual' style='width:95%' disabled placeholder='Qual?'/>";
						echo "
						</td>
					</tr>
					<tr>
						<td>
							<label>NIF</label>
						</td>
						<td colspan='2'>
							<input type='text' name='NIF' onkeypress='return event.charCode >= 48 && event.charCode <= 57' id='NIF' style='width:90%' required value='$row->NIF'/> 
						</td>
						<td colspan='3'>
							<label>Data de Inscrição</label>
							<input type='text' name='dataInscricao' class='ink-datepicker' id='dataInscricao' required value='".substr($row->dataInscricao,0,10)."'/> 
						</td>
						<td colspan='6' align='right'>
							<label>Estado</label>
							<select name='estado'>";
								$resEU = $da->getEstadosUtentes();
								while($rowEU = mysql_fetch_object($resEU)){
									if ($row->estado == $rowEU->id)
										echo "<option value='$rowEU->id' selected>$rowEU->estado</option>";
									else
										echo "<option value='$rowEU->id'>$rowEU->estado</option>";
								}
							echo "</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>Nome</label>
						</td>
						<td colspan='4'>
							<input type='text'  style='width:100%' name='nome' required value='$row->nome'/>
						</td>
						<td align='right'>
							<label>Morada</label>
						</td>
						<td colspan='4'>
							<input type='text'  style='width:100%' name='morada' value='$row->morada'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Concelho</label>	
						</td>
						<td colspan='2'>					
								<select name='Concelho' style='width:90%'>
									<option value='-1'></option>";
									$resConc = $da->getConcelhos();
									while($rowConc = mysql_fetch_object($resConc)){
										if ($row->idConcelho == $rowConc->id)
											echo "<option value='$rowConc->id' selected>$rowConc->concelho</option>";
										else
											echo "<option value='$rowConc->id'>$rowConc->concelho</option>";
									}
									
						  echo "</select>
						</td>
						<td colspan='4'>
							<label>Freguesia</label>
							<select name='Freguesia' style='width:73%'>
								<option value='-1'></option>";
									$resFreg = $da->getFreguesias();
									while($rowFreg = mysql_fetch_object($resFreg)){
										if ($row->idFreguesia == $rowFreg->id)
											echo "<option value='$rowFreg->id' selected>$rowFreg->freguesia</option>";
										else
											echo "<option value='$rowFreg->id'>$rowFreg->freguesia</option>";
									}
					   echo "</select>
						</td>
						<td colspan='3'>
							<label>Data de Nascimento</label>
							";
							if ($row->dataNascimento != '0000-00-00')
								echo "<input type='text' name='dataNascimento' class='ink-datepicker' style='width:55%' placeholder='aaaa-mm-dd' value='$row->dataNascimento'/> ";
							else
								echo "<input type='text' name='dataNascimento' class='ink-datepicker' style='width:55%' placeholder='aaaa-mm-dd' /> ";
							echo "
						</td>
					</tr>
					<tr>
						<td>
							<label>Género</label>
						</td>
						<td colspan='2'>
							<select name='Genero' style='width:90%'>
								<option value='-1'></option>";
								$resG = $da->getGeneros();
								while($rowG = mysql_fetch_object($resG)){
									if ($row->idGenero == $rowG->id)
										echo "<option value='$rowG->id' selected>$rowG->genero</option>";
									else
										echo "<option value='$rowG->id'>$rowG->genero</option>";
								}
					   echo "</select> 
						</td>
						<td colspan='3'>
								<label>Estado Civil</label>
								<select name='EstadoCivil' style='width:60%' >
									<option value='-1'></option>";
									$resEC = $da->getEstadosCivis();
									while($rowEC = mysql_fetch_object($resEC)){
										if ($row->idEstadoCivil == $rowEC->id)
											echo "<option value='$rowEC->id' selected>$rowEC->estadoCivil</option>";
										else
											echo "<option value='$rowEC->id'>$rowEC->estadoCivil</option>";
									}
						   echo "</select>
						</td>
						<td colspan='4'>
							<label>Habilitações (último ciclo completo)</label>
							<select name='Habilitacoes' style='width:41%' >
								<option value='-1'></option>";
								$resH = $da->getHabilitacoes();
								while($rowH = mysql_fetch_object($resH)){
									if ($row->idHabilitacoes == $rowH->id)
										echo "<option value='$rowH->id' selected>$rowH->habilitacao</option>";
									else
										echo "<option value='$rowH->id'>$rowH->habilitacao</option>";
								}
					   echo "</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>Grupo Etário</label>
						</td>
						<td colspan='2'>
							<select name='GrupoEtario' style='width:90%'>
								<option value='-1'></option>";
								$resGE = $da->getGruposEtarios();
								while($rowGE = mysql_fetch_object($resGE)){
									if ($row->idGrupoEtario == $rowGE->id)
										echo "<option value='$rowGE->id' selected>$rowGE->GrupoEtario</option>";
									else
										echo "<option value='$rowGE->id'>$rowGE->GrupoEtario</option>";
								}
					   echo "</select>
						</td>
						<td colspan='4'>
							<label>Naturalidade</label>
							<input type='text' style='width:68%' name='Naturalidade'  value='$row->Naturalidade'/>
						</td>
						<td colspan='3'>
							<label>Nacionalidade</label>
							<input type='text' style='width:68%' name='Nacionalidade'  value='$row->Nacionalidade'/>	
						</td>
					</tr>
					<tr>
						<td>
							<label>Telemóvel</label>
						</td>
						<td colspan='2'>";
							if ($row->Telemovel == 0 || $row->Telemovel == -1) $tlm = ""; else $tlm = $row->Telemovel;
							echo "
							<input type='text' style='width:90%' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='Telemovel' value='$tlm'/>  
						</td>
						<td colspan='4'>	
							<label>Telefone</label>";
							if ($row->Telefone == 0 || $row->Telefone == -1) $tlf = ""; else $tlf = $row->Telefone;
							if ($row->OutroTelefone == 0 || $row->OutroTelefone == -1) $outroTlf = ""; else $outroTlf = $row->OutroTelefone;
							echo "
							<input type='text'  name='Telefone' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='width:36%' value='$tlf'/>&nbsp;
							<input type='text'  name='OutroTelefone' onkeypress='return event.charCode >= 48 && event.charCode <= 57'  style='width:37%' placeholder='Outro Telefone' value='$outroTlf'/>
						</td>
						<td colspan='3'>
							<label>Email</label>
							<input type='text' style='width:87%'  name='Email' value='$row->Email'/>  
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<label>Situação no País Regularizada</label>
						</td>
						<td colspan='1'>
							<select name='SituacaoRegularizada' style='width:80%'>
								<option value='-1'></option>";
								if ($row->idSituacaoRegularizada == 1)
									echo "<option value='1' selected>Sim</option>
											<option value='2'>Não</option>";
								else
									echo "<option value='1' >Sim</option>
											<option value='2' selected>Não</option>";
								echo "
							</select> 
						</td>
						<td colspan='4'>
							<label>Inscrito Centro de Emprego</label>
								<select name='InscritoCentroEmprego' style='width:15%' onchange='verificarICE(this.value)'>
									<option value='-1'></option>
									";
									if ($row->InscritoCentroEmprego == 1)
										echo "<option value='1' selected>Sim</option>
												<option value='2'>Não</option>";
									else
										echo "<option value='1' >Sim</option>
											<option value='2' selected>Não</option>";
						   echo "</select> ";								
								if ($row->InscritoCentroEmprego == 1)
									echo "
									<input type='text' id='NumeroInscricaoCentroEmprego' name='NumeroInscricaoCentroEmprego' value='$row->NumeroInscricaoCentroEmprego' style='width:29%' placeholder='N.º Inscrição CE' />";
								else
									echo "
										<input type='text' id='NumeroInscricaoCentroEmprego' name='NumeroInscricaoCentroEmprego' style='width:29%' placeholder='N.º Inscrição CE' disabled/>";
								
								echo "
						</td>
						<td colspan='4'>
							<label>Carta de Condução</label>
								<select name='CartaDeConducao' style='width:25%' onchange='verificarCarta(this.value)'>
									<option value='-1'></option>
									";
									if ($row->cartaDeConducao == 1)
										echo "<option value='1' selected>Sim</option>
												<option value='2'>Não</option>";
									else
										echo "<option value='1' >Sim</option>
											<option value='2' selected>Não</option>";
									echo"
								</select> 
								";
								include_once('DataAccess.php');
								$da = new DataAccess();
								$resCCC = $da->getCategoriasCartaConducao();
								if ($row->cartaDeConducao == 1)
									echo "<select name='CategoriaCarta' id='CategoriaCarta' style='width:32%'>";
								else
									echo "<select name='CategoriaCarta' id='CategoriaCarta' style='width:32%' disabled>";
								echo "
									<option value='-1'>Categoria</option>
										";
										while($rowCCC = mysql_fetch_object($resCCC)){
											if ($rowCCC->id == $row->cartaDeConducaoCategoriaID)
												echo "<option value='".$rowCCC->id."' selected>".$rowCCC->categoria."</option>";
											else
												echo "<option value='".$rowCCC->id."'>".$rowCCC->categoria."</option>";
										}
										
										
									echo"
									</select>";
									echo "
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
									if ($row->ultimaProfissaoExercidaDesempregado == $rowIP->id)
										echo "<option value=$rowIP->id selected>$rowIP->interesseProfissional</option>";
									else
										echo "<option value=$rowIP->id>$rowIP->interesseProfissional</option>";
								}
					  echo "</select>
						</td>
						<td colspan='5'>
							<input type='text' placeholder='Qual?' name='ultimaProfissaoExercida' style='width:100%' value='$row->ultimaProfissaoExercida'/>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<label>Situação Face ao Emprego</label>
						</td>
						<td colspan='5'>
							<ul>
								<li style='display: inline;'>";
									if ($row->empregado == 1)
										echo "<input type='checkbox' id='empregado' name='empregado' value='1' onclick='verificarSFE()' checked />";
									else
										echo "<input type='checkbox' id='empregado' name='empregado' value='1' onclick='verificarSFE()'  />";
									
									echo "<label for='empregado'>Empregado</label>
								</li>
								<li style='display: inline; margin-left: 1em;'>";									
									if ($row->empregado == 0)
										echo "<input type='checkbox' id='desempregado' name='desempregado' value='1' onclick='verificarSFE()' checked/>";
									else
										echo "<input type='checkbox' id='desempregado' name='desempregado' value='1' onclick='verificarSFE()' />";
									echo 
									"<label for='desempregado'>Desempregado</label>
								</li>
								<li style='display: inline; margin-left: 1em;'>";
									if ($row->Estudante == 1)
										echo "<input type='checkbox' id='estudante' name='estudante' value='1' onclick='verificarSFE()' checked/>";
									else
										echo "<input type='checkbox' id='estudante' name='estudante' value='1' onclick='verificarSFE()' />";
									
									echo "<label for='estudante'>Estudante</label>
								</li>
								<li style='display: inline; margin-left: 1em;'>";
									if ($row->outraSituacao == 1)
										echo "<input type='checkbox' id='outraSituacao' name='outraSituacao' value='1' onclick='verificarSFE()' checked/>";
									else
										echo "<input type='checkbox' id='outraSituacao' name='outraSituacao' value='1' onclick='verificarSFE()' />";
									echo "<label for='outraSituacao'>Outra Situação</label>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td colspan='10'>";
							if ($row->empregado == 1)
								echo "<div class='highlight' id='divEmpregado' name='divEmpregado' style='display:block'>";
							else
								echo "<div class='highlight' id='divEmpregado' name='divEmpregado' style='display:none'>";
							echo "
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
											<ul>";
												if ($row->trabalhadorPrecario == 1){
													echo "
														<li style='display: inline;'>
															<label>
																<input type='radio' id='radio1' name='radioSituacaoEmprego' value='1' checked>
																Trabalhador Precário
															</label>
														</li>
														<li style='display: inline; margin-left: 1em;'>
															<label>
																<input type='radio' id='radio1' name='radioSituacaoEmprego' value='2' >
																Prestador de Serviços
															</label>
														</li>
														<li style='display: inline; margin-left: 1em;'>
															<label>
																<input type='radio' id='radio1' name='radioSituacaoEmprego' value='3' >
																Trabalhador por conta de outrém
															</label>
														</li>
													";
												}else{
													if ($row->PrestadorDeServicos == 1){
														echo "
															<li style='display: inline;'>
																<label>
																	<input type='radio' id='radio1' name='radioSituacaoEmprego' value='1' >
																	Trabalhador Precário
																</label>
															</li>
															<li style='display: inline; margin-left: 1em;'>
																<label>
																	<input type='radio' id='radio1' name='radioSituacaoEmprego' value='2' checked>
																	Prestador de Serviços
																</label>
															</li>
															<li style='display: inline; margin-left: 1em;'>
																<label>
																	<input type='radio' id='radio1' name='radioSituacaoEmprego' value='3' >
																	Trabalhador por conta de outrém
																</label>
															</li>
														";
													}else{
														if ($row->TrabalhadorContaOutrem == 1){
															echo "
																<li style='display: inline;'>
																	<label>
																		<input type='radio' id='radio1' name='radioSituacaoEmprego' value='1' >
																		Trabalhador Precário
																	</label>
																</li>
																<li style='display: inline; margin-left: 1em;'>
																	<label>
																		<input type='radio' id='radio1' name='radioSituacaoEmprego' value='2' >
																		Prestador de Serviços
																	</label>
																</li>
																<li style='display: inline; margin-left: 1em;'>
																	<label>
																		<input type='radio' id='radio1' name='radioSituacaoEmprego' value='3' checked>
																		Trabalhador por conta de outrém
																	</label>
																</li>
															";
														}else{
															echo "
																<li style='display: inline;'>
																	<label>
																		<input type='radio' id='radio1' name='radioSituacaoEmprego' value='1' checked>
																		Trabalhador Precário
																	</label>
																</li>
																<li style='display: inline; margin-left: 1em;'>
																	<label>
																		<input type='radio' id='radio1' name='radioSituacaoEmprego' value='2' >
																		Prestador de Serviços
																	</label>
																</li>
																<li style='display: inline; margin-left: 1em;'>
																	<label>
																		<input type='radio' id='radio1' name='radioSituacaoEmprego' value='3' >
																		Trabalhador por conta de outrém
																	</label>
																</li>
															";
														}
													}
												}
											echo "</ul>
											</td>
											<td colspan='4'>
												<select name='especificacaoEmprego' title='Especificação Área Profissional' style='width:90%'>";
													$resIP = $da->getInteressesProfissionais();
													while($rowIP = mysql_fetch_object($resIP)){
														if ($row->EspecificacaoEmprego == $rowIP->id)
															echo "<option value='$rowIP->id' selected>$rowIP->interesseProfissional</option>";
														else
															echo "<option value='$rowIP->id'>$rowIP->interesseProfissional</option>";
													}
										  echo "</select>
											</td>
										</tr>
									</table>
						</td>
					<tr>
						<td colspan='10'>";
							
							if ($row->empregado == 0) 
								echo "<div class='highlight' id='divDesempregado' name='divDesempregado' style='display:block'>";
							else
								echo "<div class='highlight' id='divDesempregado' name='divDesempregado' style='display:none'>";
								
								echo "
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
														if ($row->tempoDesempregado == $rowDD->id)
															echo "<option value='$rowDD->id' selected>$rowDD->tempo</option>";	
														else
															echo "<option value='$rowDD->id'>$rowDD->tempo</option>";	
													}
										  echo "</select>
											</td>											
										</tr>
										<tr>
											<td colspan='6'>
												<ul>";
												if ($row->subsidioDesemprego == 1){
													echo"
													<li style='display: inline;'>
														<label>
															<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='4' onclick='verificarD(this)' />
															Sem Subsídio
														</label>
													</li>
													<li style='display: inline;'>
														<label>
															<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='1' checked onclick='verificarD(this)' />
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
													</li>";
												}else{
													if ($row->beneficiarioRSI == 1){
														echo"
														<li style='display: inline;'>
															<label>
																<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='4' onclick='verificarD(this)' />
																Sem Subsídio
															</label>
														</li>
														<li style='display: inline;'>
															<label>
																<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='1'  onclick='verificarD(this)' />
																Subsídio de Desemprego
															</label>
														</li>
														<li style='display: inline; margin-left: 1em;'>
															<label>
																<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='2' checked onclick='verificarD(this)' />
																Beneficiário RSI
															</label>
														</li>
														<li style='display: inline; margin-left: 1em;'>
															<label>
																<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='3' onclick='verificarD(this)' />
																Outros Subsídios
															</label>
														</li>";
													}else{
														if ($row->outrosSubsidios == 1){
															echo"
																<li style='display: inline;'>
																	<label>
																		<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='4' onclick='verificarD(this)' />
																		Sem Subsídio
																	</label>
																</li>
																<li style='display: inline;'>
																	<label>
																		<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='1'  onclick='verificarD(this)' />
																		Subsídio de Desemprego
																	</label>
																</li>
																<li style='display: inline; margin-left: 1em;'>
																	<label>
																		<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='2'  onclick='verificarD(this)' />
																		Beneficiário RSI
																	</label>
																</li>
																<li style='display: inline; margin-left: 1em;'>
																	<label>
																		<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='3' checked onclick='verificarD(this)' />
																		Outros Subsídios
																	</label>
																</li>";
														}else{
															if ($row->semSubsidio == 1){
																echo"
																<li style='display: inline;'>
																	<label>
																		<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='4' checked onclick='verificarD(this)' />
																		Sem Subsídio
																	</label>
																</li>
																<li style='display: inline;'>
																	<label>
																		<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='1'  onclick='verificarD(this)' />
																		Subsídio de Desemprego
																	</label>
																</li>
																<li style='display: inline; margin-left: 1em;'>
																	<label>
																		<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='2'  onclick='verificarD(this)' />
																		Beneficiário RSI
																	</label>
																</li>
																<li style='display: inline; margin-left: 1em;'>
																	<label>
																		<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='3'  onclick='verificarD(this)' />
																		Outros Subsídios
																	</label>
																</li>";
															}else
																echo"
																	<li style='display: inline;'>
																		<label>
																			<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='4' onclick='verificarD(this)' />
																			Sem Subsídio
																		</label>
																	</li>
																	<li style='display: inline;'>
																		<label>
																			<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='1'  onclick='verificarD(this)' />
																			Subsídio de Desemprego
																		</label>
																	</li>
																	<li style='display: inline; margin-left: 1em;'>
																		<label>
																			<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='2'  onclick='verificarD(this)' />
																			Beneficiário RSI
																		</label>
																	</li>
																	<li style='display: inline; margin-left: 1em;'>
																		<label>
																			<input type='radio' id='situacaoDesemprego' name='situacaoDesemprego' value='3'  onclick='verificarD(this)' />
																			Outros Subsídios
																		</label>
																	</li>";
														}
													}
												}
												
												echo "</ul>
											</td>
											<td colspan='4'>";
												if ($row->QuaisOutrosSubsidios != "")
													echo "<input type='text' style='width:90%'  id='QuaisOutrosSubsidios' name='QuaisOutrosSubsidios' placeholder='Quais outros subsídios?' value='$row->QuaisOutrosSubsidios' />";
												else
													echo "<input type='text' style='width:90%'  id='QuaisOutrosSubsidios' name='QuaisOutrosSubsidios' placeholder='Quais outros subsídios?' disabled/>";
											echo "</td>
										</tr>
									</table>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan='10'>";
							if ($row->Estudante == 1)
								echo "<div class='highlight' id='divEstudante' name='divEstudante' style='display:block'>";
							else	
								echo "<div class='highlight' id='divEstudante' name='divEstudante' style='display:none'>";
								
								echo "<label>Estudante</label><br/>
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
											<input type='text' style='width:60%'  id='estabelecimentoEnsino' value='$row->estabelecimentoEnsino' name='estabelecimentoEnsino' placeholder='Estabelecimento de Ensino' />
											
											</td>
										</tr>
									</table>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan='10'>";
							if ($row->outraSituacao == 1)
								echo "<div class='highlight' id='divOutraSituacao' name='divOutraSituacao' style='display:block'>";
							else
								echo "<div class='highlight' id='divOutraSituacao' name='divOutraSituacao' style='display:none'>";
							echo "<label>Outra Situação</label><br/>
								<ul style='list-style-type: none;'>
									<li >";
										if($row->Biscates == 1)
											echo "<input type='checkbox' id='Biscates' name='Biscates' value='1' checked/>";
										else	
											echo "<input type='checkbox' id='Biscates' name='Biscates' value='1' />";
										echo "
											<label for='Biscates'>Biscates</label>
									</li>
									<li >";
										if ($row->Voluntariado == 1)
											echo "<input type='checkbox' id='Voluntariado' name='Voluntariado' value='1' checked/>";
										else
											echo "<input type='checkbox' id='Voluntariado' name='Voluntariado' value='1' />";
										echo "
											<label for='Voluntariado'>Voluntariado</label>
									</li>
									<li>";
										if ($row->FormacaoProfissional == 1)
											echo "<input type='checkbox' id='FormacaoProfissional' name='FormacaoProfissional' value='1' checked onclick='enableFormacaoProfissional()'/>
											<label for='FormacaoProfissional'>Formação Profissional</label>
											<input type='text' name='qualFormacaoProfissional' id='qualFormacaoProfissional' style='width:95%' value='$row->QualFormacaoProfissional' placeholder='Qual?'/>";
										else
											echo "<input type='checkbox' id='FormacaoProfissional' name='FormacaoProfissional' value='1' onclick='enableFormacaoProfissional()'/>
												  <label for='FormacaoProfissional'>Formação Profissional</label>
												  <input type='text' name='qualFormacaoProfissional' id='qualFormacaoProfissional' style='width:95%' disabled placeholder='Qual?'/>";
									echo "
									</li>
									<li>";
										if ($row->MedidasAtivasEmprego == 1)
											echo "<input type='checkbox' id='MedidasAtivasEmprego' name='MedidasAtivasEmprego' value='1' checked onclick='enableMedidasAtivasEmprego()'/>
											<label for='MedidasAtivasEmprego'>Medidas Ativas de Emprego</label>
											<input type='text' name='qualMedidasAtivasEmprego' id='qualMedidasAtivasEmprego' style='width:95%' value='$row->QualMedidasAtivasEmprego' placeholder='Qual?'/>
											";
										else
											echo "<input type='checkbox' id='MedidasAtivasEmprego' name='MedidasAtivasEmprego' value='1' onclick='enableMedidasAtivasEmprego()' />
												<label for='MedidasAtivasEmprego'>Medidas Ativas de Emprego</label>
												<input type='text' name='qualMedidasAtivasEmprego' id='qualMedidasAtivasEmprego' style='width:95%' disabled placeholder='Qual?'/>";
									echo "
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
													while($rowIP = mysql_fetch_object($resIP)){
														if ($rowIP->id == $row->interesseProfissional1)
															echo "<option value='$rowIP->id' selected>$rowIP->interesseProfissional</option>";
														else
															echo "<option value='$rowIP->id'>$rowIP->interesseProfissional</option>";
													}
										  echo "</select>
						</td>
						<td colspan='3'>
							<label>2ª Escolha</label>
												<select name='interessesProfissionais2' title='2ª Escolha' style='width:80%'>
													<option value='-1'></option>";
													$resIP = $da->getInteressesProfissionais();
													while($rowIP = mysql_fetch_object($resIP)){
														if ($rowIP->id == $row->interesseProfissional2)
															echo "<option value='$rowIP->id' selected>$rowIP->interesseProfissional</option>";
														else	
															echo "<option value='$rowIP->id'>$rowIP->interesseProfissional</option>";
													}
										  echo "</select>
						</td>
						<td colspan='3'>
							<label>3ª Escolha</label>
												<select name='interessesProfissionais3' title='3ª Escolha' style='width:100%'>
													<option value='-1'></option>";
													$resIP = $da->getInteressesProfissionais();
													while($rowIP = mysql_fetch_object($resIP)){
														if ($rowIP->id == $row->interesseProfissional3)
															echo "<option value='$rowIP->id' selected>$rowIP->interesseProfissional</option>";
														else
															echo "<option value='$rowIP->id'>$rowIP->interesseProfissional</option>";
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
							<textarea name='Observacoes' cols='50' rows='5' style='width: 100%'>$row->Observacoes</textarea>
						</td>
					</tr>
					<tr>
						<td>";
							if ($row->CV != "")
								echo "<label>Substituir CV</label>";
							else
								echo "<label>Anexar CV</label>";
							
						echo "</td>
						<td colspan='5'>
							<input type='file' name='file' class='ink-button' accept='application/pdf' />
						</td>
						<td colspan='4'>";
							if ($row->CV != "")
								echo "<a href='CVs/$row->CV' target='_blank' class='ink-button'><img src='img/cv.png' style='width:22px'/>Clique para download do CV</a>";
				  echo "</td>
					</tr>
					<tr>
						<td colspan='2'><br/>
							<label>FrontOffice Sinalizador</label>
						</td>
						<td colspan='2'><br/>";
						$da = new DataAccess();
						$resFO = $da -> getFrontOfficeSinalizador($row->idTecnico);
						$rowFO = mysql_fetch_object($resFO);
						echo"
							<input type='text' style='width:80%' name='FrontOfficeSinalizador' value='".$rowFO->FNome."' disabled/>
							<input type='hidden' name='idFrontOfficeSinal' value='$rowFO->FID'/>
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
							<input type='submit' class='ink-button green' value='Guardar' />
						</td>
					</tr>
				</table>
			</fieldset>
			</form>
        </div>";
		
}

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
				<input type='submit' value='Guardar' class='ink-button green'/><br/>
				</center> 
			</form>
		</div>
	";
}

    if ( isset ($_POST['nome']) ){        	    
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
		
		$idFrontOfficeSinalizador = $_POST['idFrontOfficeSinal'];
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
        
		
        include_once('DataAccess.php');
        $da = new DataAccess();        
		
		$atualizado = $da->updateUtentes($id, $nome, $dataNascimento, $dataInscricao, $idConcelho, $idFreguesia, $idHabilitacoes, $NIF, $idEstadoCivil, 
		$trabalhadorPrecario, $PrestadorDeServicos, $TrabalhadorContaOutrem, $ultimaProfissaoExercida, $semSubsidio,
		$subsidioDesemprego, $EspecificacaoEmprego, $tempoDesempregado, $ultimaProfissaoExercida2, $beneficiarioRSI, $outrosSubsidios, $QuaisOutrosSubsidios, 
		$Estudante, $estabelecimentoEnsino, $idGrupoEtario,
		$idSituacaoRegularizada, $idGenero, $MedidasAtivasEmprego, $qualMedidasAtivasEmprego, $Voluntariado, $FormacaoProfissional, $qualFormacaoProfissional,
		$Biscates, $Telemovel, 
		$Telefone, $OutroTelefone, $Email, $Naturalidade, $Nacionalidade, $InscritoCentroEmprego, $NumeroInscricaoCentroEmprego,
		$Observacoes, $idFrontOfficeSinalizador, $idTecnico, $cartaDeConducao, $cartaDeConducaoCategoriaID, $interessesProfissionais1, $interessesProfissionais2, 
		$interessesProfissionais3, $empregado, $outraSituacao, $morada, $estado, $pedidoInicialEmprego, $pedidoInicialFormacao, $pedidoInicialFormacaoQual, 
		$pedidoInicialOutra, $pedidoInicialOutraQual);
		
		if ($atualizado == -1)
			echo "<script> alert('Erro. NIF já se encontra registado noutro utente.'); </script>";
		else{
			//tratamento do ficheiro de CV		
			if (isset($_FILES['file']['tmp_name'])){
				echo "<script>alert('Existe CV!')</script>";
				$nome = $id.".pdf";
				move_uploaded_file($_FILES['file']['tmp_name'], "CVs/".$nome);
				$da->updateCVUtente($id, $nome);
			}
			/*****************************/
			echo "<script> alert('Editado com sucesso'); </script>";
		}
    }
      
	//se tiver sessão iniciado e for admin ou gestor de utentes
	if (isset($_SESSION['id']) && $_SESSION['idTiposDePermissoes'] != 3){
		echo "
			<div class='ink-grid'>
				<form class='ink-form' method='post' action='gerirUtentes.php' onSubmit='return validarFormularioPesquisar()'>
					<legend><h4> <font color='#1A9018'> Pesquisar Utentes </font></h4></legend>
					<table style='width:100%; border:2'>
						<tr>
							<td style='width:5%'></td>
							<td style='width:10%'></td>
							<td style='width:10%'></td>
							<td style='width:10%'></td>
							<td style='width:10%'></td>
							<td style='width:10%'></td>
							<td style='width:10%'></td>
							<td style='width:10%'></td>
							<td style='width:10%'></td>
							<td style='width:10%'></td>
						</tr>
						<tr>
							<td><label for='NIF'>NIF</label></td>
							<td colspan='2'>
								<input type='text' id='NIFS' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='NIF' style='width:90%'/>
							</td>
							<td colspan='8'>			
								<label for='Nome'>Nome</label>							
								<input type='text' id='Nome' name='Nome'  style='width:93%'/>
							</td>
						</tr>
						<tr>
							<td colspan='1'>
								<label for='email'>E-mail</label>
							</td>
							<td colspan='3'>
								<input type='text' id='email' name='email' placeholder='do técnico sinalizador' style='width:90%' />
							</td>
							<td colspan='3'>			
								<label for='frontoffice'>Frontoffice</label>							
								<select name='frontoffice' id='frontoffice' style='width:60%' >
									<option value='-1'></option>";
									$resFO = $da->getFrontOffices();
									while($rowFO = mysql_fetch_object($resFO)){
										echo "<option value='$rowFO->id'>$rowFO->nome</option>";
									}
 						   echo "</select>
							
							<td colspan='1'>
								<label for='Escolaridade'>Escolaridade</label>
							</td>
							
							<td colspan='2'>
								<select name='Escolaridade' style='width:96%'>
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
							
							<td colspan='2'>
								<label for='interesseProfissional'>Interesse Profissional</label>
							</td>
							
							<td colspan='3'>
							<select name='interesseProfissional' title='Interesse Profissional' style='width:90%'>
								<option value='-1'></option>";
								$resIP2 = $da->getInteressesProfissionais();
								while($rowIP2 = mysql_fetch_object($resIP2)){
										echo "<option value=$rowIP2->id>$rowIP2->interesseProfissional</option>";
								}
							echo "</select>
							</td>
							</td>
							<td colspan='5'>
								<label for='situacaoEmprego'>Situação face ao emprego</label>
								<select name='situacaoEmprego' id='situacaoEmprego' style='width:65%'>
								<option value='-1'></option>
								<option value='1'>Empregado</option>
								<option value='2'>Desempregado</option>
								<option value='3'>Estudante</option>
								<option value='4'>Outra Situação</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<input type='submit' class='ink-button green' value='Pesquisar'/>
							</td>
						</tr>
					</table>
				</form>
			</div>
		";
	
	}
	
	if (isset($_POST['NIF']) || isset($_GET['n'])){ //pesquisar utentes por NIF
		include_once('DataAccess.php');
        $da = new DataAccess();
		if (isset($_POST['NIF'])){
			$nif = $_POST['NIF'];
			$nome = $_POST['Nome'];
			$idFrontOfficeSinalizador = $_POST['frontoffice'];
			$emailTecnico = $_POST['email'];
			$res = $da->getUtentes($nif, $nome, $idFrontOfficeSinalizador, $emailTecnico);
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
		if (isset($_POST['idUtente'])){
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
			if (isset($_POST['edit_idUtente'])){
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
						<th style='width:25%' align='left'>Interesse Profissional</th>						
						<th style='width:10%'></th>
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
					<td>$row->nome</td>
					<td>$pedidoInicial</td>
					<td>$situacaoProfissional</td>
					<td>$Habilitacao</td>
					<td>$nomeIP</td>
					<td align='right'>
						<a href='gerirUtentes.php?d=$row->a' onclick='return confirmarApagarUtente()'><img title='Apagar utente' src='img/delete3.png' style='width:25px'/></a>
						<a href='gerirUtentes.php?i=$row->a&f=$row->a'><img title='Detalhes do utente' src='img/info.png' style='width:25px'/></a>
						<a href='gerirUtentes.php?f=$row->a'><img title='Diligências efetuadas' src='img/forward.png' style='width:25px'/></a>";
						if ($row->CV != "")
							echo "<a href='CVs/$row->CV' target='_blank'><img title='Download do CV' src='img/cv.png' style='width:25px'/></a>";
					echo "</td>
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
						if ($row->idTecnico == $_SESSION['id'])
							echo "<a href='gerirUtentes.php?f=".$row->idUtente."&e=$row->id'>
								<img title='Editar' src='img/edit.png' style='width:25px'/>
							</a>";
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
					<input type='submit' value='Guardar' class='ink-button green'/><br/>
					</center> 
				</form>
			</div>
			";		
			
		if (isset($_GET['e']))
			verFormEditarEncaminhamento();
	}
	
	
	if(isset($_GET['i'])){
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->getUtente($_GET['i']);
		
		//ver campos do utente!!
		verFormEditarUtente();
	}
	
        ?>
		<?php
        include('footer.php');
        ?>
	</body>
</html>