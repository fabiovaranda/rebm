<?php
include_once('importarBibliotecas.php');
include_once('menu.php');
if (isset($_GET['i'])){
    include_once 'DataAccess.php';
    $da = new DataAccess();
    $res = $da->getNoticia($_GET['i']);
    $row = mysql_fetch_assoc($res);
    
}

    function inserirParagrafo($txt){
        $res = "";
        $contaParagrafos = 0;
        for($i = 0;$i<strlen($txt); $i++){
            if($txt[$i] == "."){
                $res .= "."."</p>";
                $contaParagrafos = 0;
            }else{
                if ($contaParagrafos == 0){
                    $res.="<p align='justify'>";
                    $contaParagrafos++;
                }
                $res .= $txt[$i];
            }
                
        }
        $res.="<br/><br/>";
        return $res;
    }
    
    function verificarImagem($source){
        $imnfo = getimagesize($source);
	$img_w = $imnfo[0];	  // largura
       
	$img_h = $imnfo[1];	  // altura
       
	$img_f = $imnfo[2];	  // extensão
       
	$img_m = $imnfo['mime']; // mime-type
       
        
        if ($img_w>$img_h){
            //largura > altura->horizontal
            return 1;
        }else{
            //largura < altura->vertical
            return -1;
        }
    }
    ?>

<div class='ink-grid'>
    <div class="column-group gutters">
        <div class="large-100">
            <br>
            <h3><font color="#1A9018"><b><?php echo($row['titulo']); ?></b></font></h3>
            <br>
        </div>
		
		<?php
			if ($row['poster'] == 1){
				echo "<div class='large-15'>&nbsp;</div>
						<div class='large-70'><center><img src='fotosNoticias/".$row['imagemNoticia']."' width='250px'></center></div>
					  <div class='large-15'>&nbsp;</div>";
			}else{
		?>
        <div class="large-30 medium-30">
			<?php
				$tipoImagem = verificarImagem('fotosNoticias/'.$row['imagemNoticia']);
				
				if ($tipoImagem == 1)
					echo "<img src='fotosNoticias/".$row['imagemNoticia']."' width='150px'>";
				else
					echo "<img src='fotosNoticias/".$row['imagemNoticia']."' height='300px'>";
			
			?>
        </div>
		<?php 
			}
		?>
        <div class="large-65 medium-65">
            <?php
				echo $row['texto'];
			?>
        </div>
    </div>
</div>    

        <br><br>
        <br>
        <br>
        <?php include_once('footer.php'); ?>
        