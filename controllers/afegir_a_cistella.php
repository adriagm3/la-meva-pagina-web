<?php
require_once '/home/TDIW/tdiw-a1/public_html/models/ModelCistella.php';


$cesta=new ModelCesta();

if (isset($_POST['id_producte']) && isset($_POST['quantitat'])) {
    $idProducte = intval($_POST['id_producte']); // Convertir a enter per seguretat
    $quantitat = intval($_POST['quantitat']); // Convertir a enter per seguretat
    $preu = intval($_POST['preu']);

    // Potser vols afegir més validacions aquí
} else {
    // Redirigir o mostrar un missatge d'error si no es reben les dades necessàries
    echo 'Error no id producte o quantitat';
    exit;
}
$cesta->afegirProducte($idProducte, $quantitat, $preu);
// Redirigir a la pàgina de la cistella o al producte
header('Location: /../index.php?action=cistella'); 
exit;

