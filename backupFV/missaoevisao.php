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
            <h3><font color='#1A9018'>Missão e Visão</font></h3>
        </div>
        <div class='large-30'>&nbsp;</div>
        <div class='large-20 push-right'>
            <?php
            if(isset($_SESSION['id']) && $_SESSION['idTiposDePermissoes'] == 1){
                echo"<a href='editarMissao.php'><input type='button' class='ink-button' value='Editar Missão'></a>";
            }
            ?>
        </div>
    </div>
 
  <div class="column-group gutters">
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
				$res = $da->getMissao();
				$row = mysql_fetch_object($res);
				echo $row->texto;
			?><br/><br/><br/>
         </div>
       </div>
  </div>
</div>
	   
	   
	   <?php
        include('footer.php');
        ?>
  
  
    </body>