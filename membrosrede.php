<?php
    include ("importarBibliotecas.php");
?>
<body>
    <?php
        include ("menu.php");
    ?>
<div class='ink-grid'>
       <div class='column-group gutters'>
        <br/>
        <div class='large-50'>
            <h3><font color='#1A9018'>Membros da Rede</font></h3>
        </div>
        <div class='large-20'>&nbsp;</div>
        <div class='large-30 push-right'>
            <?php
            if(isset($_SESSION['id']) && $_SESSION['idTiposDePermissoes'] == 1){
                echo"<br><a href='inserirMembro.php'><input type='button' class='ink-button' value='Inserir Membro'>";
                echo"<a href='editarMembro.php'><input type='button' class='ink-button' value='Editar Membro'></a>";
            }
            ?>
        </div>
    </div>
    <?php
    include_once('DataAccess.php');
        $da = new DataAccess();
        $membros = $da->getMembros();
        $conta = 0;
        while ($linha = mysql_fetch_assoc($membros)){
            if ($conta == 0)
                echo "<div class='column-group gutters'>";
            
            echo "<div class='large-20 medium-20 small-33 content-center'>";
                if ( $linha['logotipo'] == "")
                    echo "<a href='".$linha['link']."' target='_blank'><img src='membrosrede/SemImagem.jpg' width='100%' height='85px'/></a>";  
                else
                    echo "<a href='".$linha['link']."' target='_blank'><img src='membrosrede/".$linha['logotipo']."' style='width:100px'/></a>";  
                 echo "<br/>".$linha['nome'];
            echo "</div>";
            $conta++;
            if ($conta == 5){
                echo "</div>";
                $conta=0;                
            }
        }
        if ($conta != 0)
            echo "</div>";
        ?>
</div>
 <?php
        include ("footer.php");
 ?>  
</body>
</html>
 