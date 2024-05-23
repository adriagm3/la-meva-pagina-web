

<?php 
require_once '../database.php';
$db = Database::getConnection();
// Comprovar si s'ha proporcionat un ID de producte
// Agafar l'ID del producte de la URL
$productId = $_GET['id'];

// Preparar la consulta SQL
$stmt = $db->prepare("SELECT * FROM product WHERE id = :id");
$stmt->execute(['id' => $productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Comprovar si s'ha trobat el producte
if ($product) {
    // Aquí pots personalitzar com vols mostrar la informació del producte
    echo "<h2>" . htmlspecialchars($product['nom']) . "</h2>";
    //echo "<img src='path/to/images/" . $product['imatge'] . "' alt='" . htmlspecialchars($product['nom']) . "'>";
    echo "<p>" . htmlspecialchars($product['descripcio']) . "</p>";
    echo "<p>Preu: " . htmlspecialchars($product['Preu']) . "</p>";

    echo '<div class="centrar">';
    echo '<form  action="controllers/afegir_a_cistella.php" method="post">';
    echo '<input type=hidden name="preu"  value="'. $product['Preu'] . '">';
    echo '<input type="hidden" name="id_producte" value="' . $product['id'] . '">';
    echo '<input type="number" class="camp-numero"  name="quantitat" min="1" value="1">';
    echo '<input type="submit" class="afegir" value="Afegir a Cistella">';
    echo '</form>';
    echo '</div>';

} else {
    echo "Producte no trobat.";
}
?>

