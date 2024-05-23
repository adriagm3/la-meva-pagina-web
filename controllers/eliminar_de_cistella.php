<?php
require_once '/home/TDIW/tdiw-a1/public_html/models/ModelCistella.php';


if (isset($_POST['id_producte'])) {
    $idProducte = $_POST['id_producte'];

    $cesta = new ModelCesta();
    $cesta->eliminarProducte($idProducte);
}

header('Location: /../index.php?action=cistella'); 

exit;
    