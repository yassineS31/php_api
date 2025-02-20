<?php
// Fonction pour se connecter à la BDD
function connect($host, $dbname, $login, $password) {
    try {
        return new PDO(
            "mysql:host=$host;dbname=$dbname;port=3307",
            $login,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

// Fonction pour nettoyer les données reçues
function sanitize($data) {
    return htmlentities(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}
?>
