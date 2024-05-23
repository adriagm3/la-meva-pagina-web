<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Botànica</title>
    <link rel="stylesheet" type="text/css" href="/../css/estils.css">
</head>

<body>

    <?php
    session_start();
    // Ací comença la lògica de PHP per a l'encaminador
    require_once 'database.php'; // Asumint que tens la classe Database en aquest path

    $action = $_GET['action'] ?? 'home'; // Acció per defecte

    if ($action !== 'login' && $action !== 'register' && $action !== 'doRegister' && $action !== 'doLogin') {
        echo '<header>
            <h1> <a href="index.php" class="home-button"> Benvingut a la Botànica</a> </h1>
            <nav>
                <li>
                    <a href="index.php?action=login">Iniciar Sessió</a>
                    <a href="index.php?action=categories">Categories</a>
                    <a href="index.php?action=cistella">Cistella</a>';
        
        // Agregar la nueva opción "Editar Perfil" si el usuario ha iniciado sesión
        if (isset($_SESSION['user_email'])) {
            echo '<a href="index.php?action=editarPerfil">Editar Perfil</a>';
        }
        
        echo '</li>
            </nav>
        </header>';
    }
    

    switch ($action) {
        case 'categories':
            require 'controllers/CategoryController.php';
            $controller = new CategoryController();
            $controller->index();
            break;
        case 'login':
            require 'controllers/UserController.php';
            $controller = new UserController();
            $controller->login();
            break;
        case 'register':
            require_once 'controllers/UserController.php';
            $userController = new UserController();
            $userController->register();
            break;
        case 'doLogin':
            require 'controllers/UserController.php';
            $controller = new UserController();
            $controller->doLogin();
            break;
        case 'doRegister':
            require 'controllers/UserController.php';
            $controller = new UserController();
            $controller->doRegister();
            break;

        case 'cistella':
            require 'controllers/CistellaController.php';
            // Aquí crees les instàncies dels models que el controlador necessiti
            $modelCesta = new ModelCesta();
            // IMPORANT $modelProductes = new ModelProductes(); // Suposem que tens un model per als productes

            // Crees l'instància del controlador passant-li els models
            $controller = new CistellaController($modelCesta);

            // Ara crides al mètode que necessitis, per exemple, mostrarCesta
            $controller->mostrarCistella();
            break;
        case 'editarPerfil':
            require_once 'controllers/UserController.php';
            $controller = new UserController();
            $controller->editarPerfil($_SESSION['user_email']); // Pasar el correo electrónico del usuario actual
            break;

        case 'procesarEdicionPerfil':
            require_once 'controllers/UserController.php';
            $controller = new UserController();
            $controller->procesarEdicionPerfil($_POST['email'], $_POST);
            break;
                
            
        break;

            // Afegeix més casos segons les teves necessitats
        default:
            // Mostra la pàgina d'inici o una pàgina d'error
            echo "<p>Benvingut a la millor botiga de plantes!</p>";
            break;
    }

    ?>
    <?php if (isset($_SESSION['message'])) : ?>
        <p class="success"><?php echo htmlspecialchars($_SESSION['message']); ?> <br>
            <img src='/css/img/happy.gif' style="width: 15%;">
        </p>
        <?php unset($_SESSION['message']); // Eliminar el missatge després de mostrar-lo 
        ?>
    <?php endif; ?>

</body>

    <?php 
function calcularTotalCistella() {
    $total = 0;
    $nombreProductes = 0;

    if (isset($_SESSION['cesta']) && count($_SESSION['cesta']) > 0) {
        foreach ($_SESSION['cesta'] as $item) {
            $total += $item['preu'] * $item['quantitat'];
            $nombreProductes += $item['quantitat'];
        }
        return ['total' => $total, 'nombreProductes' => $nombreProductes];
    } else {
        // Retorna null o un array buit si la cistella està buida
        return null;
    }
}

$detallsCistella = calcularTotalCistella();

if ($detallsCistella !== null) { echo "<footer>";
    //echo <img src="" alt="">;
    echo "Nombre de Productes: " . $detallsCistella['nombreProductes'];
    echo "  ⟶ Preu Total: " . $detallsCistella['total'] . "€";
} echo "
</footer>
"; ?>

</html>
