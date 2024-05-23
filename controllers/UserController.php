<?php

require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../models/UserModel.php';

class UserController
{
    // Mètode per la pàgina de login
    public function login()
    {
        // Si la petició és GET, només mostrem el formulari de login
        include __DIR__ . '/../VIEWS/login.php';
    }

    // Mètode per processar el login
    public function doLogin()
    {
        $error_message = ""; // Inicialitzar la variable de missatge d'error
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Aquí recuperaries les dades del formulari
            $email = $_POST['email'];
            $password = $_POST['password'];

            //validacio



            // Aquí fariem la lògica per validar l'usuari
            $db = Database::getConnection();
            $userModel = new UserModel($db);
            $usuari = $userModel->getUserByEmail($email);

            if ($usuari && password_verify($password, $usuari['password'])) {
                // Iniciar sessió, establir variables de sessió, etc.
                $_SESSION['user_email'] = $usuari['email'];
                // Redirigir a la pàgina d'inici amb un missatge d'èxit
                $_SESSION['message'] = "Sessió iniciada amb èxit!";
                header('Location: index.php?action=home');
                exit;
            } else {
                // Si les credencials no són correctes, preparar el missatge d'error
                $error_message = "Usuari o contrasenya incorrectes";
            }
        }
        // Mostrar el formulari de login amb el missatge d'error si n'hi ha
        include __DIR__ . '/../VIEWS/login.php';
    }


    // Mètode per la pàgina de registre
    public function register()
    {
        // Mostrar el formulari de registre
        include __DIR__ . '/../VIEWS/register.php';
    }

    // Mètode per processar el registre
    public function doRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recollir dades del formulari de registre
            $nom = $_POST['nombre'];
            $email = $_POST['email'];
            $adreca = $_POST['direccion'];
            $poblacio = $_POST['poblacion'];
            $codiPostal = $_POST['codigo_postal'];
            $password = $_POST['password'];

            //validacions !!!!!!
            // Validació del nom
            if (empty($nom)) {
                $error_message = "El camp del nom és obligatori.";
            } else {
                // Validar nom amb expressions regulars o altres criteris
            }

            // Validació del correu electrònic
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_message = "El format del correu electrònic no és vàlid.";
            }

            // Validació de la contrasenya (això seria abans d'encriptar)
            if (strlen($_POST['password']) < 8) {
                $error_message = "La contrasenya ha de tenir almenys 8 caràcters.";
            }

            // Validació de l'adreça
            if (empty($adreca)) {
                $error_message = "El camp de l'adreça és obligatori.";
            }

            // Validació de la població
            if (empty($poblacio)) {
                $error_message = "El camp de la població és obligatori.";
            }

            // Validació del codi postal
            if (!preg_match("/^\d{5}$/", $codiPostal)) {
                $error_message = "El codi postal ha de ser exactament de cinc números.";
            }


            // Si hi ha algun missatge d'error, incloure la vista de registre amb el missatge
            if (isset($error_message)) {
                include __DIR__ . '/../VIEWS/register.php';
                exit;
            }


            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            //encriptar contrasenya una vegada comprovada i obtenirla



            // Asumim que el model de UserModel té un mètode per crear un usuari
            $db = Database::getConnection(); // Obtenir l'objecte de connexió a la base de dades
            $userModel = new UserModel($db); // Crear una instància del model, passant la connexió a la BD
            $result = $userModel->createUser($nom, $password, $email, $adreca, $poblacio, $codiPostal);

            if ($result) {
                // Registre reeixit, redirigir a la pàgina de login o home
                header('Location: index.php?action=login');
                exit;
            } else {
                // Gestiona l'error de registre
                $error_message = "No s'ha pogut registrar l'usuari";
                include __DIR__ . '/../views/register.php';
            }
        } else {
            // Redirigir a la pàgina de registre si no és una petició POST
            header('Location: index.php?action=register');
            exit;
        }
    }

    // Mètode per tancar la sessió
    public function logout()
    {
        // Destruir la sessió i redirigir a la pàgina de login
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }

    // Altres mètodes relacionats amb els usuaris, com ara canviar contrasenya, etc.

    public function updateUser($email, $nuevosDatos) {
        $db = Database::getConnection();
        $sql = "UPDATE usuari SET nom = :nom, adreca = :adreca, poblacio = :poblacio, codi_postal = :codiPostal";
        
        // Comprobar si se proporcionó una foto de perfil
        if (isset($nuevosDatos['foto_perfil']) && !empty($nuevosDatos['foto_perfil'])) {
            $sql .= ", foto_perfil = :fotoPerfil";
        }
    
        $sql .= " WHERE email = :email";
    
        $stmt = $this->$db->prepare($sql);
    
        $params = [
            ':nom' => $nuevosDatos['nombre'],
            ':adreca' => $nuevosDatos['direccion'],
            ':poblacio' => $nuevosDatos['poblacion'],
            ':codiPostal' => $nuevosDatos['codigo_postal'],
            ':email' => $email
        ];
    
        // Añadir la foto de perfil al array de parámetros si está presente
        if (isset($nuevosDatos['foto_perfil']) && !empty($nuevosDatos['foto_perfil'])) {
            $params[':fotoPerfil'] = $nuevosDatos['foto_perfil'];
        }
    
        return $stmt->execute($params);
    }
    
    
  
   public function editarPerfil($email)
{
    // Obtener los datos del usuario para precargar el formulario
    $db = Database::getConnection();
    $userModel = new UserModel($db);
    $usuario = $userModel->getUserByEmail($email);

    if ($usuario) {
        // Mostrar el formulario de edición con los datos del usuario precargados
        include __DIR__ . '/../VIEWS/editarPerfil.php';
    } else {
        // Manejar el caso en que el usuario no exista
        echo "Usuario no encontrado";
    }
}
   

