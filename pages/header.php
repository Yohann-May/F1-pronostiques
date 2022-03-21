<link rel="stylesheet" href="../style/bootstrap-5.1.3/css/bootstrap.css">
<link rel="stylesheet" href="../style/header.css">
<?php
include("../bd/connexionBD.php");
session_start();

$isConnect = isset($_SESSION['pseudo']) && isset($_SESSION['id']);
$actualPage = basename($_SERVER['PHP_SELF'], '.php');
?>

<nav class="navbar navbar-light sticky-top">
    <div class="container d-flex justify-content-center">
        <ul class="navigation">
            <li class="<?php if ($actualPage === "accueil") echo "current"; ?>"><a href="accueil.php" class="nav-link">Accueil</a></li>
            <?php if ($isConnect) { ?>
                <li class="<?php if (str_contains($actualPage,"pronostique")) echo "current"; ?>"><a href="pronostiques.php" class="nav-link">Pronostiques</a></li>
                <li class="<?php if ($actualPage === "monCompte") echo "current"; ?>"><a href="monCompte.php" class="nav-link">Mon compte</a></li>
            <?php } else { ?>
                <li class="<?php if ($actualPage === "connexion") echo "current"; ?>"><a href="connexion.php" class="nav-link">Se connecter</a></li>
            <?php }?>
        </ul>
    </div>
</nav>