<?php
	if (isset($_GET['i'])){
		$id = $_GET['i'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->getUtente($id);
		$row = mysql_fetch_object($res);
		
		/*
			nome, dataNascimento, dataInscricao , 
			idConcelho, idFreguesia, idHabilitacoes, NIF, idEstadoCivil, trabalhadorPrecario, PrestadorDeServicos, TrabalhadorContaOutrem, ultimaProfissaoExercida,
			semSubsidio, subsidioDesemprego, EspecificacaoEmprego, tempoDesempregado, ultimaProfissaoExercidaDesempregado, beneficiarioRSI, outrosSubsidios, 
			QuaisOutrosSubsidios, Estudante,
			estabelecimentoEnsino, idGrupoEtario, idSituacaoRegularizada, idGenero, MedidasAtivasEmprego, QualMedidasAtivasEmprego, 
			Voluntariado, FormacaoProfissional, QualFormacaoProfissional, Biscates,
			Telemovel, Telefone, OutroTelefone, Email, Naturalidade, Nacionalidade, InscritoCentroEmprego, NumeroInscricaoCentroEmprego,
			Observacoes, idFrontOfficeSinalizador, idTecnico, cartaDeConducao, cartaDeConducaoCategoriaID, interesseProfissional1,  
			interesseProfissional2, interesseProfissional3, empregado, outraSituacao,
			morada, estado, pedidoInicialEmprego, pedidoInicialFormacao, pedidoInicialFormacaoQual, pedidoInicialOutra, pedidoInicialOutraQual,
			NISS, tipoDocumentoIdentificacao, numeroIdentificacao
		*/
		
		
		$nome = $row->nome;
		$dataNascimento = $row->dataNascimento;
		$pedidoInicial = "";
		$tipoDocumentoIdentificacao = "";
		
		if ($row->tipoDocumentoIdentificacao == 1) 
			$tipoDocumentoIdentificacao = "Autorização de resistencia";
		else{
			if ($row->tipoDocumentoIdentificacao == 2) 
				$tipoDocumentoIdentificacao = "Passaporte";
			else{
				if ($row->tipoDocumentoIdentificacao == 3) 
					$tipoDocumentoIdentificacao = "Cartão do cidadão";
				else{
					if ($row->tipoDocumentoIdentificacao == 4) 
						$tipoDocumentoIdentificacao = "Bilhete de identifição";
					else{
						if ($row->tipoDocumentoIdentificacao == 5) 
							$tipoDocumentoIdentificacao = "Outro";
						}
					}	
				}
			}
			
				
		if ($row->idEstadoCivil == 1) 
			$idEstadoCivil = "solteiro";
		else{
			if ($row->idEstadoCivil == 2) 
				$idEstadoCivil = "casado";
			else{
				if ($row->idEstadoCivil == 3) 
					$idEstadoCivil = "viúvo";
				else{
					if ($row->idEstadoCivil == 4) 
						$idEstadoCivil = "divorciado";
					else{
						if ($row->idEstadoCivil == 5) 
							$idEstadoCivil = "comunhão";
						}
					}	
				}
			}

		if ($row->idHabilitacoes == 1) 
			$idHabilitacoes = "<4º ano";
		else{
				if ($row->idHabilitacoes == 2) 
				$idHabilitacoes = "1º ciclo";
			else{
				if ($row->idHabilitacoes == 3) 
				$idHabilitacoes = "2º ciclo";
				else{
					if ($row->idHabilitacoes == 4) 
					$idHabilitacoes = "3ºciclo";
					else{
						if ($row->idHabilitacoes == 5) 
						$idHabilitacoes = "ensino segundario";
						else{
							if ($row->idHabilitacoes == 6) 
							$idHabilitacoes = "ensino superior";
							}
						}
					}
				}
			}
		
		if ($row->idConcelho == 1) 
			$idConcelho = "Barreiro";
		else{
			if ($row->idConcelho == 2) 
				$idConcelho = "Moita";
			else{
				if ($row->idConcelho == 3) 
					$idConcelho = "Outro";
				}
			}
			
		if ($row->idGenero == 1) 
			$idGenero = "Feminino";
		else{
			if ($row->idGenero == 2) 
				$idGenero = "Masculino";
			}
		
		if ($row->idFreguesia == 1) 
			$idFreguesia = "Alto Seixalinho, Santo André e Verderena";
		else{
			if ($row->idFreguesia == 2) 
				$idFreguesia = "Barreiro e Lavradio";
			else{
				if ($row->idFreguesia == 3) 
					$idFreguesia = "Palhais e Coina";
				else{
					if ($row->idFreguesia == 4) 
						$idFreguesia = "Santo António da Charneca";
					else{
						if ($row->idFreguesia == 5) 
							$idFreguesia = "Alhos Vedros";
						else{
							if ($row->idFreguesia == 6) 
								$idFreguesia = "Baixa da banheira";
							else{
								if ($row->idFreguesia == 7) 
									$idFreguesia = "Gaio-Rosário";
								else{
									if ($row->idFreguesia == 8) 
										$idFreguesia = "Moita";
									else{
										if ($row->idFreguesia == 9) 
											$idFreguesia = "Sarilhos Pequenos";
										else{
											if ($row->idFreguesia == 10) 
												$idFreguesia = "Vale da Amoreira";
											else{
												} 
											}
										}
									}
								}
							}
						}
					}
				}
			}
			if ($row->idGrupoEtario == 1) 
				$idGrupoEtario = "<15";
			else{
				if ($row->idGrupoEtario == 2) 
					$idGrupoEtario = "15-19";
				else{
					if ($row->idGrupoEtario == 3) 
						$idGrupoEtario = "20-24";
					else{
						if ($row->idGrupoEtario == 4) 
							$idGrupoEtario = "25-34";
						else{
							if ($row->idGrupoEtario == 5) 
								$idGrupoEtario = "35-44";
							else{
								if ($row->idGrupoEtario == 6) 
									$idGrupoEtario = "45-54";
								else{
									if ($row->idGrupoEtario == 7) 
										$idGrupoEtario = "55-64";
									else{
										if ($row->idGrupoEtario == 8) 
											$idGrupoEtario = ">64";
										else{
											}
										}
									}
								}
							}
						}
					}
				}
									
									
									
		if ($row->pedidoInicialEmprego == 1) $pedidoInicial = "Emprego";
		else{
			if ($row->pedidoInicialFormacao == 1) $pedidoInicial = "Formação - ".$row->pedidoInicialFormacaoQual;
			else{
				if ($row->pedidoInicialOutra == 1) $pedidoInicial = "Outra - ".$row->pedidoInicialOutraQual;
			}
		}
		
		if ($row->estado == 1)
			$estado = "Ativo";
		else
			$estado = "Inativo";
			
		
		
		if($row->InscritoCentroEmprego == 1){
			$img = "checked.png";
		}else{
			$img = "unchecked.png";
		}
		
		if($row->cartaDeConducao == 1){
			$img = "checked.png";
		}else{
			$img = "unchecked.png";
		}
			
		if($row->NISS=="-1")
			$NISS="";
		else
			$NISS=$row->NISS;
		
		$cartaDeConducaoCategoriaID = $da->getCategoriaCartaConducao($row->cartaDeConducaoCategoriaID);
		
		$upe = $da->getInteresseProfissional($row->ultimaProfissaoExercidaDesempregado);
		$interesseProfissional1 = $da->getInteresseProfissional($row->interesseProfissional1);
		$interesseProfissional2 = $da->getInteresseProfissional($row->interesseProfissional2);
		$interesseProfissional3 = $da->getInteresseProfissional($row->interesseProfissional3);
		
			
			
		$content = "
			<page>
				<br/>
				<table>
					<tr>
						<td colspan='1' >							
							&nbsp;
						</td>
						<td colspan='2' align='center'>
							<img src='img/customLogo.png' style='height:100px'/>
							<br/>
							<h3>Ficha de Utente</h3>
							<br/>
						</td>
						<td colspan='1' >							
							&nbsp;
						</td>
					</tr>
					
					<tr>
						<td>Nome:</td>
						<td>$row->nome</td>
						<td>Estado:</td>
						<td>$estado</td>
					</tr>
					<tr>
						<td>Pedido Inicial:</td>
						<td colspan='3'>$pedidoInicial</td>
					</tr>
					<tr>
						<td>NIF:</td>
						<td>$row->NIF</td>
						<td>NISS:</td>
						<td>$NISS</td>
					</tr>
					<tr>
						<td> data de Inscricao:</td>
						<td>$row->dataInscricao</td>
						<td>Tipo de documento de Identificacao:</td>
						<td>$tipoDocumentoIdentificacao</td>
					</tr>					
					<tr>
						<td><b>Morada:</b></td>
						<td colspan='3'>$row->morada </td>
					</tr>
					<tr>
						<td><b>Freguesia:</b></td>
						<td colspan='3'>$idFreguesia - $idConcelho </td>
					</tr>
					<tr>
						<td>Data de Nascimento:</td>
						<td>$dataNascimento</td>
						<td>Genero:</td>
						<td>$idGenero</td>
					</tr>
						<tr>
						<td>Estado civil:</td>
						<td>$idEstadoCivil</td>
						<td>Habilitações (último ciclo completado):</td>
						<td>$idHabilitacoes</td>
					</tr>
					<tr>
						<td>Grupo Etário:</td>
						<td>$idGrupoEtario</td>
						<td>Naturalidade:</td>
						<td>$row->Naturalidade</td>
					</tr>
					<tr>
						<td>Nacionalidade:</td>
						<td>$row->Nacionalidade</td>
						<td>Telemovel:</td>
						<td>$Telemovel</td>
					</tr>
					";
					
					if($row->idSituacaoRegularizada == 1){
						$img = "checked.png";
					}else{
						$img = "unchecked.png";
					}
					
					$content = "
					<tr>
						<td>Email:</td>
						<td>$row->Email</td>
						<td colspan='2'><img src='img/$img' style='width:15px' /> Situação Regularizada </td>
					</tr>
					";
					
					$content = "
					<tr>
						<td colspan='2'><img src='img/$img' style='width:15px' /> InscritoCentroEmprego </td>
						<td>Numero de Inscricao de Centro de Emprego:</td>
						<td>$NumeroInscricaoCentroEmprego</td>
					</tr>
					";
					
					$content = "
					<tr>
						<td colspan='2'><img src='img/$img' style='width:15px' /> CartaDeCondução </td>
						<td>Categoria:</td>
						<td>$cartaDeConducaoCategoriaID</td>
					</tr>
					<tr>
						<td>Última Profissão Exercida:</td>
						<td>$upe</td>
						<td colspan='2'></td>
					</tr>
					<tr>
						<td><b>Interesses profissionais:</b></td>
						<td>1- $interesseProfissional1</td>
						<td colspan='2'></td>
					</tr>
					<tr>
						<td></td>
						<td>2- $interesseProfissional2</td>
						<td colspan='2'></td>
					</tr>
					<tr>
						<td></td>
						<td>3- $interesseProfissional3</td>
						<td colspan='2'></td>
					</tr>
					
						";
						
					//Empregado
					if($row->empregado == 1) {
						$content .= "
							<tr>
								<td colspan='4' align='center'>
									<hr/>
										<b>Empregado</b>
									<hr/>
								</td>
							</tr>
						";
						
						if($row->trabalhadorPrecario == 1){
							$tipo = "Trabalhador Precário";
						}else{
							if ($row->PrestadorDeServicos == 1)
								$tipo = "Prestador de Serviços";
							else
								if ($row->TrabalhadorContaOutrem == 1)
									$tipo = "Trabalhador por Conta de Outrém";
						}
						
						$espEmprego = $da->getInteresseProfissional($row->EspecificacaoEmprego);
						
						$content .= "
							<tr>
								<td colspan='4'><img src='img/checked.png' style='width:15px' /> $tipo - $espEmprego</td>
							</tr>
						";
						
					
					//estudante
					if($row->Estudante == 1){
						$content .= "
							<tr>
								<td colspan='4' align='center'>
									<hr/>
										<b>Estudante</b>
									<hr/>
								</td>
							</tr>
						";
						
						$content .= "
							<tr>
								<td colspan='4'>Escola: $row->estabelecimentoEnsino</td>
							</tr>
						";
					}
					//Outra Situação
					if($row->outraSituacao == 1){ //se tiver outra situação, vamos mostrar biscates ou voluntariado ou ...
						$content .= "
							<tr>
								<td colspan='4' align='center'>
									<hr/>
										<b>Outra Situação</b>
									<hr/>
								</td>
							</tr>
						";
						if($row->Biscates == 1){
							$img = "checked.png";
						}else{
							$img = "unchecked.png";
						}
					
						$content .= "
							<tr>
								<td><img src='img/$img' style='width:15px' /> Biscates </td>
							</tr>
						";
						
						if($row->Voluntariado == 1){
							$img = "checked.png";
						}else{
							$img = "unchecked.png";
						}
					
						$content .= "
							<tr>
								<td><img src='img/$img' style='width:15px' /> Voluntariado </td>
							</tr>
						";
						
						if($row->FormacaoProfissional == 1){
						
							if($row->MedidasAtivasEmprego == 1){
								$img = "checked.png";
							}else{
								$img = "unchecked.png";
							}
						
							$content .= "
								<tr>
									<td><img src='img/$img' style='width:15px' /> MedidasAtivasEmprego </td>
								</tr>
							";
							
							if($row->QualFormacaoProfissional == 1){
								$img = "checked.png";
							}else{
								$img = "unchecked.png";
							}
						
							$content .= "
								<tr>
									<td><img src='img/$img' style='width:15px' /> QualFormacaoProfissional </td>
								</tr>
							";
							}
						}
					}
					
					//trabalhadorPrecario, PrestadorDeServicos, TrabalhadorContaOutrem, ultimaProfissaoExercida,
					
					
		$content.= "
				</table>
			</page>";
		
		require_once('html2pdf/html2pdf.class.php');
		$html2pdf = new HTML2PDF('P','A4','pt');
		$html2pdf->WriteHTML($content);
		$html2pdf->Output('info.pdf');
	}
	
?>