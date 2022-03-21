<!doctype html>
<?php
include("header.php");
include("../fonctions/fonctions.php");

if (isset($_SESSION['nom']) && isset($_SESSION['id'])) {
    header("Location: monCompte.php");
    exit;
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/bootstrap-5.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="../style/connexion.css">
    <title>F1 - Pronostiques</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
if (isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {
    $email = getParam('inputEmail');
    $pwd = getParam('inputPassword');
    $valid = true;
    if (isset($_POST['register'])) {
        $email = trim($email);
        if (empty($email)) {
            $valid = false;
        }
        if (!userExist($email)) {
            $valid = false;
        }
        if ($valid) {
            $id = getId($email);
            $pass_hash = getPass($email);
            if (password_verify($pwd, $pass_hash)) {
                $_SESSION['pseudo'] = getPseudo($id);
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $id;
                header('Location:  monCompte.php');
                exit;
            } else { ?>
                <div class="container mt-3">
                    <div class="row d-flex justify-content-center">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Mot de passe incorrect.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="container mt-3">
                <div class="row d-flex justify-content-center">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Adresse mail incorrect
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php }
    }
}
?>


<form method="post" class="form-signin">
    <div class="text-center mb-4 mt-5 border-bottom">
        <h1 class="h3 mb-3 font-weight-normal">Veuillez vous connecter</h1>
    </div>
    <label for="inputEmail" class="sr-only">Adresse mail</label>
    <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Adresse mail" required="" value="<?php echo getParam('inputEmail') ?>">
    <label for="inputPassword" class="sr-only">Mot de passe</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de passe" required="" value="<?php echo getParam('inputPassword') ?>">
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Se souvenir de moi
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Se connecter</button>
    <p class="mb-3 text-muted">Pas de compte ? <a href="inscription.php">Inscription</a></p>
    <p class="mt-5 mb-3 text-muted">© 2022</p>
</form>


</body>
</html>
