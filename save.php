<?php
    require_once('connect.php');

    $nom = $_POST['nom'];
    $filiere = $_POST['filiere'];
    $village = $_POST['village'];

    $requete = $connexion->prepare('INSERT INTO Clusters(nom,idFiliere,idVillage) VALUES(?,?,?)');
    $requete->execute(array($nom,$filiere,$village));
?>

<meta http-equiv="refresh" content="1; url=liste.php">


