<?php
class ModelCesta {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['cesta'])) {
            $_SESSION['cesta'] = [];
        }
    }

    // Afegeix un producte a la cesta
    public function afegirProducte($idProducte, $quantitat, $preu) {
        if (!isset($_SESSION['cesta'][$idProducte])) {
            $_SESSION['cesta'][$idProducte] = ['quantitat' => 0, 'preu' => $preu];
        }
        $_SESSION['cesta'][$idProducte]['quantitat'] += $quantitat;
    }

    // Elimina un producte de la cesta
    public function eliminarProducte($idProducte) {
        if (isset($_SESSION['cesta'][$idProducte])) {
            unset($_SESSION['cesta'][$idProducte]);
        }
    }

    // Retorna tots els productes de la cesta
    public function obtenirProductes() {
        return $_SESSION['cesta'];
    }

    // Actualitza la quantitat d'un producte específic

    public function actualitzarQuantitat($idProducte, $novaQuantitat) {
        // Comprovar que el producte existeix i que la nova quantitat és vàlida
        if (isset($_SESSION['cesta'][$idProducte]) && $novaQuantitat > 0) {
            $_SESSION['cesta'][$idProducte]['quantitat'] = $novaQuantitat;
        } elseif (isset($_SESSION['cesta'][$idProducte]) && $novaQuantitat <= 0) {
            // Si la nova quantitat és 0 o menys, eliminar el producte de la cistella
            $this->eliminarProducte($idProducte);
        }
    }
    public function buidarCesta(){
        $_SESSION['cesta'] = [];
    }
        

    public function guardarComandaEnBaseDeDatos() {
        $db = new PDO('mysql:host=tu_servidor;dbname=tu_base_de_datos', 'tu_usuario', 'tu_contrasena');

        $cesta = $this->obtenirProductes();

        foreach ($cesta as $idProducte => $detalles) {
            $quantitat = $detalles['quantitat'];
            $preu = $detalles['preu'];

            $stmt = $db->prepare("INSERT INTO comandes (id_producte, quantitat, preu) VALUES (:id_producte, :quantitat, :preu)");
            $stmt->execute(['id_producte' => $idProducte, 'quantitat' => $quantitat, 'preu' => $preu]);
        }
        
        $this->buidarCesta();

        header("Location: confirmacio.php");
        exit();
    }
}

