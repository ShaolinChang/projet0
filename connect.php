<?php
    try {
        $connexion = new PDO("mysql:host=localhost;dbname=examen1;charset=utf8",'admin',')ja_kWaD5SMI8GDq',
                            [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION],);
        
        $conn = new PDO("mysql:host=localhost;dbname=fichier;charset=utf8",'admin',')ja_kWaD5SMI8GDq',
                            [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION],);
        
    } catch (\Exception $e) {
        die('Erreur :'.$e->getMessage());
    }
?>