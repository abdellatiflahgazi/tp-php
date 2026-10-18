<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Exercices 5.2 et 5.3 - lire data/notes.csv et afficher les résultats
 * Date     : 18/10/2026
 */
require 'includes/entete_inc.php';
require 'includes/menu_inc.php';

$fichier = __DIR__ . '/data/notes.csv';

if (!file_exists($fichier)) {
    echo '<p class="erreur">Aucune note enregistrée pour le moment. <a href="saisie.html">Saisir un apprenant</a></p>';
    require 'includes/pied_inc.php';
    exit;
}

$f = fopen($fichier, 'r');
if ($f === false) {
    echo '<p class="erreur">Impossible d\'ouvrir le fichier de notes.</p>';
    require 'includes/pied_inc.php';
    exit;
}

echo "<h2>Liste des apprenants (fgetcsv)</h2>";
echo "<table><tr><th>Nom</th><th>Info</th><th>Math</th><th>Moyenne</th><th>Mention</th></tr>";
$sommeMoyennes = 0;
$nb = 0;
while (($ligne = fgetcsv($f, 0, ';', '"', '')) !== false) {
    if ($ligne === [null] || count($ligne) < 3) {
        continue; // ligne vide ou incomplète
    }
    [$nom, $info, $math] = $ligne;
    $moyenne = ((float) $info + (float) $math) / 2;
    $sommeMoyennes += $moyenne;
    $nb++;
    $classe = ($moyenne < SEUIL) ? ' class="echec"' : '';
    echo "<tr$classe><td>" . htmlspecialchars($nom) . "</td><td>$info</td><td>$math</td><td>"
       . number_format($moyenne, 2, ',', ' ') . "</td><td>" . mention($moyenne) . "</td></tr>";
}
fclose($f);
echo "</table>";

if ($nb > 0) {
    echo "<p><strong>Moyenne générale de la classe : " . number_format($sommeMoyennes / $nb, 2, ',', ' ') . " / " . NOTE_MAX . "</strong></p>";
} else {
    echo "<p>Le fichier est vide.</p>";
}

// ---- Exercice 5.3 : lecture « bas niveau » ----
echo "<h2>Même fichier avec fgets / feof / explode</h2><ul>";
$f = fopen($fichier, 'r');
while (!feof($f)) {
    $ligne = fgets($f);
    if ($ligne === false) {
        break;
    }
    $ligne = trim($ligne);
    if ($ligne === '') {
        continue;
    }
    $champs = explode(';', $ligne);
    // fputcsv entoure de guillemets les champs contenant un espace : on les retire à la main
    $champs = array_map(fn($c) => trim($c, '"'), $champs);
    echo "<li>" . htmlspecialchars(implode(' | ', $champs)) . "</li>";
}
fclose($f);
echo "</ul>";

// Comparaison :
// fgetcsv : gère les guillemets, les séparateurs/retours à la ligne DANS un champ,
//   et retourne directement un tableau. Un peu moins de contrôle sur la ligne brute.
// fgets + explode : simple et rapide, contrôle total sur la ligne brute, mais fragile :
//   un nom contenant « ; » ou un champ entre guillemets casse le découpage, et il faut
//   nettoyer les guillemets et les fins de ligne soi-même.

require 'includes/pied_inc.php';
