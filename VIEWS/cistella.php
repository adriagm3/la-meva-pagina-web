<!DOCTYPE html>
<html>

<head>
    <title>Cistella de la compra</title>
    <!-- Afegir enllaços a CSS, JS, etc. aquí si és necessari -->
</head>

<body>
    <h1>La teva cistella de la compra</h1>
    <?php if (!empty($_SESSION['cesta'])) : ?>
        <table>
            <tr>
                <th>Producte</th>
                <th>Quantitat | </th>
                <th>Modificar Quantiat | </th>
                <th>Preu Unitari | </th>
                <th>Preu Total</th>
            </tr>

            <?php $preuTotalCesta = 0;
            require_once __DIR__ . '/../database.php';
            $db = Database::getConnection();

            $nomsProductes = [];
            foreach ($_SESSION['cesta'] as $idProducte => $infoProducte) {
                $stmt = $db->prepare("SELECT nom FROM product WHERE id = $idProducte");
                $stmt->execute();
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                $nomsProductes[$idProducte] = $resultat['nom'];
            }
            ?>

            <?php foreach ($_SESSION['cesta'] as $idProducte => $infoProducte) : ?>
                <?php
                $preuTotalProducte = $infoProducte['preu'] * $infoProducte['quantitat'];
                $preuTotalCesta += $preuTotalProducte;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($nomsProductes[$idProducte]); ?></td>
                    <td><?php echo htmlspecialchars($infoProducte['quantitat']); ?></td>
                    <td>

                        <form action="/../controllers/actualitzar_cabas.php" method="post">
                            <input type="hidden" name="id_producte" value="<?php echo $idProducte; ?>">
                            <input type="number" class="camp-numero" name="quantitat" value="<?php echo htmlspecialchars($infoProducte['quantitat']); ?>" min="0">
                            <input type="submit" class="afegir" name="accio" value="Modificar">
                        </form>


                    </td>
                    <td><?php echo htmlspecialchars($infoProducte['preu']); ?>€</td>
                    <td><?php echo htmlspecialchars($preuTotalProducte); ?>€</td>
                    <td>
                        <form action="/../controllers/eliminar_de_cistella.php" method="post">
                            <input type="hidden" name="id_producte" value="<?php echo $idProducte; ?>">
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>



        </table>
        <br>
        <hr><br>
        <td colspan="3">Preu Total de la cistella:</td>
        <td><?php echo htmlspecialchars($preuTotalCesta); ?>€</td>
        <td>
            <form action="/../controllers/buidar_cabas.php" method="post">
                <input type="submit" class="afegir" name="buidarCistella" value="Buidar Cistella">
            </form>
        </td>
        <!-- Potser vols afegir botons o enllaços per actualitzar o eliminar productes -->
    <?php else : ?>
        <p>No hi ha productes a la cistella.</p>
    <?php endif; ?>
</body>

</html>