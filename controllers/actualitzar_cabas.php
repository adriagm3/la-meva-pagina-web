<?php


require_once '/home/TDIW/tdiw-a1/public_html/models/ModelCistella.php';

$cesta = new ModelCesta();

// Comprova si els paràmetres s'han enviat
if (isset($_POST['id_producte']) && isset($_POST['quantitat'])) {
    $idProducte = $_POST['id_producte'];
    $quantitat = $_POST['quantitat'];

    // Actualitza la quantitat del producte
    $cesta->actualitzarQuantitat($idProducte, $quantitat);
}


    header('Location: /../index.php?action=cistella'); 
    exit;

