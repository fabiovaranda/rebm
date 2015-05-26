<?php
include('importarBibliotecas.php');
include('menu.php');     
?>  
    <div class='showcase'>  
    <div class='ink-grid'>
       <div class='column-group gutters'>
        <div class='large-100'>
            <h3><font color='#1A9018'>Atividades e Eventos</font></h3>
        </div>
        <div class='large-50'>&nbsp;</div>
        <div class='large-20 push-right'>
            <?php
            if(isset($_SESSION['id']) && $_SESSION['idTiposDePermissoes'] == 1){
                echo"<br><a href='inserirFotografia.php'><input type='button' class='ink-button' value='Inserir Fotografia'><br><br>";
            }
            ?>
        </div>
    </div>
<?php
include_once('DataAccess.php');
$da = new DataAccess();
$fotografia = $da->getFotografias();
$conta = 0;
while ($linha = mysql_fetch_assoc($fotografia)){
    if ($conta == 0)
        echo "<div class='column-group gutters'>";

    echo "<div class='large-20 medium-20 small-33 content-center'>";
        if ( $linha['imagem'] == "")
            echo "<img src='membrosrede/SemImagem.jpg' width='100%' height='85px'/>";  
        else
            echo "
            <img class='clickable' id='".$linha['id']."' src= 'img/".$linha['imagem']."' alt=''><a href='#'></a>         
            <div class='ink-shade fade'>
                <div class='ink-modal' data-trigger='#".$linha['id']."' data-width='824px' data-height='549px' id='screenshot'>
                    <div class='modal-header'>
                        <button class='ink-dismiss modal-close'></button>
                    </div>
                    <div class='modal-body'>
                        <img src='img/".$linha['imagem']."'>
                    </div>
                </div>
            </div>
                ";  
    echo "</div>";
    $conta++;
    if ($conta == 5){
        echo "</div>";
        $conta=0;                
    }
}
?>
</div>
</div>
<?php
include('footer.php');
?>