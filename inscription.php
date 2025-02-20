<?php
//inclure les ressources
include './env.php';
include './utils/function.php';
include './model/modelUser.php';
//mise en place de la fonction listeUtilisateurs()

$host = 'localhost';
$dbname = 'utilisateur';
$login ='root';
$password ='123';
$port='3307';
function inscrireUtilisateurs($host, $dbname, $login, $password){

// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");
// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");
// Méthode autorisée
header("Access-Control-Allow-Methods: POST");
// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");
// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// Vérification de la méthode
if($_SERVER['REQUEST_METHOD'] != 'POST'){
http_response_code(405);
echo json_encode(["message" => "La méthode n'est pas autorisée"]);

return;
}
//lecture des données reçu en JSON (ici $data est un objet)
$data = json_decode(file_get_contents("php://input"));
//Vérification des champs obligatoires (pseudo, email, mdp) : s'il en manque au moins un, on envoie un message d'erreur
if(!isset($data->pseudo) || empty($data->pseudo)
|| !isset($data->email) || empty($data->email)
|| !isset($data->mdp) || empty($data->mdp)){
http_response_code(400);
echo json_encode(["message" => "Veuillez remplir tous les champs obligatoires"]);
return;
}
//Vérification du format des données (email) : si le mail n'est pas au bon format, on envoie un message d'erreur
if(!filter_var($data->email,FILTER_VALIDATE_EMAIL)){
http_response_code(400);
echo json_encode(["message" => "Votre email n'est pas au bon format"]);
return;
}
//Nettoyage des données avec la fonction sanitize() définie dans le fichier functions.php
$pseudo = sanitize($data->pseudo);
$email = sanitize($data->email);
$mdp = sanitize($data->mdp);
//Hashage du mot de passe
$mdp = password_hash($mdp,PASSWORD_BCRYPT);
//Connexion à la BDD
$bdd = connect($host, $dbname,  $login, $password);
//Vérification de l'existence du pseudo et de l'email
$isPseudoExist = lireUtilisateursByPseudo($bdd,$pseudo);
$isEmailExist = lireUtilisateursByMail($bdd,$email);
if(!empty($isPseudoExist) || !empty($isEmailExist)){
http_response_code(400);
echo json_encode(["message" => "Ce Pseudo et/ou cet Email est déjà pris"]);
return;
}
//Enregistrement de l'utilisateur
$result =
enregistrerUtilisateur($bdd,$pseudo,$email,$mdp);
//Vérification du résultat de l'enregistrement
if($result == false){
http_response_code(500);
echo json_encode(["message" => "Un problème est survenu lors de l'enregistrement"]);
return;
}
//Envoie des datas
http_response_code(200);
echo json_encode(["message" => "Enregistrement effecuté avec succès"]);
return;
}
inscrireUtilisateurs($host, $dbname, $login, $password);
