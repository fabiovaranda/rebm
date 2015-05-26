<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
<script>
    function confirmacaoEliminacao(id){
        if(confirm('Tem a certeza que pretende eliminar a Bolsa?')){
            window.location='eliminarBolsa.php?i='+id;
        }
    }
</script>

<?php
include('importarBibliotecas.php');
include('menu.php');

?>

<div class='ink-grid'>
 <form class="ink-form" class="ink" method='post'action='atualizarBolsa.php'>
 <br>
 <br> 
 <legend><h1><font color='#1A9018'>Pesquisar Bolsa</font></h1></legend>
 <br> 
 <input type='text' name='nomeP' placeholder='Insira aqui a Bolsa'/> 
 <input type='submit' class="ink-button green" value='Pesquisar'/> 
 <br> 
 <br> 
 </form> 
 </div>

<?php
if (isset($_POST['nomeP'])){
include_once('atualizarBolsa.php'); 

}

if(isset($_POST['nomeP'])){
    //mostrar formulário para atualizar
    $nome = $_POST['nomeP'];
    include_once('DataAccess.php');
    $da = new DataAccess();
    $res = $da->pesquisarBolsa($nome);
    while($row = mysql_fetch_assoc($res)){
        echo"
<div class='ink-grid'>
    <br>
    <form method='post' class='ink-form' action='atualizarBolsa.php' enctype'multipart/form-data'>
        <h2> <font color='black'> Editar Bolsa </font></h2>
            <table width='100%' border='0'>
            <tr>
                <td width='33%'>
                    <input type='text' style='width:90%' name='tituloA' value='".$row['titulo']."' placeholder='Título'/>  
                </td>
                <td width='33%'>
                    <input type='text' style='width:90%' name='dataBolsaA' class='ink-datepicker' value='".$row['dataBolsa']."' placeholder='Data da Bolsa'/>   
                </td>
                <td width='34%'>
                    <input type='text' style='width:90%' name='empresaA'value='".$row['empresa']."' placeholder='Empresa'/>  
                </td>
            </tr>
            <tr>
                <td width='33%'>
                    <input type='text' style='width:90%' name='paisA'value='".$row['pais']."' placeholder='País'/>  
                </td>
                <td width='33%'>
                      <input type='text' style='width:90%' name='ofereceSeA'value='".$row['ofereceSe']."' placeholder='Oferece'/>
                </td>
                <td width='34%'>
                       <input type='text' style='width:90%' name='requisitosA'value='".$row['requisitos']."' placeholder='Requisitos'/>          
                </td>
            </tr>
            <tr>
                <td width='33%'>
                    <select name='tipoBolsa' value='".$row['idTipoBolsa']."' style='width:90%'>
                    <option value='1'> Formação </option>
                    <option value='2'> Emprego </option>
                    </select> 
                </td>
                <td width='33%'>               
                      <select name='Distrito'value='".$row['distrito']."'style='width:90%'>
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
                    <textarea id='text-input'  name='descricaoA' value='".$row['descricao']."' cols='150' rows='6' placeholder='Insira a descrição'></textarea>           
                    <br><br> 
                </td>
            </tr>
            <tr>
                <td colspan='3'>
                    <input type='submit' class='ink-button green' value='Editar' />
                    <input type='button' class='ink-button red' onclick='confirmacaoEliminacao(".$row['id'].")' value='Eliminar'/>

                </td>
            </tr>
            </table>
        </form>      
     </div>";
    }
}
if(isset($_POST['tituloA'])){
    //atualizar a conta de Utilizador
    $id = $_POST['idA'];
    $titulo = $_POST['tituloA'];
    $dataBolsa = $_POST['dataBolsaA'];
    $empresa = $_POST['empresaA'];
    $pais = $_POST['paisA'];
    $distrito = $_POST['distritoA'];
    $descricao = $_POST['descricaoA'];
    $requisitos = $_POST['requisitosA'];
    $ofereceSe = $_POST['ofereceA'];
    $tipo = $_POST['TipoA'];
    
    include_once('DataAccess.php');
    $da = new DataAccess();
    $da->atualizarBolsa($id,$titulo,$dataBolsa,$empresa,$pais,$distrito,$descricao,$requisitos,$ofereceSe,$tipo);
    echo
    "<script>alert('A Bolsa foi atualizada com sucesso'); 
                window.location='index.php';
            </script>";
}
include('footer.php')
?>