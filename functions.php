<?php
    require_once('connect.php');

    function recupfiliere($connexion)
    {
        $requete = $connexion->query('SELECT * FROM Filieres');
        $filieres = $requete->fetchAll();

        $output ='';
        foreach ($filieres as $filiere) {
            $output .='<option value="'.$filiere["idFilieres"].'">'.$filiere["nomFiliere"].'</option>';
        }

        echo $output;
    }

    function recupDepart($connexion)
    {
        $requete = $connexion->query('SELECT * FROM Départements ORDER BY nomDepart');
        $depart = $requete->fetchAll();

        $output ='';
        foreach($depart as $departs)
        {
            $output .='<option value="'.$departs["idDepartement"].'">'.$departs["nomDepart"].'</option>';
        }
        echo $output;
    }
 
    function recupNomFil($connexion)
    {
        $req = $connexion->query('SELECT * FROM Filieres,Villages,Clusters WHERE Clusters.idFiliere=Filieres.idFilieres 
                                AND Clusters.idVillage=Villages.idVillage ORDER BY nom');
        $datas = $req->fetchAll();

        $output = '';
        foreach ($datas as $data)
        {
            $output.='<tr>';
            $output.='<td>'.$data["nom"].'</td>';
            $output.='<td>'.$data["nomFiliere"].'</td>';
            $output.='<td>'.$data["nomVillage"].'</td>';
            $output.='</tr>';
        }

        echo $output;
    }

    function recupNom($conn)
    {
        $requete = $conn->query('SELECT * FROM inscrit');
        $data = $requete->fetchAll();

        $out ='';
        foreach ($data as $dat) {
            $out.='<option value="'.$dat["id"].'">'.$dat["nom"].'</option>';
        }

        echo $out;
    }

?>