public function procesarEdicionPerfil($email, $nuevosDatos)
{
    $db = Database::getConnection();
    $userModel = new UserModel($db);
    
    if (isset($_FILES["foto_perfil"]) && !empty($_FILES["foto_perfil"]["name"])) {
        $this->procesarCargaFotoPerfil($email, $_FILES["foto_perfil"]);
    }

    // Realizar la actualización en el modelo
    $resultado = $userModel->updateUser($email, $nuevosDatos);

    if ($resultado) {
        // Redirigir a la página de confirmación o a la página de perfil
        header("Location: index.php?action=confirmacion");
        exit();
    } else {
        // Manejar el caso en que la actualización no sea exitosa
        echo "Error al actualizar el perfil";
    }
}



public function procesarCargaFotoPerfil($email, $fotoPerfil)
{
    $targetDir = "/home/TDIW/tdiw-a1/public_html/imatges/";
    $targetFile = $targetDir . basename($fotoPerfil["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real o un archivo falso
    $check = getimagesize($fotoPerfil["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
    }

    // Verificar si el archivo ya existe
    if (file_exists($targetFile)) {
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Verificar si $uploadOk es 0 por algún error
    if ($uploadOk == 0) {
        echo "Error al cargar el archivo.";
    } else {
        // Si todo está bien, intentar subir el archivo
        if (move_uploaded_file($fotoPerfil["tmp_name"], $targetFile)) {
            // Actualizar la base de datos con la ruta de la foto de perfil
            $db = Database::getConnection();
            $userModel = new UserModel($db);

            $rutaFotoPerfil = "/imatges/" . basename($fotoPerfil["name"]); // Cambia esta ruta según la estructura de tu proyecto

            $nuevosDatos = ['foto_perfil' => $rutaFotoPerfil];
            $userModel->updateUser($email, $nuevosDatos);

            echo "La foto de perfil se ha cargado correctamente.";
        } else {
            echo "Error al cargar el archivo.";
        }
    }
}


}