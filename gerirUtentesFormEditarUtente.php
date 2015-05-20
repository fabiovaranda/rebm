<script>function apagarCV(){return confirm('Tem a certeza que deseja eliminar o CV?');}</script>

<?php

if (isset($_GET['elimCV'])){
	$idUtente = $_GET['elimCV'];
	$da->updateCVUtente($idUtente,"");
	unlink("CVs/$idUtente.pdf");
	echo "<script>alert('CV eliminado com sucesso')</script>";	
}

function verFormEditarUtente(){
	include_once('DataAccess.php');
	$da = new DataAccess();
	$res = $da->getUtente($_GET['i']);
	$row = mysql_fetch_object($res);
	echo "<br/>
	<div class='ink-grid'>
			<form class='ink-form' method='post' action='gerirUtentes.php?i=".$_GET['i']."' id='formUtente' onSubmit='return validarFormulario()' enctype='multipart/form-data'>
			<legend><h4> <font color='#1A9018'> Utente </font>";
			if ($row->estado == 1){
				$img = "utenteAtivo.png";
				$state = "Ativo";
			}
			else{	
				$img = "utenteInativo.png";
				$state = "Inativo";
			}
			echo "<img src='img/$img' title = '$state' style='width:25px'/>";
			echo "</h4></legend>			
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
							<label>NISS</label>
						</td>
						<td colspan='2'>";
							if ($row->NISS == "" || $row->NISS == -1)
								echo "<input type='text' name='NISS' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='width:90%' /> ";
							else
								echo "<input type='text' name='NISS' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='width:90%' value='$row->NISS'/> ";
						echo "</td>
						<td colspan='4'>
							<label>Tipo Documento Identificação</label>
							<select name='tipoDocumentoIdentificacao' style='width:40%' onchange='verificarDI(this.value)'>
								<option value = '-1'></option>";
								$resDI = $da->getTiposDocumentos();
								while ($rowDI = mysql_fetch_object($resDI)){
									if ($row->tipoDocumentoIdentificacao == $rowDI->id)
										echo  "<option value='$rowDI->id' selected>$rowDI->tipo</option>";
									else
										echo "<option value='$rowDI->id'>$rowDI->tipo</option>";
									}
							echo"</select>
						</td>
						<td colspan='4'>
							<label>N.º Identificação</label>&nbsp;";
							if (($row->numIdentificacao == "" || $row->numIdentificacao == -1) && $row->tipoDocumentoIdentificacao == -1)
								echo "<input type='text' name='numIdentificacao' id='numIdentificacao' style='width:63%' disabled/>";
							else
								echo "<input type='text' name='numIdentificacao' id='numIdentificacao' style='width:63%' value='$row->numeroIdentificacao'/>";
							echo "
						</td>
					<tr/>
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
								echo "<a href='CVs/$row->CV' target='_blank' class='ink-button'><img src='img/cv.png' style='width:22px'/>Clique para download do CV</a>
								&nbsp;
								<a href='gerirUtentes.php?i=$row->id&f=$row->id&elimCV=$row->id' onclick='return apagarCV()'>
										<img src='img/delete.png' title='Eliminar CV' style='width:41px'/></a>
								";
				  echo "</td>
					</tr>
					<tr>
						<td colspan='2'><br/>
							<label>FrontOffice Sinalizador</label>
						</td>
						<td colspan='2'><br/>";
						
						$nomeFO = $da->getNomeFrontOffice($row->idFrontOfficeSinalizador);
						$nomeTecnico = $da->getNomeTecnico($row->idTecnico);
						
						echo"
							<input type='text' style='width:80%' name='FrontOfficeSinalizador' value='".$nomeFO."' disabled/>
							<input type='hidden' name='idFrontOfficeSinal' value='$rowFO->FID'/>
						</td>
						<td colspan='4'>
							<br/>
							<label>Nome do técnico</label>
							<input type='text' style='width:37%' name='NomeTecnico' value='".$nomeTecnico."' disabled/>
						</td>
					</tr>
					<tr>
						<td colspan='10'>
						<br/>";?>
							<input name='buttonEditarUtente' type='submit' class='ink-button green' value='Guardar' /><!--onclick="<script>alert(document.getElementById('dataInscricao').value)</script> "/>-->
						<?php echo "</td>
					</tr>
				</table>
			</fieldset>
			</form>
        </div>";
		
}

?>