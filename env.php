<?php
//FICHIER ENVIRONNEMENT :
//-> sert à y stocker vos variables d'environnement
// - les donnnées sensibles que vous ne voulez pas rendre publique
// - les données que vous allez constamment utilisé à différents endroits
//du code (comme les liens)
//-> ça facilite la mise à jour
//ATTENTION : C'EST LE PREMIER FICHIER A AJOUTER A VOTRE .GITIGNORE
//Identifiant de connexion à la BDD
$_ENV['dbhost'] = 'localhost';
$_ENV['dbname'] = "utilisateur";
$_ENV['dblogin'] = 'root';
$_ENV['dbpassword'] = "123";
$_ENV['port'] = "3307";
