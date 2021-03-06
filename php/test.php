<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Détail de la commande</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <script src="script.js"></script>
</head>
<?php

require('connectDB.php');

//checking if data has been entered
if (isset($_POST['idcmd']) && !empty($_POST['idcmd'])) {
    $idcmd = $_POST['idcmd'];

} else {
    exit();
}


try {

    $res = $dbh->query("
                                        SELECT `commandes`.idcmd, `personnes`.nom, `personnes`.prenom,`personnes`.adresse, 
                                        sum(prix * qte) as montant, SUM(qte) as nb_livre FROM `commandes` 
                                        INNER JOIN `lignescmd` ON `commandes`.idcmd = `lignescmd`.`idcmd` 
                                        INNER JOIN `ouvrages` ON `ouvrages`.`idouvrage` = `lignescmd`.`idouvrage` 
                                        INNER JOIN `personnes` ON `commandes`.`idpersonne` = `personnes`.`idpersonne` 
                                        GROUP BY  `commandes`.idcmd ");

    $res_all = $res->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res_all as $row) {
        $commandes[$i]['idcmd'] = $row['idcmd'];
        $commandes[$i]['nom'] = $row['nom'];
        $commandes[$i]['prenom'] = $row['prenom'];
        $commandes[$i]['montant'] = $row['montant'];
        $commandes[$i]['nb_livre'] = $row['nb_livre'];
        $commandes[$i]['adresse'] = $row['adresse'];
        $i++;
    }
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
?>
<body>
<div id="detailCommande" class="centreOmbre grandTableau">
    <h1>Détail de la commande</h1>
    <fieldset>
        <legend>Propriétaire de la commande</legend>
        <table>
            <tr class="ligne">
                <th>Numéro de la commande</th>
                <td><?php echo $commandes[0]['idcmd']?></td>
            </tr>
            <tr class="ligne">
                <th>Prénom</th>
                <td>Tristan</td>
            </tr>
            <tr class="ligne">
                <th>Nom</th>
                <td>Duhesme</td>
            </tr>
            <tr class="ligne">
                <th>Adresse</th>
                <td>84 boulevard de la Reine</td>
            </tr>
            <tr class="ligne">
                <th>Nombre de livres</th>
                <td>11</td>
            </tr>
            <tr class="ligne">
                <th>Cout</th>
                <td>134,78</td>
            </tr>
        </table>
    </fieldset>
    <br><br>
    <fieldset>
        <legend>Contenu de la commande</legend>
        <table>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Editeur</th>
                <th>Prix (€ HT)</th>
                <th class="quantiteLivre">Quantité</th>
            </tr>
            <tr class="ligne">
                <td>Cyrano de Bergerac</td>
                <td>Edmond Rostand</td>
                <td>gallimard</td>
                <td>9,99</td>
                <td class="quantiteLivre">2</td>
            </tr>
            <tr class="ligne">
                <td>L'art de la Guerre</td>
                <td>Sun Tzu</td>
                <td>Seuil</td>
                <td>15,78</td>
                <td class="quantiteLivre">9</td>
            </tr>
        </table>
    </fieldset>
</div>
</body>
</html>
