<?php
$id = $_GET['i'];
include_once('DataAccess.php');
$da = new DataAccess();
$da->eliminarMensagem($id);
echo 
"<script>
    alert('A mensagem foi eliminada com sucesso');
    window.location='index.php';
</script>";
?>
