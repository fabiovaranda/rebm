<html>
    <head>
        <title>REBM</title>
        <?php
         include('importarBibliotecas.php');
        ?>
    </head>
    <body>
        <?php
        include('menu.php');
        ?>
    <div class='ink-grid'>
        <form class='ink-form'>
            <fieldset>
                <legend>Inserir Beneficiário</legend>
                <div class='control-group'>
                    <div class='control large-30 content-left'>
                        <label for='nome'>Nome</label> 
                         <input  type='text' placeholder='Nome' name='nome' id='nome'/>
                    </div>
                    <div class='control large-30 content-left'>
                            <label for='nome'>Data de Nascimento</label> 
                           <input  type='date' placeholder='dd-mm-aaaa' name='dataNascimento' id='dataNascimento'/> 
                    </div>
                    <div class='control large-20 content-left'>
                        <label for='nome'>Género</label> 
                        <select name='genero' style='width:70%'>
                             <option value='F'>Feminino</option>
                             <option value='M'>Masculino</option>
                        </select>
                    </div> 
                </div>
                <div class='control-group'>
                    <div class='control large-30'>
                         <label for='nome'>Telemóvel</label>    
                         <input  type='text' placeholder='Telemóvel' name='telemovel' id='telemovel'/>
                    </div> 
                     <div class='control large-30 content-left'> 
                          <label for='nome'>Telefone</label> 
                          <input  type='text' placeholder='Telefone' name='telefone' id='telefone'/>
                     </div>
                     <div class='control large-30 content-left'>
                          <label for='nome'>Outro Tel.</label>    
                          <input  type='text' placeholder='Telefone' name='telefone' id='telefone'/>
                     </div>
                </div>
                <div class='control-group'>
                    <div class='control large-30 content-left'>
                         <label for='nome'>Habilitações</label> 
                           <select name='gruposetarios' style='width:70%'>
                                <option value='<4ºano'><4ºano</option>
                                <option value='1º Ciclo'>1º Ciclo</option>
                                <option value='2º Ciclo'>2º Ciclo</option>
                                <option value='3º Ciclo'>3º Ciclo</option>
                                <option value='Ensino Secundário'>Ensino Secundário</option>
                                <option value='Ensino Superior'>Ensino Superior</option>
                         </select>
                     </div>
                     <div class='control large-30 content-left'>
                          <label for='nome'>Grupo Etário</label>
                            <select name='gruposetarios' style='width:70%'>
                                <option value='<15'><15</option>
                                <option value='15-19'>15-19</option>
                                <option value='20-24'>20-24</option>
                                <option value='25-34'>25-34</option>
                                <option value='35-44'>35-44</option>
                                <option value='45-54'>45-54</option>
                                <option value='55-64'>55-64</option>
                                <option value='>64'>>64</option>
                            </select>
                    </div>
                    <div class='control large-30 content-left'>
                         <label for='nome'>NIF</label>    
                         <input  type='text' placeholder='NIF' name='nif' id='nif'/>
                    </div>
                  </div>
                    <div class='control-group'>
                        <div class='control large-20 content-left'>
                             <label for='nome'>Estado Civil</label>    
                               <select name='estadoscivis' style='width:60%'>
                                 <option value='S'>Solteiro/a</option>
                                 <option value='C'>Casado/a</option>
                                 <option value='V'>Viúvo/a</option>
                                 <option value='D'>Divorciado/a</option>
                                 <option value='COM'>Comunhão</option>
                               </select> 
                         </div>
                         <div class='control large-20 content-left'>
                              <label for='nome'>Conselho</label> 
                                <select name='conselhos' style='width:60%'>
                                  <option value='B'>Barreiro</option>
                                  <option value='M'>Moita</option> 
                                </select> 
                        </div>
                        <div class='control large-35 content-left'>
                             <label for='nome'>Freguesia</label>   
                               <select name='freguesias' style='width:90%'>
                                  <option value='A,S,V'>Alto do Seixalinho, Santo André e Verderena</option>
                                  <option value='B,L'>Barreiro e Lavradio</option>
                                  <option value='P,C'>Palhais e Coina</option>
                                  <option value='SAC'>Santo António da Charneca</option>
                                  <option value='AV'>Alhos Vedros</option>
                                  <option value='BB'>Baixa da Banheira</option>
                                  <option value='GR'>Gaio-Rosário</option>
                                  <option value='M'>Moita</option>
                                  <option value='SP'>Sarilhos Pequenos</option>
                                  <option value='VA'>Vale da Amoreira</option>
                               </select>
                        </div>
                    </div> 
                    <div class='control-group'>
                       <div class='control large-30 content-left'>
                            <label for='nome'>Naturalidade</label> 
                             <input  type='text' placeholder='Naturalidade' name='naturalidade' id='naturalidade'/>
                       </div> 
                       <div class='control large-30 content-left'>
                            <label for='nome'>Nacionalidade</label> 
                            <input  type='text' placeholder='Nacionalidade' name='nacionalidade' id='nacionalidade'/>
                       </div>
                    </div>
                    <div class='control-group'>
                       <div class='control large-20 content-left'>
                         <label for='nome'>Situação regularizada</label> 
                           <select name='situacaoregularizada' style='width:70%'>
                              <option value='S'>Sim</option>
                              <option value='N'>Não</option>
                           </select>
                      </div> 
                   </div> 
                    <div class='control-group'>
                       <div class='control large-20 content-left'>
                            <label for='nome'>Situação de Empregado</label> 
                               <select name='genero' style='width:70%'>
                                   <option value='E'>Empregado</option>
                                   <option value='D'>Desempregado</option>
                                   <option value='Es'>Estudante</option>
                               </select>
                       </div> 
                    </div>
                    <div class='control-group'>
                       <div class='control large-20 content-left'>
                         <label for='nome'>Inscrito no CE</label> 
                           <select name='inscritonoce' style='width:70%'>
                              <option value='S'>Sim</option>
                              <option value='N'>Não</option>
                           </select> 
                      </div> 
                      <div class='control large-25 content-left'>
                            <label for='nome'>Nº EE</label> 
                            <input  type='text' placeholder='numerodeEE' name='numerodeEE' id='numerodeEE'/>
                      </div> 
                      <div class='control large-15 content-left'>
                            <label for='nome'>Data de inscrição</label> 
                            <input  type='text' placeholder='datadeinscricao' name='datadeinscricao' id='datadeinscricao'/>
                      </div>  
                   </div>
                       <br>
                       <br>
                       <br>
                       <br>
                   <div class='control-group'>
                      <div class='control large-30'>
                           <label for='nome'>Observações</label>    
                           <input  type='text' placeholder='Observações' name='observacoes' id='observacoes'/>
                      </div>
                   </div>
                        </form>
                           </fieldset>
   </div>
              
              
              
        
        
     
      
        <?php
        //include('Formulario.html');
        include('footer.php');
        ?>
    </body>
</html>
      