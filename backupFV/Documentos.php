<?php
include_once('importarBibliotecas.php');
include_once('menu.php');
?>
<div class="ink-grid">
    <div class="column-group gutters">
        <br/>
        <div class="large-30">
            <h3><font color="#1A9018">Documentos</font></h3>
        </div>
        <div class="large-30">&nbsp;</div>
        <div class="large-40 push-right">
            <?php
            if(isset($_SESSION['id']) && $_SESSION['idTiposDePermissoes'] == 1){
                echo"<br><a href='inserirDocumentos.php'><input type='button' class='ink-button' value='Inserir Documento'>";
                echo"<a href='EditarDocumento.php'><input type='button' class='ink-button' value='Atualizar Documento'></a>";
            }
            ?>
        </div>
    </div>
    <div class="column-group gutters">
        <!--2ª linha-->
        <div class="large-30">
            <img src="img/ambito.rede.jpg">
        </div>
        <div class="large-70">
        <?php
			function getImage($nome){
				//echo "<script>alert('".$nome."')</script>";
				$aux = explode(".", $nome);
				//echo "<script>alert('".$aux[1]."')</script>";
				if($aux[1] == "pdf")
					return "pdf.png";
				else
					return "xlsx.png";
			}
            include_once('DataAccess.php');
            $da = new DataAccess();
            if(isset($_GET['p'])){
                //estamos dentro de uma pasta
                $resPastas = $da->getSubpastas($_GET['p']);
                
                while ($rowPastas = mysql_fetch_assoc($resPastas)){
                    echo "<p><a href='Documentos.php?p=".$rowPastas['id']."'><img src='img/folder.png' width='10px'/>".$rowPastas['pastaReal']."</a></p>";
                }	
                
                $documento = $da->getDocumentosPorPasta($_GET['p']);
                while ($linha = mysql_fetch_assoc($documento)){
                    echo "<p><a href='Documentos/".$linha['documento']."' target='_blank'><img src='img/".getImage($linha['documento'])."'>".$linha['nome']."</a></p>";

                }		
                
            }else{
                $resPastas = $da->getPastasMae();
                while ($rowPastas = mysql_fetch_assoc($resPastas)){
                    echo "<p><a href='Documentos.php?p=".$rowPastas['id']."'><img src='img/folder.png' width='10px'/>".$rowPastas['pastaReal']."</a></p>";
                }	
            }
            
         
        ?>    
        </div>
    </div>
</div>
<?php
    include_once ('footer.php');
?>