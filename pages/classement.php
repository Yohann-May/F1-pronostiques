<?php
include("header.php");
include("../fonctions/fonctions.php");

if (!isset($_SESSION['nom']) && !isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit;
}
$line = 0;
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>F1 - Pronostiques</title>
</head>
<body>
<div class="mt-3">
    <h1 class="h3 mb-3 font-weight-normal">Classement de la saison 2022</h1>
</div>
<?php
$array = [];
foreach (getAllPronos() as $prono) {
    $userid = $prono['user_id'];
    foreach (getAllResultatsGP($prono['gp']) as $resultat) {
        $points = 0;
        if ($prono['P1'] === $resultat['P1']) {
            $points += 2;
        }
        if ($prono['P2'] === $resultat['P2']) {
            $points += 2;
        }
        if ($prono['P3'] === $resultat['P3']) {
            $points += 2;
        }

        if (key_exists($userid, $array))
            $array["$userid"] += $points;
        else
            $array["$userid"] = $points;
    }
}
foreach ($array as $key => $val) {
    echo getPseudo($key)." - ".$val."<br/>";
}

/*foreach (getAllResultats() as $resultat) {
    foreach (getAllPronosGP($resultat['gp']) as $prono) {
        $points = 0;
        if ($prono['P1'] === $resultat['P1']) {
            $points += 2;
        }
        if ($prono['P2'] === $resultat['P2']) {
            $points += 2;
        }
        if ($prono['P3'] === $resultat['P3']) {
            $points += 2;
        }

        echo getPseudo($prono['user_id'])." - ".$points."<br/>";
    }
}*/
?>

<!--<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Classement</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Points</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach (getAllPronos() as $prono) {
            $line++;
            var_dump($prono['P1']);
            ?>
            <tr>
                <th scope="row"><?php echo $line ?></th>
                <td><?php echo getPseudo($prono['user_id']) ?></td>
                <td></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>-->
</body>
</html>
