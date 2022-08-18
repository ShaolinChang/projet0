<?php
    require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clusters</title>
</head>
<body>
    <center><h2>Liste des Clusters Enregistrés</h2></center>
    <table>
        <tr>
            <th>Nom</th>
            <th>Filière</th>
            <th>Village</th>
        </tr>
        <?php
            recupNomFil($connexion);
        ?>
    </table>
</body>
</html>