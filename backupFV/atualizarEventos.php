<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
<script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar este Evento?')){
            window.location='eliminarEventos.php?i='+i;
        }
    }
    

</script>
<?php
include('importarBibliotecas.php');
include('menu.php');
?>

<div class='ink-grid'>
<form class="ink-form "class="ink" method='post' action='atualizarEventos.php'>
                <br>
                <legend><h1><font color='#1A9018'>Pesquisar Evento</font></h1></legend>
                <br>
                <br>
                <input type='text' name='nomeP' placeholder='Insira aqui o evento'/>
                <input type='submit' class="ink-button green" value='Pesquisar'/>
                <br>
                <br>
        </form>
</div>
        <?php
        //caso o campo nomeP (nome no campo de pesquisa de EVENTO esteja preenchido,
        //irá ser incluida a página atualizarEventos.php
            if (isset($_POST['nomeP'])){
            include_once('atualizarEventos.php');
            }


if(isset($_POST['nomeP'])){
    //mostra formulário para atualizar
    $nome = $_POST['nomeP'];
    include_once('DataAccess.php');
    $da = new DataAccess();
    $res = $da->pesquisarEventos($nome);
    while($row = mysql_fetch_assoc($res)){      
        
        echo "
            <div class='ink-grid'>
            <form class='ink-form' method='post' action='atualizarEventos.php'
                <fieldset>
                    <legend><h5><font color='#1A9018'>Atualizar Eventos</font></h5></legend>
                    <br>
                    <input type='hidden' name='idA' value ='".$row['id']."'/>
                    <input type='text' name='nomeA' value='".$row['nome']."' placeholder='nome'/>
                   <input type='text' name='descricaoA' value='".$row['descricao']."' placeholder='descrição'/>
                        <input type='text' name='dataA' value='".$row['data']."' placeholder='data'/>
                    <input type='submit' class='ink-button green' value='Atualizar'/>
                   <!-- <a href='eliminarEventos.php?i=".$row['id']."' style='text-decoration:none'>
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

if(isset($_POST['nomeA'])){
    //atualizar o membro
    $nome = $_POST['nomeA'];
    $descrição = $_POST['descricaoA'];
    $data = $_POST['dataA'];
        
    $id = $_POST['idA'];
    include_once('DataAccess.php');
    $da = new DataAccess();
    $da->atualizarEventos($nome,$data, $descrição,$id);
    echo 
    "<script>alert('O seu Evento foi atualizado com sucesso'); 
                window.location='index.php';
            </script>";
}
include('footer.php');
?>
