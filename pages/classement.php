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
<?php
$array = [];
foreach (getAllPronos() as $prono) {
    $userid = $prono['user_id'];
    foreach (getAllResultatsGP($prono['gp']) as $resultat) {
        $points = 0;
        if ($prono['P1'] === $resultat['P1']) $points += 2;
        if ($prono['P2'] === $resultat['P2']) $points += 2;
        if ($prono['P3'] === $resultat['P3']) $points += 2;
        if ($prono['P1'] === $resultat['P1'] && $prono['P2'] === $resultat['P2'] && $prono['P3'] === $resultat['P3'])
            $points += 2;

        if ($prono['P1'] === $resultat['P2'] || $prono['P1'] === $resultat['P3']) $points += 1;
        if ($prono['P2'] === $resultat['P1'] || $prono['P2'] === $resultat['P3']) $points += 1;
        if ($prono['P3'] === $resultat['P1'] || $prono['P3'] === $resultat['P2']) $points += 1;

        if (key_exists($userid, $array))
            $array["$userid"] += $points;
        else
            $array["$userid"] = $points;
    }
}
arsort($array);
?>

<div class="container">
    <div class="mt-4">
        <h1 class="h3 mb-3 font-weight-normal">Classement de la saison 2022</h1>
    </div>
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
        foreach ($array as $key => $val) {
            $line++;
            ?>
            <tr>
                <th scope="row"><?php echo $line ?></th>
                <td><?php echo getPseudo($key) ?></td>
                <td><?php echo $val ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
