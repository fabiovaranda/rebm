<?php
$id = $_GET['i'];
include_once('DataAccess.php');
$da = new DataAccess();
$da->eliminarEventos($id);
echo 
"<script>
    alert('O seu Evento foi eliminado com sucesso');
    window.location='index.php';
</script>";
?>
