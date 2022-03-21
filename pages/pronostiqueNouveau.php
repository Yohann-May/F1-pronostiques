<?php
include("header.php");
include("../fonctions/fonctions.php");

if (!isset($_SESSION['nom']) && !isset($_SESSION['id'])) {
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
    <title>F1 - Pronostiques</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
if (isset($_POST['GP']) && isset($_POST['P1']) && isset($_POST['P2']) && isset($_POST['P3']) && isset($_POST['newProno'])) {
    $P1 = getParam('P1');
    $P2 = getParam('P2');
    $P3 = getParam('P3');
    $GP = getParam('GP');
    $values =  array($P1, $P2, $P3);
    if (count(array_unique($values)) === 3 && $GP != '') {
        if (!newProno($_SESSION['id'], $GP, $P1, $P2, $P3)) { ?>
            <div class="container mt-3">
                <div class="row d-flex justify-content-center">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur !</strong> Vous avez déjà créé un pronostique pour le GP de <strong><?php echo getGP($GP) ?></strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php
        } else { ?>
            <div class="container mt-3">
                <div class="row d-flex justify-content-center">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Votre pronostique pour le GP de <strong><?php echo getGP($GP) ?></strong> vient d'être enregistré.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
?>
<form action="" method="post">
    <div class="container mt-5 border-bottom">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="GP" style="width: 160px;">Grand prix</label>
            </div>
            <select class="custom-select" id="GP" name="GP">
                <option selected disabled>Sélectionner...</option>
                <?php
                $GPs = getAllGP();
                foreach($GPs as $GP) { ?>
                    <option value="<?php echo $GP['numero'] ?>"  <?php if(getParam('GP') === $GP['numero']) echo "selected" ?>>
                        <?php echo $GP['numero']." - ".$GP['piste'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="container mt-3">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="P1" style="width: 160px;">Qui finit premier ?</label>
            </div>
            <select class="custom-select" id="P1" name="P1">
                <option selected disabled>Sélectionner...</option>
                <?php
                $pilotes = getAllPilotes();
                foreach($pilotes as $pilote) { ?>
                    <option value="<?php echo $pilote['number'] ?>" <?php if(getParam('P1') === $pilote['number']) echo "selected" ?>>
                        <?php echo number($pilote['number'])." - ".$pilote['first_name']." ".$pilote['last_name']." (".$pilote['team'].")"?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="container mt-2">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="P2" style="width: 160px;">Qui finit second ?</label>
            </div>
            <select class="custom-select" id="P2" name="P2">
                <option selected disabled>Sélectionner...</option>
                <?php
                $pilotes = getAllPilotes();
                foreach($pilotes as $pilote) { ?>
                    <option value="<?php echo $pilote['number'] ?>" <?php if(getParam('P2') === $pilote['number']) echo "selected" ?>>
                        <?php echo number($pilote['number'])." - ".$pilote['first_name']." ".$pilote['last_name']." (".$pilote['team'].")"?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="container mt-2">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="P3" style="width: 160px;">Qui finit troisième ?</label>
            </div>
            <select class="custom-select" id="P3" name="P3">
                <option selected disabled>Sélectionner...</option>
                <?php
                $pilotes = getAllPilotes();
                foreach($pilotes as $pilote) { ?>
                    <option value="<?php echo $pilote['number'] ?>"  <?php if(getParam('P3') === $pilote['number']) echo "selected" ?>>
                        <?php echo number($pilote['number'])." - ".$pilote['first_name']." ".$pilote['last_name']." (".$pilote['team'].")"?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="container mt-2">
        <div class="mb-3">
            <button class="btn btn-primary btn-block" type="submit" name="newProno">Créer pronostique</button>
        </div>
    </div>
</form>
</body>
</html>

<?php
function number(int $number) {
    return $number < 10 ? "0".$number : $number;
}
