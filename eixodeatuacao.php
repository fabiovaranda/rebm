<?php
 include('importarBibliotecas.php');
?> 
    <body>
        <?php
        include('menu.php');
       ?>
	   <div class="ink-grid">
	     <div class='column-group gutters'>
        <br/>
        <div class='large-50'>
            <h3><font color='#1A9018'>Eixos de Atuação</font></h3>
        </div>
        <div class='large-20'>&nbsp;</div>
        <div class='large-30 push-right'>
            <?php
            if(isset($_SESSION['id']) && $_SESSION['idTiposDePermissoes'] == 1){
                echo"<a href='editarEixosdeAtuacao.php'><input type='button' class='ink-button' value='Editar Eixos de Atuação'></a>";
            }
            ?>
        </div>
    </div>
	
 
  <div class="column-group">
      <div class="ink-grid">   
        <div class="large-30 medium-30 small-30">
            <img src="img/112.jpg">
        </div>
        <div class="large-5 medium-5 small-5">
            &nbsp;
        </div>
        <div class="large-65 medium-65 small-65">
            <?php
				include_once 'DataAccess.php';
				$da = new DataAccess();
				$res = $da->getEixosdeAtuacao();
				$row = mysql_fetch_object($res);
				echo $row->Texto;
			?><br/><br/>
         </div>
       </div>
  </div>
</div>
	   
	   
	   <?php
        include('footer.php');
        ?>
  
  
    </body>

