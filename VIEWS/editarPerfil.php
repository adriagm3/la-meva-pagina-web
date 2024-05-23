<!-- editarPerfil.php -->
<!DOCTYPE html>
<html lang="en" id="editaPerfil">
<head>
    <meta charset="UTF-8">
    <title>Editar el Perfil</title>
    <link rel="stylesheet" href="/css/editarPerfil.css"> 
</head>
<body>
    <h1>Editar el Perfil</h1>

    <form action="index.php?action=procesarEdicionPerfil" method="post" enctype="multipart/form-data">
        <!-- Agregar la sección para la foto de perfil -->
        <div id="foto-perfil-container">
            <img src="<?= htmlspecialchars($usuario['foto_perfil']) ?>" alt="Foto de perfil">
        </div>

        <!-- Resto del formulario -->
        <label for="nombre">Nom:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nom']) ?>" required>
        <br>

        <label for="foto_perfil">Imatge de Perfil:</label>
        <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">
        <br>

        <label for="email">Correu Electronic:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" readonly>
        <br>

        <label for="direccion">Direccio:</label>
        <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($usuario['adreca']) ?>" required>
        <br>

        <label for="poblacion">Poblacio:</label>
        <input type="text" id="poblacion" name="poblacion" value="<?= htmlspecialchars($usuario['poblacio']) ?>" required>
        <br>

        <label for="codigo_postal">Codí Postal:</label>
        <input type="text" id="codigo_postal" name="codigo_postal" value="<?= htmlspecialchars($usuario['codi_postal']) ?>" required>
        <br>

        <!-- Agregar más campos según sea necesario -->

        <input type="submit" value="Guardar cambios">
    </form>
</body>
</html>
