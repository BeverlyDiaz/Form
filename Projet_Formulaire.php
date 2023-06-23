<?php
include('Bd_connexion.php');
    //CONNEXION
    try {

        $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database.';charset=utf8',$username,$password );
   
   }        catch(Exception $e) {
   
            die ('Erreur : '.$e->getMessage());
   
   } 

    // AFFICHE LES INFORMATIONS

        $requete = $bdd ->query(' SELECT prenom, nom, serie_preferee
                                  FROM   users');
    echo   '<table border>
             
                    <tr>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Série préférée</th>
                    </tr>';
             
        while($donnees = $requete ->fetch()) {

        echo    '<tr>
                        <td>'.$donnees['prenom'].        '</td>
                        <td>'.$donnees['nom'].           '</td>
                        <td>'.$donnees['serie_preferee'].'</td>
                </tr>';               
        }
         echo   '</table>'; 
    // AJOUTER UN NOUVEL UTILISATEUR

    if (isset($_GET['prenom']) && isset($_GET['nom'])
    && isset($_GET['serie'])) {
    
                        $prenom = $_GET['prenom'];
                        $nom    = $_GET['nom'];
                        $serie  = $_GET['serie'];
    
    $requete = $bdd ->  prepare('INSERT INTO users(prenom, nom, serie_preferee)
                                VALUES(?, ?, ?)')
                                or die (print_r($bdd->errorInfo()));
    
    $requete -> execute (array ($prenom, $nom, $serie));

    header('location:../');

    }

?>

    <!--Formulaire-->

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projet_Formulaire</title>
    </head>
    <body>

        <h1>Ajouter un utilisateur</h1>

            <form method="get" action="Projet_Formulaire.php">
                <table>
                    <tr>
                        <td>Prénom</td>
                        <td><input type="text" name="prenom" id="prenom"></td>
                        <td>Nom</td>
                        <td><input type="text" name="nom" id="nom"></td> 
                        <td>Série préférée</td>
                        <td><input type="text" name="serie" id="serie"></td>
                    </tr>
                </table>
                        <button type="submit">Ajouter</button>
             </form>
    </body>
    </html>


