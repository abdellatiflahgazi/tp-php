<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Partie 3 et exercice 4.1 - tableaux, tris, statistiques, include/require
 * Date     : 18/10/2026
 */
require 'includes/entete_inc.php';
require 'includes/menu_inc.php';

/* ---- Exercice 4.1, expériences (à tester en décommentant) ----
 * Expérience 1 : fichier inexistant
 *   include 'includes/inexistant_inc.php';
 *     -> Warning (E_WARNING) « Failed to open stream » puis « Failed opening ... »,
 *        MAIS la suite du script s'exécute normalement.
 *   require 'includes/inexistant_inc.php';
 *     -> Fatal error (E_COMPILE_ERROR / Error non rattrapable) : le script S'ARRÊTE,
 *        rien de ce qui suit n'est exécuté.
 * Expérience 2 : inclure deux fois menu_inc.php
 *   include 'includes/menu_inc.php'; include 'includes/menu_inc.php';
 *     -> le menu est affiché deux fois.
 *   include_once 'includes/menu_inc.php'; include_once 'includes/menu_inc.php';
 *     -> le menu n'est affiché qu'une fois (le second appel est ignoré).
 *   (Pour un fichier qui déclare une fonction ou une constante, comme config.php,
 *    une double inclusion simple provoquerait une erreur « Cannot redeclare ».)
 */

/** Affiche un tableau associatif nom => note dans un tableau HTML. */
function afficher($tab)
{
    echo "<table><tr><th>Nom</th><th>Note</th></tr>";
    foreach ($tab as $nom => $note) {
        echo "<tr><td>" . htmlspecialchars($nom) . "</td><td>$note</td></tr>";
    }
    echo "</table>";
}

echo "<h2>Exercice 3.1 : création</h2>";
$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];
$modules = ["Algorithmique", "Base de données", "Programmation web"];

echo "<p>Avec foreach : ";
foreach ($modules as $module) {
    echo "$module ; ";
}
echo "</p><p>Avec les indices : ";
for ($i = 0; $i < count($modules); $i++) {
    echo "[$i] " . $modules[$i] . " ; ";
}
echo "</p>";

echo "<h2>Exercice 3.2 : affichage HTML</h2>";
echo "<table><tr><th>Nom</th><th>Note</th><th>Mention</th></tr>";
foreach ($notes as $nom => $note) {
    $classe = ($note < SEUIL) ? ' class="echec"' : '';
    echo "<tr$classe><td>$nom</td><td>$note</td><td>" . mention($note) . "</td></tr>";
}
echo "</table>";

echo "<h2>Exercice 3.3 : statistiques</h2>";
// 1. Sans array_sum : boucle
$somme = 0;
$nb = 0;
$meilleure = NOTE_MIN;
$faible = NOTE_MAX;
foreach ($notes as $note) {
    $somme += $note;
    $nb++;
    if ($note > $meilleure) {
        $meilleure = $note;
    }
    if ($note < $faible) {
        $faible = $note;
    }
}
$moyenne = $somme / $nb;
echo "<p>Boucle : somme = $somme, moyenne = " . round($moyenne, 2) . ", meilleure = $meilleure, plus faible = $faible</p>";

// 2. Vérification avec les fonctions natives
echo "<p>Fonctions : somme = " . array_sum($notes) . ", moyenne = " . round(array_sum($notes) / count($notes), 2)
   . ", meilleure = " . max($notes) . ", plus faible = " . min($notes) . "</p>";

// 3. Effectifs par mention
$effectifs = ["Très bien" => 0, "Bien" => 0, "Assez bien" => 0, "Passable" => 0, "Ajourné" => 0];
foreach ($notes as $note) {
    $effectifs[mention($note)]++;
}
echo "<table><tr><th>Mention</th><th>Effectif</th></tr>";
foreach ($effectifs as $m => $e) {
    echo "<tr><td>$m</td><td>$e</td></tr>";
}
echo "</table>";

echo "<h2>Exercice 3.4 : tri</h2>";
// Les fonctions de tri modifient le tableau PASSÉ : on travaille sur une copie.
$t = $notes; ksort($t);
echo "<h3>Noms croissants (ksort)</h3>";  afficher($t);

$t = $notes; arsort($t);
echo "<h3>Notes décroissantes (arsort)</h3>"; afficher($t);

$t = $notes; krsort($t);
echo "<h3>Noms décroissants (krsort)</h3>"; afficher($t);

$t = $notes; asort($t);
echo "<h3>Notes croissantes (asort)</h3>"; afficher($t);
// Q : sur un tableau indexé comme $modules, on utilise sort() (croissant) ou rsort()
// (décroissant) : elles réindexent 0,1,2... alors que asort/ksort conservent les clés.

echo "<h2>Exercice 3.5 : opérateurs de tableaux</h2>";
$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];
echo "<pre>";
echo '$a + $b  : '; var_dump($a + $b);   // ["x"=>1,"y"=>2] : union, les clés de $a priment
echo '$a == $b : '; var_dump($a == $b);  // true  : mêmes paires clé/valeur
echo '$a === $b: '; var_dump($a === $b); // false : mêmes paires mais ordre différent
echo "</pre>";
// Explication : + fait l'union (on garde les clés de gauche, on ajoute les clés
// absentes de droite). == compare les paires clé/valeur sans tenir compte de
// l'ordre. === exige en plus le même ORDRE et les mêmes types.

require 'includes/pied_inc.php';
