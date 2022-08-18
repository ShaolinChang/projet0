<?php
    require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Nom :</label>
        <select  id="nom" onchange="recupPre()">
            <option value="0">...</option>
            <?php
                recupNom($conn);
            ?>
        </select><br><br>
        <label for="">Prénom :</label>
        <select id="pre">
            <option value="0">Sélectionner un prénom</option>
        </select>
    </form>
</body>
</html>

<script>
    function recupPre()
    {
        var idPre = document.getElementById('nom').value;
        var prenom = '<option value="0"> un prenom</option>';

        switch (idPre) {
            <?php
                $req = $conn->query('SELECT * FROM inscrit');
                $donnees = $req->fetchAll();
                foreach ($donnees as $donnee1) {
            ?>
            case "<?php echo $donnee1['id']; ?>":
                  <?php
                    $req1 = $conn->prepare('SELECT * FROM prenom WHERE id_inscrit=?');
                    $req1->execute(array($donnee1['id']));
                    $info = $req1->fetchAll();

                    foreach ($info as $inf) {
                        ?>
                        prenom+='<option value="<?php echo $inf['ids']; ?>"><?php echo $inf['prenom']; ?></option>'; 
                    <?php   
                    } 
                    ?>
            break;
            <?php   
                }
            ?>  
               
        }
        document.getElementById('pre').innerHTML = prenom;
    }
</script>