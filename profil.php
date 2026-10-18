<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Exercices 6.1 et 6.3 - page protégée par session, validation de date
 * Date     : 18/10/2026
 */
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'includes/entete_inc.php';
require 'includes/menu_inc.php';
?>
<h2>Profil</h2>
<p>Bienvenue, <?= htmlspecialchars($_SESSION['login']) ?> !</p>
<p><a href="deconnexion.php">Se déconnecter</a></p>

<h3>Validation d'une date (checkdate)</h3>
<form action="profil.php" method="get">
    Jour <input type="number" name="jour" min="1" max="31" size="3">
    Mois <input type="number" name="mois" min="1" max="12" size="3">
    Année <input type="number" name="annee" min="1900" max="2100" size="5">
    <button type="submit">Vérifier</button>
</form>
<?php
if (isset($_GET['jour'], $_GET['mois'], $_GET['annee'])
    && $_GET['jour'] !== '' && $_GET['mois'] !== '' && $_GET['annee'] !== '') {
    $j = (int) $_GET['jour'];
    $m = (int) $_GET['mois'];
    $a = (int) $_GET['annee'];
    if (checkdate($m, $j, $a)) {
        printf('<p>%02d/%02d/%04d est une date valide.</p>', $j, $m, $a);
    } else {
        printf('<p class="erreur">%02d/%02d/%04d n\'est pas une date valide.</p>', $j, $m, $a);
    }
}
require 'includes/pied_inc.php';
