<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Commande</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <script src="script.js"></script>
</head>
<body>
<div id="commandeLivres" class="centreOmbre grandTableau">
    <h1>Commander des livres</h1>
    <h2>
        <?php
        session_start();
        if (isset($_SESSION["username"]) && $_SESSION["logged"] === true) {
            echo "Bonjour " . $_SESSION["username"]."( ID:".$_SESSION["idpersonne"].")<br/><a href='logout.php'>Déconnexion</a>";;
	    if(isset($_SESSION["commandeOk"]) && isset($_SESSION["commandeVide"]) && $_SESSION["commandeOk"] === true && $_SESSION["commandeVide"] === false){
		echo "</h2><h2 class='red'><br>La commande est bien prise en compte!";
		$_SESSION["commandeOk"] = false;
		} else if(isset($_SESSION["commandeOk"]) && isset($_SESSION["commandeVide"]) && $_SESSION["commandeOk"] === true && $_SESSION["commandeVide"] === true){
		echo "</h2><h2 class='red'><br>Vous ne pouvez pas commander 0 livre, soyez plus ambitieux !";
		$_SESSION["commandeOk"] = false; 
		}
        } else {
            $_SESSION["logged"] = false;
            die("Vous n'avez pas le droit de consulter cette page!"."<br/><a href=\"../html/index.html\">Connexion</a>");
        }
        require('connectDB.php');
        $books = array();
        $i = 0;
        $res = $dbh->query("SELECT * FROM `ouvrages`");

        $res_all = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res_all as $row) {
            $books[$i]['idouvrage'] = $row['idouvrage'];
            $books[$i]['titre'] = $row['titre'];
            $books[$i]['auteur'] = $row['auteur'];
            $books[$i]['prix'] = $row['prix'];
            $i++;
        }
        ?>
    </h2>
    <form action="commande.php" method="post">
        <?php
        echo "<table>";
        echo "<tr><td><b>ID</b></td><td><b>Titre</b></td><td><b>Auteur</b></td><td><b>Prix (€ HT)</b></td><td><b>Quantité</b></td></tr>";
        foreach ($books as $value) {
            echo "<tr><td>" . $value['idouvrage'] . "</td><td>" .$value['titre']. "</td><td>" . $value['auteur'] . "</td><td>" . $value['prix']
                . "<input name=\"idouvrage[]\" value =".$value['idouvrage'] ." type=\"hidden\" >"
                . "<td class=\"quantiteLivre[]\"><input name=\"quantiteLivre[]\" type=\"number\" value=\"0\" min=\"0\" ></td>"
                . "</td></tr>";
        }
echo "</table>";
        ?>
        <button id="submit2" type="submit">Passer commande</button>
    </form>
</div>
</body>
</html>

