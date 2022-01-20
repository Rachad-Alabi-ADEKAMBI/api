<?php
function getFormations(){
    $pdo = getConnexion();
     $stmt = $pdo->prepare("SELECT * FROM formation");
     $stmt->execute();
     $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
     $stmt->closeCursor();
     sendJSON($formations);
    }

function getFormationsByCategorie($categorie){
    $pdo = getConnexion();
    $req = "SELECT f.id, f.libelle, f.description, f.image,
    c.libelle as 'categorie' FROM formation f inner join categorie c on  f.categorie_id = c.id
     WHERE  c.libelle = :categorie";
     $stmt  = $pdo->prepare($req);
     $stmt ->bindvalue(":categorie", $categorie, PDO::PARAM_STR);
    $stmt->execute();
    $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($formations);
}

function getFormationById($id){
    echo "Affichage ";
}

function getConnexion(){
    return new PDO("mysql:host=localhost; dbname=fh2prog; charset=UTF8", "root", "");
}

function sendJSON($infos){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($infos,JSON_UNESCAPED_UNICODE);
}