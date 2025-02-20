<?php
//inclure les ressources
include './env.php';
include './utils/function.php';
include './model/modelUser.php';
//mise en place de la fonction listeUtilisateurs()
function listeUtilisateurs($host, $dbname, $login, $password){
// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");
// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");
// Méthode autorisée
header("Access-Control-Allow-Methods: GET");
// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");
// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// Vérification de la méthode : si ce n’est pas la bonne, on renvoie une erreur
if($_SERVER['REQUEST_METHOD'] != 'GET'){
http_response_code(405);
echo json_encode(["message" => "La méthode n'est pas autorisée"]);
return;
}
//Connexion à la BDD
$bdd = connect($host,$dbname,$login,$password);
//Récupération de la liste des utilisateurs
$data = lireUtilisateurs($bdd);
//Envoie des datas
http_response_code(200);
echo json_encode($data);
}
listeUtilisateurs($_ENV['dbhost'],$_ENV['dbname'],$_ENV['dblogin'],$_ENV['dbpassword']);