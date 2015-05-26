<?php
$id = $_GET['i'];
include_once('DataAccess.php');
$da = new DataAccess();
$da->removerBolsa($id);
echo "<script>
    alert('A Bolsa foi eliminada com sucesso.');
    window.location='index.php';
</script>";
?>