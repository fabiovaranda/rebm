<?php

 include_once('DataAccess.php');
        $da = new DataAccess();
        $Eventos = $da->getEventos();
        $conta = 0;      
?>
<div class='ink-grid'>
     <div class='column-group gutters'>
        <br/>
        <div class='large-50'>
            <h1><font color='#1A9018'>Eventos</font></h1>
        </div>
        <div class='large-20'>&nbsp;</div>
        <div class='large-30 push-right'>
            <?php
            if(isset($_SESSION['id'])){
                echo"<br><a href='inserirEventos.php'><input type='button' class='ink-button' value='Inserir Evento'>";
                echo"<a href='atualizarEvento.php'><input type='button' class='ink-button' value='Editar Evento'></a>";
            }
            ?>
        </div>
    </div>
    
<?php
        while ($row = mysql_fetch_assoc($Eventos)){
            if ($conta == 0)
                echo "<div class='column-group gutters'>";
            
            echo "<div class='large-25 content-center'>";
            if ($row['imagem'] == "")
                     echo "<img src='img/SemImagem.jpg' width='150px' height='100px'/><br><br>";
                else
                     echo "<img src='fotosEventos/".$row['imagem']."' width='150px' height='100px'/><br><br>";
                  echo "<div style='text-align:left'><b><fieldset style='-moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius:10px;'>
                         <b>".$row['nome']."</b><br/><br/><font color='black'>em <i>".$row['data']."</i></font><br>";
            
                     echo "<br/><font color='black'>".$row['descricao']."</font></fieldset></br>";
                echo "</div>";
            echo "</div>";
            
            
            $conta++;
            if ($conta == 4){
                echo "</div>";
                $conta=0;                
            }
        }
        if ($conta != 0)
            echo "</div>";
        ?>
</div>
 







