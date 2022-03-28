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
    <title>F1 - Pronostiques</title>
</head>
<body>
<div class="container mt-3">
    <form action="pronostiqueNouveau.php">
        <div class="row">
            <button class="btn btn-outline-primary btn-block" type="submit">Faire un pronostique</button>
        </div>
    </form>

    <table class="table">
        <tbody>
            <tr>
                <th scope="row" class="col-4">Légende</th>
                <td class="table-success col-4">Le pilote a fini la ou vous l'avez prédit <br>2 points</td>
                <td class="table-warning col-4">Le pilote a fini dans le top 3 <br>1 point</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-5">
        <h1 class="h3 mb-3 font-weight-normal">Vos pronostiques</h1>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Grand Prix</th>
                <th scope="col">P1</th>
                <th scope="col">P2</th>
                <th scope="col">P3</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $pronostiques = getPronos($_SESSION['id']);
            foreach ($pronostiques as $prono) {
                $resultat = getResultat($prono['gp']);
                $GP = $P1 = $P2 = $P3 = "";
                foreach ($resultat as $res) {
                    $GP = $res['gp']; $P1 = $res['P1']; $P2 = $res['P2']; $P3 = $res['P3'];
                }
                ?>
                <tr>
                    <th scope="row"><?php echo getGP($prono['gp']) ?></th>
                    <td class="<?php if ($prono['P1'] === $P1 && $GP === $prono['gp']) echo "table-success"; elseif ($GP === $prono['gp'] && ($prono['P1'] === $P2 || $prono['P1'] === $P3)) echo "table-warning"; ?>"><?php echo getPilote($prono['P1']) ?></td>
                    <td class="<?php if ($prono['P2'] === $P2 && $GP === $prono['gp']) echo "table-success"; elseif ($GP === $prono['gp'] && ($prono['P2'] === $P1 || $prono['P2'] === $P3)) echo "table-warning";  ?>"><?php echo getPilote($prono['P2']) ?></td>
                    <td class="<?php if ($prono['P3'] === $P3 && $GP === $prono['gp']) echo "table-success"; elseif ($GP === $prono['gp'] && ($prono['P3'] === $P1 || $prono['P3'] === $P2)) echo "table-warning";  ?>"><?php echo getPilote($prono['P3']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
