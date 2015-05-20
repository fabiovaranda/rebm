
<?php
    
    function apenasDuasFrases($txt){
        $res = "";
        $contaPontos = 0;
        $res = "";
        $contaParagrafos = 0;
        for($i = 0;$i<strlen($txt); $i++){
            if($txt[$i] == "."){
                $res .= "."."</p>";
                $contaPontos++;
                if ($contaPontos==2)
                    return $res;
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
    
    function apenas50Caracteres($txt){
        $res = "";
        for($i = 0;$i<50; $i++){
            if($txt[$i]!= ""){
                $res.=$txt[$i];
            }
        }
        return $res."...";
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
		
		//$img_f = $imnfo[2];	  // extensão	
		//$img_m = $imnfo['mime']; // mime-type       
        
        if ($img_w>$img_h)    //largura > altura->horizontal
            return 1;
        else//largura < altura->vertical
            return -1;
    }
    
	function retirarPlicasAspas($txt){
		$txt = str_replace('"','´', $txt);
		$txt = str_replace("'",'´', $txt);
		//echo "<script>alert('".$txt."')</script>";
		return $txt;
	}
	
    include_once('DataAccess.php');
    $da = new DataAccess();
    $res = $da->verNoticias();
    $row = mysql_fetch_assoc($res);
    
?>

<div class='ink-grid'>
    <div class="column-group gutters">
        <div class="large-20">
            <br>
            <h3><font color="#1A9018">Notícias</font></h3>
            <br>
        </div>
        <div class='large-30'>&nbsp;</div>
        <div class='large-30 push-right'>
            <?php
            if(isset($_SESSION['id']) && $_SESSION['idTiposDePermissoes'] != 2 ){
                echo"<br><a href='inserirNoticias.php'><input type='button' class='ink-button' value='Inserir Noticias'>";
                
                echo"<a href='editarNoticias.php'><input type='button' class='ink-button' value='Editar Noticias'><br><br><br>";
            }
            ?>
        </div>
    </div>
	
    <div class="column-group gutters">
        <div class="large-70 medium-60 small-100">
            <div class="column-group gutters">
                <div class="large-10"></div>
                <div class="large-90">
                    <center>
                        <a href='noticia.php?i=<?php echo $row['id'] ?>'>
                        <?php
                        if ($row['imagemNoticia'] != ""){
                            $tipoImagem = verificarImagem('fotosNoticias/'.$row['imagemNoticia']);
                            if ($tipoImagem == 1)
                                echo "<img src='fotosNoticias/".$row['imagemNoticia']."' width='150px'>";
                            else
                                echo "<img src='fotosNoticias/".$row['imagemNoticia']."' height='300px'>";
                        }
                        ?>
                        </a>
                    </center>
                    <br>  
                    <b><?php echo $row['titulo']; ?></b>
                    <br><br>
                    <?php
                        echo retirarPlicasAspas($row['textoApresentacao']);
                        $row = mysql_fetch_assoc($res);
                    ?>    
                </div>
                <div class="large-10"></div>
                <div class="large-45">
                    <center>
                        <a href='noticia.php?i=<?php echo $row['id'] ?>'>
                        <?php
                        if ($row['imagemNoticia'] != ""){
                            $tipoImagem = verificarImagem('fotosNoticias/'.$row['imagemNoticia']);
                            if ($tipoImagem == 1)
                                echo "<img src='fotosNoticias/".$row['imagemNoticia']."' width='180px'>";
                            else
                                echo "<img src='fotosNoticias/".$row['imagemNoticia']."' height='330px'>";
                        }
                        ?>
                        </a>
                    </center>            
                    <br>
                    <b><?php echo $row['titulo']; ?></b>
                    <br><br>
                    <?php
                        echo $row['textoApresentacao'];
                        $row = mysql_fetch_assoc($res);
                    ?>
                </div>
                <div class="large-45">
                    <center>
                        <a href='noticia.php?i=<?php echo $row['id'] ?>'>
                        <?php
						
                        if ($row['imagemNoticia'] != ""){
                            $tipoImagem = verificarImagem('fotosNoticias/'.$row['imagemNoticia']);
                            if ($tipoImagem == 1)
                                echo "<img src='fotosNoticias/".$row['imagemNoticia']."' width='150px'>";
                            else
                                echo "<img src='fotosNoticias/".$row['imagemNoticia']."' height='300px'>";
                        }
						
                        ?>
                        </a>
                    </center>            
                    <br>
                    <b><?php echo $row['titulo']; ?></b>
                    <br><br>
                    <?php
                        echo $row['textoApresentacao'];
                    ?>
                </div>
            </div>  
        </div>
        <div class="large-30 medium-40 small-100" style='border: 0px solid;'>
            <nav class="ink-navigation large-100 align-right">
                <ul class="menu vertical grey rounded shadowed">
					
                    <?php
						$contador = 0;
					 
                        while($row = mysql_fetch_assoc($res)){
							$contador++;
							if ($contador == 6){
								break;
							}else{
								echo "<li>
										<a href='noticia.php?i=".$row['id']."'><b>";
											echo $row['titulo']; 
											echo "</b><br/>";
											echo $row['textoApresentacao']."<br/>";
								   echo "</a>
									  </li>";
							}
                        }
                    ?>
                </ul>
            </nav>
        </div>
    </div>


	
</div>
     
