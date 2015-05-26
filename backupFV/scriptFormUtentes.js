
function verificarTxtPIF(){
	if (document.getElementById('pedidoInicialFormacaoQual').disabled == false)
		document.getElementById('pedidoInicialFormacaoQual').disabled = true;
	else
		document.getElementById('pedidoInicialFormacaoQual').disabled = false;
}

function verificarTxtPIO(){
	if (document.getElementById('pedidoInicialOutraQual').disabled == false)
		document.getElementById('pedidoInicialOutraQual').disabled = true;
	else
		document.getElementById('pedidoInicialOutraQual').disabled = false;
}

function enableFormacaoProfissional(){
	if (document.getElementById('qualFormacaoProfissional').disabled == false)
		document.getElementById('qualFormacaoProfissional').disabled = true;
	else
		document.getElementById('qualFormacaoProfissional').disabled = false;
}

function enableMedidasAtivasEmprego(){
	if (document.getElementById('qualMedidasAtivasEmprego').disabled == false)
		document.getElementById('qualMedidasAtivasEmprego').disabled = true;
	else
		document.getElementById('qualMedidasAtivasEmprego').disabled = false;
}

function onlyDigits(txt){
	var numbers = /^[0-9]+$/;
	if(txt.value.match(numbers)){
		return true;
	}else{
		return false;
	}
}

function confirmarApagarUtente(){
	return confirm('Tem a certeza que deseja apagar o utente?');
}

function validarFormulario(){
	//função para validar o formulário para editar um utente
	if (document.getElementById('NIF').value.length==9)
		return true;
	else{
		alert('O NIF tem que ter 9 dígitos');
		return false;
	} 
}

function validarFormularioPesquisar(){
	//função para validar o formulário para pesquisar um utente
	if (document.getElementById('NIFS').value.length==9 )
		return true;
	else{
		if (document.getElementById('NIFS').value.length>0){
			alert('O NIF tem que ter 9 dígitos');
			return false;
		}else
			return true;
	} 
}

function verificarNumDigits(){
	if (document.getElementById('NIFS').value.length==9)
		return true;
	else{
		alert('O NIF tem que ter 9 dígitos');
		return false;
	}
}

function verificarICE(value){
	if(value == 1){
		document.getElementById('NumeroInscricaoCentroEmprego').disabled = false;
	}else
		document.getElementById('NumeroInscricaoCentroEmprego').disabled = true;
}
	
function verificarSFE(){		
	var cb5 = document.getElementById('empregado').checked;
	var cb4 = document.getElementById('desempregado').checked;
	var cb3 = document.getElementById('estudante').checked;
	var cb2 = document.getElementById('outraSituacao').checked;
	
	if(cb5 && cb4){
		alert("Erro. Não pode ser Empregado e Desempregado ao mesmo tempo.");
		document.getElementById('empregado').checked = false;
		document.getElementById('desempregado').checked = false;
		var cb5 = document.getElementById('empregado').checked;
		var cb4 = document.getElementById('desempregado').checked;
	}
	
	if (cb5) document.getElementById('divEmpregado').style.display='block'; else document.getElementById('divEmpregado').style.display='none'; 
	if (cb4) document.getElementById('divDesempregado').style.display='block'; else document.getElementById('divDesempregado').style.display='none';
	if (cb3) document.getElementById('divEstudante').style.display='block'; else document.getElementById('divEstudante').style.display='none';
	if (cb2) document.getElementById('divOutraSituacao').style.display='block'; else document.getElementById('divOutraSituacao').style.display='none';
		
}	
	
function verificarCarta(value){
	if(value == 1){
		document.getElementById('CategoriaCarta').disabled = false;
	}else
		document.getElementById('CategoriaCarta').disabled = true;
}

function verificarD(obj)
{
	var b = obj.value;
	if (b == '3')
		document.getElementById('QuaisOutrosSubsidios').disabled = false;
	else
		document.getElementById('QuaisOutrosSubsidios').disabled = true;
}

function verificarDI(value)
{
	if(value == -1)
		document.getElementById('numIdentificacao').disabled = true;
	else
		document.getElementById('numIdentificacao').disabled = false;
	
}