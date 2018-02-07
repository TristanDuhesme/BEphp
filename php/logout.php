<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Déconnexion</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>
<div class="centreOmbre grandTableau">
    <h2>
        <?php
		session_start();
		session_destroy();
		echo 'Vous avez bien été déconnecté. <br/><a href="../html/index.html">Se reconnecter</a>';
        ?>
    </h2>
</div>
</body>
</html>
