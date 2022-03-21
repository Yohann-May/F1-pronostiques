<?php
include("header.php");
include("../fonctions/fonctions.php");

if (!isset($_SESSION['nom']) && !isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit;
}

if (isset($_POST['deconnect'])) {
    session_destroy();
    header("Location: connexion.php");
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/bootstrap-5.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="../style/inscription.css">
    <title>F1 - Pronostiques</title>
</head>
<body>
<form action="" method="post" class="form-signin">
    <div class="text-center mb-4 mt-5 border-bottom">
        <h1 class="h3 mb-3 font-weight-normal">Mon compte</h1>
    </div>

    <div class="form-label-group">
        <input disabled type="text" id="inputPseudo" name="inputPseudo" class="form-control" placeholder="Pseudo" required="" value="<?php echo $_SESSION['pseudo'] ?>">
        <label for="inputPseudo">Pseudo</label>
    </div>

    <div class="form-label-group">
        <input disabled type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Adresse mail" required="" value="<?php echo $_SESSION['email'] ?>">
        <label for="inputEmail">Adresse mail</label>
    </div>
    <p class="mb-3 text-muted">
        <button class="btn btn-block btn-outline-danger" type="submit" name="deconnect">Se déconnecter</button>
    </p>
    <p class="mt-5 mb-3 text-muted text-center">© 2022</p>
</form>
</body>
</html>
