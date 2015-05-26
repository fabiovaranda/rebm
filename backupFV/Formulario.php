<?php
    if ( isset ($_POST['nome'])){
        $nome = $_POST['nome'];
        $dataNAscimento = $_POST['dataNascimento'];
        $idGenero = $_POST['idGenero'];
        $Telemovel = $_POST['Telemovel'];
        $Tefone = $_POST['Telefone'];
        $OutroTelefone = $_POST['OutroTelefone'];
        $NIF = $_POST['NIF'];
        $Naturalida = $_POST['Naturalidade'];
        $Nacionalidade = $_POST['Nacionaldade'];
        include_once('DataAccess.php');
        $da = new DataAccess();
        $res = $da->inserirUtentes($nome, $dataNascimento, $idGenero, $Telemovel, $Telefone, $OutroTelefone, $NIF, $Naturalidade,$Nacionalidade, $inscritoCentroEmprego, $NumeroInscricaoCentroEmprego, $observacoes, $Email, $idConcelho, $idFreguesia, $idEstadoCivil, $idHabilitações, $idIncritoCE, $idTempoDesempregado);        
    }
?>

<html>
    <head>
        <title>REBM</title>
        <?php
         include('importarBibliotecas.php');
        ?>
        
        <script>
            
            function verDiv(v){
                switch(v){
                    case "1": //empregado
                        document.getElementById('divEmpregado').style.display='block';
                        document.getElementById('divDesempregado').style.display='none';
                        document.getElementById('divOutraSituacao').style.display='none';
                        break;
                   case "2": //empregado
                        document.getElementById('divEmpregado').style.display='none';
                        document.getElementById('divDesempregado').style.display='block';
                        document.getElementById('divOutraSituacao').style.display='none';
                        break;
                   case "3": //empregado
                        document.getElementById('divEmpregado').style.display='none';
                        document.getElementById('divDesempregado').style.display='none';
                        document.getElementById('divOutraSituacao').style.display='block';
                        break;
                   default: //empregado
                        document.getElementById('divEmpregado').style.display='none';
                        document.getElementById('divDesempregado').style.display='none';
                        document.getElementById('divOutraSituacao').style.display='none';
                        break;
                }
            }
        </script>
    </head>
    
    <body>
        <?php
        include('menu.php');
        ?>
        <div class='ink-grid'>
            <form class='ink-form' method="post" action="Formulario.php">
                <fieldset>
                    <legend>Inserir Beneficiário</legend>
                    <div class="control-group column-group">
                        
                        <label class="large-5 content-left" for="nome">Nome</label>
                        <div class="control large-30 content-right">
                            <input type="text" id="phone" placeholder="Nome" name="nome">
                        </div>  
                        
                        <label class="large-11 content-left horizontal-space " for="dataNascimento">Data Nascimento</label>
                        <div class="control large-15 content-right">
                            <input type="date" id="phone" placeholder="dd-mm-aaaa" name="dataNascimento">
                        </div>  
                        
                        <label class="large-5 content-left horizontal-space" for="genero">Genero</label>
                        <div class="control large-20 content-right">
                            <select name='genero' style='width:100%'>
                             <option value='1'>Feminino</option>
                             <option value='2'>Masculino</option>
                        </select>
                        </div>  
                        <br/><br/>
                        <label class="large-5 content-left " for="email">E-mail</label>
                        <div class="control large-15 content-right">
                            <input type="text" id="email" name='email' placeholder="E-mail">
                        </div> 
                       
                         <label class="large-13 content-left horizontal-space " for="telemovel">Telemóvel</label>
                        <div class="control large-15 content-right">
                            <input type="text" id="telemovel" name='telemovel' placeholder="Telemóvel" >
                        </div>  
                        
                        <label class="large-13 content-left horizontal-space" for="telefone">Telefone</label>
                        <div class="control large-15 content-right">
                            <input type="text" id="telefone" name='telefone' placeholder="Telefone">
                        </div>  
                        <br/><br/>
                        <label class="large-10 content-left horizontal-space" for="outroTelefone">Outro telefone</label>
                        <div class="control large-15 content-right">
                            <input type="text" id="outroTelefone" name='outroTelefone' placeholder="Outro telefone">
                        </div>  
                        <br/><br/>  
                        
                         <label class="large-10 content-left" for="habilitacoes">Habilitações</label>
                        <div class="control large-15 content-right">
                            <select name='habilitacoes' style='width:100%'>
                                <option value='1'><4ºano</option>
                                <option value='2'>1º Ciclo</option>
                                <option value='3'>2º Ciclo</option>
                                <option value='4'>3º Ciclo</option>
                                <option value='5'>Ensino Secundário</option>
                                <option value='6'>Ensino Superior</option>
                         </select>
                        </div>  
                        
                        <label class="large-10 content-left horizontal-space" for="gruposetarios">Grupo Etário</label>
                        <div class="control large-10 content-right">
                            <select name='gruposetarios' style='width:100%'>
                                <option value='1'><15</option>
                                <option value='2'>15-19</option>
                                <option value='3'>20-24</option>
                                <option value='4'>25-34</option>
                                <option value='5'>35-44</option>
                                <option value='6'>45-54</option>
                                <option value='7'>55-64</option>
                                <option value='8'>64</option>
                            </select>
                        </div>  
                        
                        <label class="large-5 content-left horizontal-space" for="NIF">NIF</label>
                        <div class="control large-25 content-right">
                            <input type="text" id="NIF" name='NIF' placeholder="Número de Identificação Fiscal">
                        </div>  
                        <br/><br/>
                        
                         <label class="large-10 content-left" for="estadoscivis">Estado Civil</label>
                        <div class="control large-15 content-right">
                            <select name='estadoscivis' style='width:100%'>
                                 <option value='1'>Solteiro/a</option>
                                 <option value='2'>Casado/a</option>
                                 <option value='3'>Viúvo/a</option>
                                 <option value='4'>Divorciado/a</option>
                                 <option value='5'>Comunhão</option>
                               </select>
                        </div>  
                        
                        <label class="large-10 content-left horizontal-space" for="concelho">Concelho</label>
                        <div class="control large-10 content-right">
                            <select name='concelho' style='width:100%'>
                                  <option value='1'>Barreiro</option>
                                  <option value='2'>Moita</option> 
                                </select> 
                        </div>  
                        
                        <label class="large-10 content-left horizontal-space" for="freguesia">Freguesia</label>
                        <div class="control large-35 content-right">
                            <select name='freguesia' style='width:100%'>
                                  <option value='1'>Alto do Seixalinho, Santo André e Verderena</option>
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
                        </div>  
                        <br/><br/>
                        
                        <label class="large-10 content-left" for="naturalidade">Naturalidade</label>
                        <div class="control large-15 content-right">
                            <input type="text" id="naturalidade" name='naturalidade' placeholder="Naturalidade">
                        </div>  
                        
                        <label class="large-10 content-left horizontal-space" for="Nacionalidade">Nacionalidade</label>
                        <div class="control large-15 content-right">
                            <input type="text" id="Nacionalidade" name='Nacionalidade' placeholder="Nacionalidade">
                        </div>  
                        <br/><br/>
                        <label class="large-15 content-left" for="situacaoregularizada">Situação regularizada</label>
                        <div class="control large-10 content-right">
                            <select name='situacaoregularizada' style='width:100%'>
                              <option value='1'>Sim</option>
                              <option value='2'>Não</option>
                           </select>
                        </div> 
                        <br/><br/>
                        
                        <label class="large-15 content-left" for="situacaoEmprego">Situação de Emprego</label>
                        <div class="control large-20 content-right">
                            <select name='situacaoEmprego' style='width:100%' onchange="verDiv(this.value)">
                                   <option value='-1'></option>
                                   <option value='1'>Empregado</option>
                                   <option value='2'>Desempregado</option>
                                   <option value='3'>Outra Situação</option>
                                   <option value='4'>Não responder</option>
                                   
                                   
                                   <!--<option value='Es'>Estudante</option>
                                   <option value='Es'>Estágio Profissional</option>
                                   <option value='Es'>Voluntariado</option>
                                   <option value='Es'>Formação subsidiada</option>
                                   <option value='Es'>Biscates</option>-->
                               </select>
                        </div>
                        
                        <div id='divEmpregado' style='display:none'>
                            campos quando um individuo está empregado
                        </div>
                        <div id='divDesempregado' style='display:none'>
                            campos quando um individuo está desempregado
                        </div>
                        <div id='divOutraSituacao' style='display:none'>
                            campos quando um individuo está em outra situação
                        </div>
                        <label class="large-17   content-left horizontal-space " for="escola">Estabelecimento de Ensino</label>
                        <div class="control large-25 content-right  ">
                            <input type="text" id="escola" name='escola' placeholder="Escola / Centro de Formação">
                        </div> 
                        <br/><br/>
                        
                        <label class="large-15 content-left" for="inscritonoce">Inscrito no CE</label>
                        <div class="control large-10 content-right">
                            <select name='inscritonoce' style='width:100%'>
                              <option value='1'>Sim</option>
                              <option value='2'>Não</option>
                           </select>
                        </div> 
                        
                         <label class="large-5 content-left horizontal-space" for="numeroCE">Nº EE?!?!?!?!</label>
                        <div class="control large-15 content-right">
                            <input type="text" id="numeroCE" name='numeroCE' placeholder="Número de .......">
                        </div>  
                         
                          <label class="large-11 content-left horizontal-space" for="dataInscricao">Data de inscrição</label>
                        <div class="control large-10 content-right">
                            <input type="date" id="dataInscricao" name='dataInscricao' placeholder="dd-mm-aaaa">
                        </div>  
                        <br/><br/>
                        <label class="large-10 content-left" for="estudante">Estudante</label>
                        <div class="control large-10 content-right">
                            <select name='estudante' style='width:100%'>
                              <option value='1'>Sim</option>
                              <option value='0'>Não</option>
                           </select>
                        </div> 
                        <br/><br/>
                        <label class="large-20 content-left" for="subsidioDesemprego">Subsidio de Desemprego</label>
                        <div class="control large-10 content-right">
                            <select name='subsidioDesemprego' style='width:100%'>
                              <option value='1'>Sim</option>
                              <option value='0'>Não</option>
                           </select>
                        </div> 
                        <br/><br/>
                        <br/><br/>
                        <label class="large-10 content-left" for="observacoes">Observações</label>
                        <div class="control large-100 content-right">
                            <input type="text" id="observacoes" name='observacoes' placeholder="Escreva aqui algo de importante não referido antes...">
                        </div> 
                        <br/><br/>
                        <input type="submit" value="Enviar" class='ink-button green'>
                    </div>
                  
                </fieldset>
            </form>
        </div>
              
        
        
     
      
        <?php
        //include('Formulario.html');
        include('footer.php');
        ?>
    </body>
</html>
      