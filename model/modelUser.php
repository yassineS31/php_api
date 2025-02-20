<?php
//Récupère la liste des utilisateurs en BDD
function lireUtilisateurs($bdd){
$req = $bdd->prepare('SELECT id, pseudo, email, mdp FROM
utilisateurs');
$req->execute();
$data = $req->fetchAll(PDO::FETCH_OBJ);
return $data;
};


function enregistrerUtilisateur($bdd, $pseudo, $email, $mdp){
    $req = $bdd->prepare('INSERT INTO utilisateurs ( pseudo, email, mdp) VALUES (?,?,?)');
    //Si le nom est défini, on lui attribue le PARAM_STR, sinon on attribue PARAM_NULL
//On bind le reste des champs obligatoires
$req->bindParam(1,$pseudo,PDO::PARAM_STR);
$req->bindParam(2,$email,PDO::PARAM_STR);
$req->bindParam(3,$mdp,PDO::PARAM_STR);
//Execution de la requête, si tout se passe bien, on renvoie true. Sinon,on renvoie false
if($req->execute()){
return true;
}
return false;
}

function lireUtilisateursByPseudo($bdd, $pseudo){
    $req = $bdd->prepare('SELECT pseudo, email, mdp FROM
    utilisateurs WHERE pseudo = ?');
    $req->bindParam(1,$pseudo,PDO::PARAM_STR);
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
    }

    function lireUtilisateursByMail($bdd, $mail){
        $req = $bdd->prepare('SELECT  pseudo, email, mdp FROM
        utilisateurs WHERE email = ?');
        $req->bindParam(1,$mail,PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
        }