<script>
	function cleanForm(){		
		document.getElementById('estado').value = 1;
		document.getElementById('NIFS').value = '';
		document.getElementById('Nome').value = '';
		document.getElementById('email').value = '';
		document.getElementById('frontoffice').value = -1;
		document.getElementById('Escolaridade').value = -1;
		document.getElementById('interesseProfissional').value = -1;
		document.getElementById('situacaoEmprego').value = -1;
	}
	
	function validarFormulario(){
		if (document.getElementById('exemplo').value.length != 9){
			alert('NIF tem que ter 9 dígitos');
			document.getElementById('exemplo').focus();
			return false;
		}
		return true;
	}
	
	function isNumberKey(evt)
	{
		 var charCode = (evt.which) ? evt.which : event.keyCode
		 if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;

		 return true;
	}
</script>
<?php
//se tiver sessão iniciado e for admin ou gestor de utentes
	if (isset($_SESSION['id']) && $_SESSION['idTiposDePermissoes'] != 3){
		echo "
			<div class='ink-grid'>
				<form class='ink-form' method='post' action='gerirUtentes.php?pg=1' onSubmit='return validarFormularioPesquisar()'>
					<legend><h4> <font color='#1A9018'> Pesquisar Utentes </font> 
					<a href='#' onclick='cleanForm()' title='Limpar campos de pesquisa'><img src='img/clean.png' style='width:20px'/></a>
					</h4></legend>
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
							<td><label for='estado'>Estado</label></td>
							<td colspan='1'>";			
								if (isset($_POST['estado'])){
									if ($_POST['estado'] == 1)
									echo "<select name='estado' id='estado' title='Estado do Utente'>
											<option value='1'>Ativo</option>
											<option value='2'>Inativo</option>
										</select>";
									else	
									echo "<select name='estado' id='estado' title='Estado do Utente'>
											<option value='1'>Ativo</option>
											<option value='2' selected>Inativo</option>
										</select>";

								}else
									echo "<select name='estado' id='estado' title='Estado do Utente'>
											<option value='1'>Ativo</option>
											<option value='2'>Inativo</option>
										</select>";
							echo "</td>
							<td colspan='2'> 
								<label for='NIF'>NIF</label>";
								if (isset($_POST['NIF']))
									echo "<input type='text' value='".$_POST['NIF']."' id='NIFS' maxlength='9' onkeypress='return isNumberKey(event)' name='NIF' style='width:80%'/>";
								else	
									echo "<input type='text' id='NIFS' maxlength='9' onkeypress='return isNumberKey(event)' name='NIF' style='width:80%'/>";
							echo "</td>
							<td colspan='6'>			
								<label for='Nome'>Nome</label>";						
								if (isset($_POST['Nome']))
									echo "<input type='text' value='".$_POST['Nome']."' id='Nome' name='Nome'  style='width:92%'/>";
								else
									echo "<input type='text' id='Nome' name='Nome'  style='width:92%'/>";
							echo "
							</td>
						</tr>
						<tr>
							<td colspan='1'>
								<label for='email'>E-mail</label>
							</td>
							<td colspan='3'>";
								if (isset($_POST['email']))
									echo "<input type='text' id='email' value='".$_POST['email']."' name='email' placeholder='do técnico sinalizador' style='width:94%' />";
								else
									echo "<input type='text' id='email' name='email' placeholder='do técnico sinalizador' style='width:94%' />";
							echo "</td>
							<td colspan='3'>			
								<label for='frontoffice'>Frontoffice</label>							
								<select name='frontoffice' id='frontoffice' style='width:60%' >
									<option value='-1'></option>";
									$resFO = $da->getFrontOffices();
									while($rowFO = mysql_fetch_object($resFO)){
										if (isset($_POST['frontoffice'])){
											if ($_POST['frontoffice'] == $rowFO->id)
												echo "<option value='$rowFO->id' selected>$rowFO->nome</option>";
											else
												echo "<option value='$rowFO->id'>$rowFO->nome</option>";
										}else
											echo "<option value='$rowFO->id'>$rowFO->nome</option>";
									}
 						   echo "</select>
							
							<td colspan='1'>
								<label for='Escolaridade'>Escolaridade</label>
							</td>
							<td colspan='2'>";
								if (isset($_POST['Escolaridade'])){
									switch($_POST['Escolaridade']){
										case -1: 
											echo "<select name='Escolaridade' id='Escolaridade' style='width:96%'>
												<option value='-1'></option>
												<option value='1'><4º ano</option>
												<option value='2'>1º ciclo</option>
												<option value='3'>2º ciclo</option>
												<option value='4'>3º ciclo</option>
												<option value='5'>Ensino Secundário</option>
												<option value='6'>Ensino Superior</option>
											</select>";
										break;
										case 1: 
											echo "<select name='Escolaridade' id='Escolaridade' style='width:96%'>
												<option value='-1'></option>
												<option value='1' selected><4º ano</option>
												<option value='2'>1º ciclo</option>
												<option value='3'>2º ciclo</option>
												<option value='4'>3º ciclo</option>
												<option value='5'>Ensino Secundário</option>
												<option value='6'>Ensino Superior</option>
											</select>";
										break;
										case 2: 
											echo "<select name='Escolaridade' id='Escolaridade' style='width:96%'>
												<option value='-1'></option>
												<option value='1'><4º ano</option>
												<option value='2' selected>1º ciclo</option>
												<option value='3'>2º ciclo</option>
												<option value='4'>3º ciclo</option>
												<option value='5'>Ensino Secundário</option>
												<option value='6'>Ensino Superior</option>
											</select>";
										break;
										case 3: 
											echo "<select name='Escolaridade' id='Escolaridade' style='width:96%'>
												<option value='-1'></option>
												<option value='1'><4º ano</option>
												<option value='2'>1º ciclo</option>
												<option value='3' selected>2º ciclo</option>
												<option value='4'>3º ciclo</option>
												<option value='5'>Ensino Secundário</option>
												<option value='6'>Ensino Superior</option>
											</select>";
										break;
										case 4: 
											echo "<select name='Escolaridade' id='Escolaridade' style='width:96%'>
												<option value='-1'></option>
												<option value='1'><4º ano</option>
												<option value='2'>1º ciclo</option>
												<option value='3'>2º ciclo</option>
												<option value='4' selected>3º ciclo</option>
												<option value='5'>Ensino Secundário</option>
												<option value='6'>Ensino Superior</option>
											</select>";
										break;
										case 5: 
											echo "<select name='Escolaridade' id='Escolaridade' style='width:96%'>
												<option value='-1'></option>
												<option value='1'><4º ano</option>
												<option value='2'>1º ciclo</option>
												<option value='3'>2º ciclo</option>
												<option value='4'>3º ciclo</option>
												<option value='5' selected>Ensino Secundário</option>
												<option value='6'>Ensino Superior</option>
											</select>";
										break;
										case 6: 
											echo "<select name='Escolaridade' id='Escolaridade' style='width:96%'>
												<option value='-1'></option>
												<option value='1'><4º ano</option>
												<option value='2'>1º ciclo</option>
												<option value='3'>2º ciclo</option>
												<option value='4'>3º ciclo</option>
												<option value='5'>Ensino Secundário</option>
												<option value='6' selected>Ensino Superior</option>
											</select>";
										break;
									}
								}else
									echo "<select name='Escolaridade' id='Escolaridade' style='width:96%'>
										<option value='-1'></option>
										<option value='1'><4º ano</option>
										<option value='2'>1º ciclo</option>
										<option value='3'>2º ciclo</option>
										<option value='4'>3º ciclo</option>
										<option value='5'>Ensino Secundário</option>
										<option value='6'>Ensino Superior</option>
									</select>";
							echo "</td>
						</tr>
						<tr>
							
							<td colspan='2'>
								<label for='interesseProfissional'>Interesse Profissional</label>
							</td>
							
							<td colspan='3'>
							<select name='interesseProfissional' id='interesseProfissional' title='Interesse Profissional' style='width:90%'>
								<option value='-1'></option>";
								$resIP2 = $da->getInteressesProfissionais();
								while($rowIP2 = mysql_fetch_object($resIP2)){
									if (isset($_POST['interesseProfissional'])){
											if ($_POST['interesseProfissional'] == $rowIP2->id)
												echo "<option value=$rowIP2->id selected>$rowIP2->interesseProfissional</option>";
											else
												echo "<option value=$rowIP2->id>$rowIP2->interesseProfissional</option>";
									}else
										echo "<option value=$rowIP2->id>$rowIP2->interesseProfissional</option>";
								}
							echo "</select>
							</td>
							</td>
							<td colspan='5'>
								<label for='situacaoEmprego'>Situação Emprego</label>";
								if (isset($_POST['situacaoEmprego'])){
									switch($_POST['situacaoEmprego']){
										case -1: 
											echo "
											<select name='situacaoEmprego' id='situacaoEmprego' style='width:75%'>
												<option value='-1'></option>
												<option value='1'>Empregado</option>
												<option value='2'>Desempregado</option>
												<option value='3'>Estudante</option>
												<option value='4'>Outra Situação</option>
											</select>";
										break;
										case 1: 
											echo "
											<select name='situacaoEmprego' id='situacaoEmprego' style='width:75%'>
												<option value='-1'></option>
												<option value='1' selected>Empregado</option>
												<option value='2'>Desempregado</option>
												<option value='3'>Estudante</option>
												<option value='4'>Outra Situação</option>
											</select>";
										break;
										case 2: 
											echo "
											<select name='situacaoEmprego' id='situacaoEmprego' style='width:75%'>
												<option value='-1'></option>
												<option value='1'>Empregado</option>
												<option value='2' selected>Desempregado</option>
												<option value='3'>Estudante</option>
												<option value='4'>Outra Situação</option>
											</select>";
										break;
										case 3: 
											echo "
											<select name='situacaoEmprego' id='situacaoEmprego' style='width:75%'>
												<option value='-1'></option>
												<option value='1'>Empregado</option>
												<option value='2'>Desempregado</option>
												<option value='3' selected>Estudante</option>
												<option value='4'>Outra Situação</option>
											</select>";
										break;
										case 4: 
											echo "
											<select name='situacaoEmprego' id='situacaoEmprego' style='width:75%'>
												<option value='-1'></option>
												<option value='1'>Empregado</option>
												<option value='2'>Desempregado</option>
												<option value='3'>Estudante</option>
												<option value='4' selected>Outra Situação</option>
											</select>";
										break;
									}
								}else
									echo "
									<select name='situacaoEmprego' id='situacaoEmprego' style='width:75%'>
										<option value='-1'></option>
										<option value='1'>Empregado</option>
										<option value='2'>Desempregado</option>
										<option value='3'>Estudante</option>
										<option value='4'>Outra Situação</option>
									</select>";
							echo "
							</td>
						</tr>
						<tr>
							<td>
								<input type='submit' name='buttonFormPesquisaUtentes' class='ink-button green' value='Pesquisar'/>
							</td>
						</tr>
					</table>
				</form>
			</div>
		";
	
	}

?>