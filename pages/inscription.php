<!doctype html>
<?php
include("header.php");
include("../fonctions/fonctions.php");

if (isset($_SESSION['nom']) && isset($_SESSION['id'])) {
    //header("Location: monCompte.php");
    //exit;
}
?>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
$user_pseudo = "";
if (isset($_POST) && isset($_POST['inputPseudo']) && isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {
    $user_pseudo = getParam('inputPseudo');
    $user_mail = getParam('inputEmail');
    $user_pass = password_hash(getParam('inputPassword'),  PASSWORD_DEFAULT );

    if (!userExist($user_pseudo)) {
        if (!userExist($user_mail)) {
            $sql = "INSERT INTO users (login, email, password, date) VALUES (?, ?, ?, now())";
            $data = [$user_pseudo, $user_mail, $user_pass];

            if (insert($sql, $data)) {
                $_SESSION['pseudo'] = $user_pseudo;
                $_SESSION['email'] = $user_mail;
                $_SESSION['id'] = getId($user_mail);;
                header("Location: accueil.php");
            }
        } else { ?>
            <div class="container mt-3">
                <div class="row d-flex justify-content-center">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur !</strong> Votre compte n'a pas pu être créé. L'email <strong><?php echo $user_mail ?></strong> est déjà utilisé.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php
        }
    } else { ?>
        <div class="container mt-3">
            <div class="row d-flex justify-content-center">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erreur !</strong> Votre compte n'a pas pu être créé. Le pseudo <strong><?php echo $user_pseudo ?></strong> est déjà utilisé.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php }
}

?>

<form action="" method="post" class="form-signin">
    <div class="text-center mb-4 mt-5 border-bottom">
        <h1 class="h3 mb-3 font-weight-normal">Inscription</h1>
    </div>

    <div class="form-label-group">
        <input type="text" id="inputPseudo" name="inputPseudo" class="form-control" placeholder="Pseudo" required="" value="<?php echo getParam('inputPseudo'); ?>">
        <label for="inputEmail">Pseudo</label>
    </div>

    <div class="form-label-group">
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Adresse mail" required="" value="<?php echo getParam('inputEmail'); ?>">
        <label for="inputEmail">Adresse mail</label>
    </div>

    <div class="form-label-group">
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de passe" required="">
        <label for="inputPassword">Mot de passe</label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">S'inscrire</button>
    <p class="mb-3 text-muted">Déjà un compte ? <a href="connexion.php">Se connecter</a></p>
    <p class="mt-5 mb-3 text-muted text-center">© 2022</p>
</form>
</body>
</html>
