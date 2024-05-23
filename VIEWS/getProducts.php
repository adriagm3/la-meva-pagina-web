<?php
require '../database.php'; // Ajusta aquesta ruta

$db = Database::getConnection();
$category = isset($_GET['category']) ? intval($_GET['category']) : 0;
$category = $_GET['category'];

if ($category == 3) {
    $header = "Llavors";
    $desc = "Aquí trobaràs una selecció de llavors que pots utilitzar per a plantar les teves pròpies plantes.
    ";
} elseif ($category == 4) {
    $header = "Plantes";
    $desc = 'Descobreix una varietat de plantes, incloent enfiladisses i altres espècies botàniques fascinants.';
} elseif ($category == 5) {
    $header = "Arbres";
    $desc = "Explora la nostra col·lecció d'arbres, incloent mandarines, clementines i altres tipus d'arbres.";
} elseif ($category == 6) {
    $header = "Roses";
    $desc = 'Aquí trobaràs roses de molts colors diferents per adornar el teu jardí.';}

echo  "<h2>$header</h2  >";
echo "<p>$desc</p>";

// Prepara la teva consulta SQL basada en la categoria
$stmt = $db->prepare("SELECT * FROM product WHERE id_categoria = :id_categoria");
$stmt->execute(['id_categoria' => $category]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Genera l'HTML per a cada producte
echo"<ul>";
foreach ($products as $product) {
    echo '<li>';
    echo '<a href="#" data-product-id="' . $product['id'] . '">' . htmlspecialchars($product['nom']) . '</a>';
    echo '<i>' . htmlspecialchars($product['descripcio']) . '</i>';



    echo '<form action="controllers/afegir_a_cistella.php" method="post">';
    echo "<p>Preu: " . htmlspecialchars($product['Preu']) . "</p>";
    echo '<input type=hidden name="preu"  value="'. $product['Preu'] . '">';
    echo '<input type="hidden" name="id_producte" value="' . $product['id'] . '">';
    echo '<input type="number" class="camp-numero"  name="quantitat" min="1" value="1">';
    echo '<input type="submit" class="afegir" value="Afegir a Cistella">';
    echo '</form>';



    echo '</li>';

}
echo"</ul>";

?>

