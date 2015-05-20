<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
<script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar esta Bolsa?')){
            window.location='eliminarBolsa.php?i='+i;
        }
    }
    

</script>
<?php
include('importarBibliotecas.php');
include('menu.php');
?>

<div class='ink-grid'>
<form class="ink-form "class="ink" method='post' action='EditarBolsa.php'>
                <br>
                <legend><h1><font color='#1A9018'>Pesquisar Bolsa</font></h1></legend>
                <br>
                <br>
                <input type='text' name='tituloP' placeholder='Insira aqui a bolsa'/>
                <input type='submit' class="ink-button green" value='Pesquisar'/>
                <br>
                <br>
        </form>
</div>
        <?php
        //caso o campo nomeP (nome no campo de pesquisa de bolsa esteja preenchido,
        //irá ser incluida a página editarBolsa.php
            if (isset($_POST['tituloP'])){
            include_once('editarBolsa.php');
            }


if(isset($_POST['tituloP'])){
    //mostra formulário para atualizar
    $titulo = $_POST['tituloP'];
    include_once('DataAccess.php');
    $da = new DataAccess();
    $res = $da->pesquisarBolsa($titulo);
    while($row = mysql_fetch_assoc($res)){      
        
        echo "
            <div class='ink-grid'>
            <form class='ink-form' method='post' action='editarBolsa.php'
                <fieldset>
                    <legend><h5><font color='#1A9018'>Atualizar Bolsa</font></h5></legend>
                    <br>
                    <input type='hidden' name='idA' value ='".$row['id']."'/>
                    <input type='text' name='tituloA' value='".$row['titulo']."' placeholder='titulo'/>
                    <input type='text' name='empresaA' value='".$row['empresa']."' placeholder='empresa'/>
                    <input type='text' name='paisA' value='".$row['pais']."' placeholder='país'/>
                    <input type='text' name='distritoA' value='".$row['distrito']."' placeholder='distrito'/>
                    <input type='text' name='descricaoA' value='".$row['descricao']."' placeholder='descrição'/>
                    <input type='text' name='dataBolsaA' value='".$row['dataBolsa']."' placeholder='data'/>
                    <input type='text' name='requisitosA' value='".$row['requisitos']."' placeholder='requisitos'/>
                    <input type='text' name='ofereceSeA' value='".$row['ofereceSe']."' placeholder='oferece-se'/>
                    <input type='submit' class='ink-button green' value='Atualizar'/>
                   <!-- <a href='eliminarBolsa.php?i=".$row['id']."' style='text-decoration:none'>
                        <input type='button' class='ink-button red' value='Eliminar'/>
                    </a>-->
                    <input type='button' class='ink-button red' onclick='confirmacaoEliminacao(".$row['id'].")' value='Eliminar'/>
                        <br>
                        <br>
                </fieldset>
            </form>
            </div>";
    }
}

if(isset($_POST['tituloA'])){
    //atualizar o membro
    $titulo = $_POST['tituloA'];
    $descricao = $_POST['descricaoA'];
    $dataBolsa = $_POST['dataBolsaA'];
    $requisitos = $_POST['requisitosA'];
    $ofereceSe = $_POST['ofereceSeA'];
    $distrito = $_POST['distritoA'];
    $empresa = $_POST['empresaA'];
    $pais = $_POST['paisA'];    
    $id = $_POST['idA'];
    include_once('DataAccess.php');
    $da = new DataAccess();
    $da->EditarBolsa($titulo,$dataBolsa,$empresa,$pais,$distrito,$descricao,$requisitos,$ofereceSe,$id);
         
    echo 
    "<script>alert('A bolsa foi atualizada com sucesso'); 
             //   window.location='index.php';
            </script>";
}
include('footer.php');
?>
