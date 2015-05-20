<?php
include_once('importarBibliotecas.php');
include_once('menu.php');
include_once('DataAccess.php');               
$da = new DataAccess();        
$bolsas = $da->verBolsasEmprego();  
$conta= 0;
?>
<div class='ink-grid'>
    
       <div class='column-group gutters'>
        <br/>
        <div class='large-50'>
            <h1><font color='#1A9018'>Bolsas de Emprego</font></h1>
        </div>
        <div class='large-20'>&nbsp;</div>
        <div class='large-30 push-right'>
            <?php
            if(isset($_SESSION['id'])){
                echo"<br><a href='criarBolsa.php'><input type='button' class='ink-button' value='Inserir Bolsa'>";
                echo"<a href='atualizarBolsa.php'><input type='button' class='ink-button' value='Editar Bolsa'></a>";
            }
            ?>
        </div>
    </div>
<?php
while($row = mysql_fetch_assoc($bolsas)){
    if ($conta == 0)
    echo "<div class='column-group gutters'>";
    echo "<div class='large-50 medium-50 small-50'>";
    echo "<fieldset style='-moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius:10px;'><font color='#1A9018'><center><b>".$row['titulo']."</b></br></font></center>";
    echo "<b><font color='#1A9018'>Data: </font></b><font color='black'>".$row['dataBolsa']."</font></br>";
    echo "<b><font color='#1A9018'>Empresa: </font></b><font color='black'>".$row['empresa']."</font></br>";
    echo "<b><font color='#1A9018'>País: </font></b><font color='black'>".$row['pais']."</font></br>";
    echo "<b><font color='#1A9018'>Distrito:</font> </b><font color='black'>".$row['distrito']."</font></br>";
    echo "<b><font color='#1A9018'>Descrição:</font></b> <font color='black'>".$row['descricao']."</font></br>";
    echo "<b><font color='#1A9018'>Requisitos:</font> </b><font color='black'>".$row['requisitos']."</font></br>";
    echo "<b><font color='#1A9018'>Oferece-se: </font></b><font color='black'>".$row['ofereceSe']."</font></br>";
    echo "</div>";
  
 
       $conta++;
            if ($conta == 2){
                echo "</div>";
                $conta=0;                
            }
        }
        if ($conta != 0)
            echo "</div>";
    
echo "</div>";
include_once('footer.php');
?>