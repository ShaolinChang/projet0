<?php 
    require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <title>Développement Web</title>
</head>
<body>

    <form action="save.php" method="post">
        <label for="">Filière</label><br>
            <select name="filiere" id="s1">
                <option value="0">Sélectionner une filière</option>
            <?php 
               recupfiliere($connexion);
            ?>
            </select><br>
            <table>
                <tr>
                    <td>Département</td>
                    <td>Commune</td>
                </tr>
                <tr>
                    <td>
                        <select name="departement" id="s2"  onchange="recupCommunes()">
                            <option value="0">Sélectionner un département</option>
                            <?php 
                                recupDepart($connexion);
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="commune" id="s3" onchange="recupArrond()" onclick="controlcom()">
                            <option value="0">Sélectionner une commune</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Arrondissement</td>
                    <td>Village</td>
                </tr>
                <tr>
                    <td>
                        <select name="arrond" id="s4"  onchange="recupVil()" onclick="controlarrond()">
                            <option value="0">Sélectionner un arrondissement</option>
                        </select>
                    </td>
                    <td>
                        <select name="village" id="s5"  onclick="controlvil()" required>
                            <option value="0">Sélectionner un village</option>
                        </select>
                    </td>
                </tr>
            </table>
            <label for="">Nom du cluster</label><br>
            <input type="text" name="nom"><br><br>
            <input type="submit" value="Enregistrer">
            <input type="reset" value="Annuler">
    </form> 
</body>
</html>

<script>
    function recupCommunes() {
        var idDep = document.getElementById('s2').value;
        var commune = '<option value="0">Selectionner une commune</option>';

        switch (idDep) {
            <?php
                $req = $connexion->query('SELECT * FROM Départements');
                $donnees = $req->fetchAll();

                foreach($donnees as $donnee1){
            ?>
            case "<?php echo $donnee1['idDepartement'] ; ?>":
                        <?php
                            $req2 = $connexion->prepare('SELECT * FROM Communes WHERE idDepart=?');
                            $req2->execute(array($donnee1['idDepartement']));
                            $donnees2 = $req2->fetchAll();

                            foreach($donnees2 as $donnee){
                        ?>
                            commune+='<option value="<?php echo $donnee['idCom']; ?>"><?php echo $donnee['nomCom']; ?></option>';
                        <?php   
                            }
                        ?>
                break;
        
            <?php   
                }
            ?>
        }

        document.getElementById('s3').innerHTML = commune;
    }

    function recupArrond(){
        var idCom = document.getElementById('s3').value;
        var arrondissement = '<option value="0">Selectionner un arrondissement</option>';

        switch (idCom) {
            <?php
                $reqcom = $connexion->query('SELECT * FROM Communes');
                $dataComs = $reqcom->fetchAll();

                foreach($dataComs as $datacom){
            ?> 
                case "<?php echo $datacom['idCom'] ; ?>":
                    <?php
                        $reqarrond = $connexion->prepare('SELECT * FROM Arrondissements WHERE idCommune=?');
                        $reqarrond->execute(array($datacom['idCom']));

                        $dataArronds = $reqarrond->fetchAll();

                        foreach($dataArronds as $dataArrond){
                    ?>       
                    arrondissement += '<option value="<?php echo $dataArrond['idArrondissement']; ?>"><?php echo $dataArrond['nomArrond']; ?></option>';
                    <?php
                        }
                    ?>
                break;
        
            <?php
                }
            ?>
        }
        document.getElementById('s4').innerHTML = arrondissement;
    }

    function recupVil()
    {
        var idArrond = document.getElementById('s4').value;
        var Villages = '<option value="0">Selectionner un Village</option>';

        switch (idArrond) {
            <?php
                $reqArronds = $connexion->query('SELECT * FROM Arrondissements');
                //$reqcom->execute();
                $dataArronds = $reqArronds->fetchAll();

                foreach($dataArronds as $dataArrond){
            ?> 
                case "<?php echo $dataArrond['idArrondissement'] ; ?>" :
                    <?php
                        $reqVills = $connexion->prepare('SELECT * FROM Villages WHERE idArrondissement=?');
                        $reqVills->execute(array($dataArrond['idArrondissement']));

                        $dataVills = $reqVills->fetchAll();

                        foreach($dataVills as $dataVil){
                    ?>       
                    Villages += '<option value="<?php echo $dataVil['idVillage']; ?>"><?php echo $dataVil['nomVillage']; ?></option>';
                    <?php
                        }
                    ?>
                break;
        
            <?php
                }
            ?>
        }
        document.getElementById('s5').innerHTML = Villages;
    }

    function controlcom()
    {
        idDep = document.getElementById('s2').value;
        if(idDep =='0'){
            alert('Veuillez choisir un département');
        }
    }

    function controlarrond()
    {
        idDep = document.getElementById('s3').value;
        if(idDep =='0')
        {
            alert('Veuillez choisir une commune');
        }
    }

    function controlvil()
    {
        idDep = document.getElementById('s4').value;
        if (idDep=='0') {
            alert('Veuillez choisir un arrondissement');
        }
    }
</script>

