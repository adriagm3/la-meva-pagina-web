<?php


require_once '/home/TDIW/tdiw-a1/public_html/models/ModelCistella.php';
$cesta = new ModelCesta();

if (isset($_POST['buidarCistella'])) {
    $cesta->buidarCesta();
}
header('Location: /../index.php?action=cistella'); 
exit;
