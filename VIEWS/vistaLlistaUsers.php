<table>
    <thead>
        <tr>
            <th>Email</th>
            <th>Nombre</th>
            <!-- Otras columnas según tus necesidades -->
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['email']); ?></td>
                <td><?= htmlspecialchars($usuario['nom']); ?></td>
                <!-- Otras celdas según tus necesidades -->
                <td>
                    <!-- Modificar el enlace para redirigir a la página de edición de perfil -->
                    <a href="index.php?action=editarPerfil&email=<?= urlencode($usuario['email']); ?>">Editar perfil</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>