<?php

require_once __DIR__ . '/../database.php';

class UserModel {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByEmail($email) {
        // Preparar la consulta SQL per obtenir l'usuari per correu electrònic
        $stmt = $this->db->prepare("SELECT * FROM usuari WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateUser($email, $nuevosDatos) {
        $stmt = $this->db->prepare("UPDATE usuari SET nom = :nom, adreca = :adreca, poblacio = :poblacio, codi_postal = :codiPostal WHERE email = :email");
    return $stmt->execute([
        ':nom' => $nuevosDatos['nombre'],
        ':adreca' => $nuevosDatos['direccion'],
        ':poblacio' => $nuevosDatos['poblacion'],
        ':codiPostal' => $nuevosDatos['codigo_postal'],
        ':email' => $email
    ]);}
        

    public function createUser($nom, $password, $email, $adreca, $poblacio, $codiPostal) {
        // Preparar la consulta SQL per inserir un nou usuari
        $stmt = $this->db->prepare("INSERT INTO usuari (nom, password, email, adreca, poblacio, codi_postal) VALUES (:nom, :password, :email, :adreca, :poblacio, :codiPostal)");

        // Executar la consulta amb els paràmetres proporcionats
        return $stmt->execute([
            ':nom' => $nom,
            ':password' => $password,
            ':email' => $email,
            ':adreca' => $adreca,
            ':poblacio' => $poblacio,
            ':codiPostal' => $codiPostal
        ]);
    }
}
