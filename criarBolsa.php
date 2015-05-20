<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>

<?php
         include_once('importarBibliotecas.php');
         include_once('menu.php'); 	
?>
    <div class='ink-grid'>
    <br>
    <form method='post' class='ink-form' action='criarBolsa.php'>
        <h3> <font color='#1A9018'> Inserir Bolsa </font></h3>
            <table width='100%' border='0'>
            <tr>
                <td width='33%'>
                    <input type='text' style='width:90%' name='titulo' placeholder='Título'/>  
                </td>
                <td width='33%'>
                    <input type='text' style='width:90%' name='dataBolsa' class='ink-datepicker' placeholder='Data da Bolsa'/>   
                </td>
                <td width='34%'>
                    <input type='text' style='width:90%' name='empresa' placeholder='Empresa'/>  
                </td>
            </tr>
            <tr>
                <td width='33%'>
                    <input type='text' style='width:90%' name='pais' placeholder='País'/>  
                </td>
                <td width='33%'>
                      <input type='text' style='width:90%' name='ofereceSe' placeholder='Oferece'/>
                </td>
                <td width='34%'>
                       <input type='text' style='width:90%' name='requisitos' placeholder='Requisitos'/>          
                </td>
            </tr>
            <tr>
                <td width='33%'>
                    <select name='tipoBolsa' style='width:90%'>
                    <option value='1'> Formação </option>
                    <option value='2'> Emprego </option>
                    </select> 
                </td>
                <td width='33%'>               
                      <select name='Distrito'style='width:90%'>
                        <option value='1'>Distrito de Aveiro</option>
                        <option value='2'>Distrito de Beja</option>
                        <option value='3'>Distrito de Braga</option>
                        <option value='4'>Distrito de Bragança</option>
                        <option value='5'>Distrito de Castelo Branco</option>
                        <option value='6'>Distrito de Coimbra</option>
                        <option value='7'>Distrito de Évora</option>
                        <option value='8'>Distrito de Faro</option>
                        <option value='9'>Distrito da Guarda</option>
                        <option value='10'>Distrito de Leiria</option>                    
                        <option value='11'>Distrito de Lisboa</option>
                        <option value='12'>Distrito de Portalegre</option>
                        <option value='13'>Distrito do Porto</option>
                        <option value='14'>Distrito de Santarém</option>
                        <option value='15'>Distrito de Setúbal</option>
                        <option value='16'>Distrito de Viana do Castelo</option>
                        <option value='17'>Distrito de Vila Real</option>
                        <option value='18'>Distrito de Viseu</option>
                        <option value='19'>Distrito de Angra do Heroísmo</option>
                        <option value='20'>Distrito do Funchal</option>
                        <option value='21'>Distrito da Horta</option>
                        <option value='22'>Distrito de Lamego</option>
                        <option value='23'>Distrito de Ponta Delgada</option>
                      </select> 
                </td>             
                <td width='34%'>       </td>   
            </tr>
            <tr>
                <td colspan='3'>
                    <br/>   
                    <textarea id='text-input'  name='descricao' cols='150' rows='6' placeholder='Insira a descrição'></textarea>           
                    <br><br> 
                </td>
            </tr>
            <tr>
                <td colspan='3'>
                    <input type='submit' class='ink-button green' value='Inserir' /> 
                </td>
            </tr>
            </table>
        </form>      
     </div>
    
    <?php
    if ( isset ($_POST['titulo'])){
        $titulo = $_POST['titulo'];
        $dataBolsa = $_POST['dataBolsa'];
        $empresa = $_POST['empresa'];
        $pais = $_POST['pais'];
        $distrito = $_POST['distrito'];
        $descricao = $_POST['descricao'];
        $requisitos = $_POST['requisitos'];
        $ofereceSe = $_POST['ofereceSe'];
        $idTipoBolsa = $_POST['tipoBolsa'];
        include_once('DataAccess.php');
        $da = new DataAccess();
        $da->criarBolsa($titulo,$dataBolsa,$empresa,$pais,$distrito,$descricao,$requisitos,$ofereceSe,$idTipoBolsa);     
        
        echo "<script>
        alert('Inserido com sucesso');
        window.location='index.php';
        </script>";
    }

include_once("footer.php");     
?>
            