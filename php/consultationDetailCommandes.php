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
session_start();
//checking if data has been entered
if (isset($_POST['idcmd']) && !empty($_POST['idcmd'])) {
    $idcmd = $_POST['idcmd'];

} else if (!empty($_SESSION['idcmd'])){
    $idcmd = $_SESSION['idcmd'];
} else{
    exit();
}


try {

    $res = $dbh->query("
                                        SELECT `commandes`.idcmd, `personnes`.nom, `personnes`.prenom,`personnes`.adresse, `commandes`.validee,
                                        sum(prix * qte) as montant, SUM(qte) as nb_livre FROM `commandes` 
                                        INNER JOIN `lignescmd` ON `commandes`.idcmd = `lignescmd`.`idcmd` 
                                        INNER JOIN `ouvrages` ON `ouvrages`.`idouvrage` = `lignescmd`.`idouvrage` 
                                        INNER JOIN `personnes` ON `commandes`.`idpersonne` = `personnes`.`idpersonne` 
                                        WHERE `commandes`.idcmd ='".$idcmd.
                                        "' GROUP BY  `commandes`.idcmd");

    $listeLivre = $dbh->query("
                                        SELECT `ouvrages`.`titre`, `ouvrages`.`auteur`,
                                        prix, qte  FROM `commandes` 
                                        INNER JOIN `lignescmd` ON `commandes`.idcmd = `lignescmd`.`idcmd` 
                                        INNER JOIN `ouvrages` ON `ouvrages`.`idouvrage` = `lignescmd`.`idouvrage` 
                                        INNER JOIN `personnes` ON `commandes`.`idpersonne` = `personnes`.`idpersonne` 
                                        WHERE `commandes`.idcmd ='".$idcmd.
                                        "' GROUP BY  `commandes`.idcmd, `ouvrages`.idouvrage");
    $res_all = $res->fetchAll(PDO::FETCH_ASSOC);
    $listeLivre_all = $listeLivre->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
?>
<body>
<div id="detailCommande" class="centreOmbre grandTableau">
    <h1>Détail de la commande</h1>
    <div class="otherLinks">
        <a href="listeDeLivre.php">Liste des livres</a><br>
        <a href="../html/ajouterUnLivre.html">Ajouter un ouvrage</a><br>
        <a href="consultationListeCommandes.php">Consulter des commandes</a><br>
        <a href="consultationListeComptes.php">Consulter la liste de client</a><br/><br/>
    </div>
    <fieldset>
        <legend>Propriétaire de la commande</legend>
        <table>
            <tr class="ligne">
                <th>Numéro de la commande</th>
                <td><?php echo $res_all[0]['idcmd']?></td>
            </tr>
            <tr class="ligne">
                <th>Prénom</th>
                <td><?php echo $res_all[0]['prenom']?></td>
            </tr>
            <tr class="ligne">
                <th>Nom</th>
                <td><?php echo $res_all[0]['nom']?></td>
            </tr>
            <tr class="ligne">
                <th>Adresse</th>
                <td><?php echo $res_all[0]['adresse']?></td>
            </tr>
            <tr class="ligne">
                <th>Nombre de livres</th>
                <td><?php echo $res_all[0]['nb_livre']?></td>
            </tr>
            <tr class="ligne">
                <th>Cout</th>
                <td><?php echo $res_all[0]['montant']?></td>
            </tr>
            <tr class="ligne">
                <th>Validée</th>
                <td><?php if($res_all[0]['validee']) echo 'yes'; else echo 'no'; ?></td>
            </tr>
        </table>
    </fieldset>
    <br><br>
    <fieldset>
        <legend>Contenu de la commande</legend>

        <?php
        echo "<table>";
        echo "<tr><th>Titre</th><th>Auteur</th><th>Prix (€ HT)</th><th>Quantité</th></tr>";
        foreach ($listeLivre_all as $value) {
            echo "<tr class='ligne'><td>" . $value['titre'] . "</td><td>" .$value['auteur']. "</td><td>" . $value['prix'] . "</td><td>" . $value['qte']
                . "</td></tr>";
        }
        echo "</table>";
        ?>

    </fieldset>
    <br><br>
    <div>
        <form action="valider.php" method="post">
            <input name="idcmd" value = <?php echo $idcmd ?> type="hidden" >
            <button id="Valider" type="submit" style="margin-left:40%;margin-right:auto">Valider</button>
        </form>
        <form action="supprimer.php" method="post">
            <input name="idcmd" value = <?php echo $idcmd ?> type="hidden" >
            <button id="Supprimer" type="submit" style="margin-left:40%;margin-right:auto">Supprimer</button>
        </form>
    </div>
</div>
</body>
</html>
