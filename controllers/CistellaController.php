<?php
require_once 'models/ModelCistella.php';
class CistellaController {
    private $modelCesta;
    private $modelProductes;

    public function __construct($modelCesta) {
        $this->modelCesta = $modelCesta;
    }

    // Mostra la pàgina de la cesta de la compra
    public function mostrarCistella() {
        $productesEnCesta = $this->modelCesta->obtenirProductes();
        include 'VIEWS/cistella.php'; // La vista on es mostra la cesta
    }


}

