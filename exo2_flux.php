<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Partie 2 - structures de contrôle et boucles
 * Date     : 18/10/2026
 */
header('Content-Type: text/html; charset=utf-8');
require __DIR__ . '/config.php'; // fournit SEUIL et la fonction mention()

echo "<h2>Exercice 2.1 : mention()</h2>";
foreach ([18, 16, 15, 14, 12, 11, SEUIL, 9, 0] as $n) {
    echo "$n => " . mention($n) . "<br>";
}

echo "<h2>Exercice 2.2 : switch</h2>";
$mois = (int) date("m"); // "10" -> 10
switch ($mois) {
    case 1:  $nom = "janvier"; break;
    case 2:  $nom = "février"; break;
    case 3:  $nom = "mars"; break;
    case 4:  $nom = "avril"; break;
    case 5:  $nom = "mai"; break;
    case 6:  $nom = "juin"; break;
    case 7:  $nom = "juillet"; break;
    case 8:  $nom = "août"; break;
    case 9:  $nom = "septembre"; break;
    case 10: $nom = "octobre"; break;
    case 11: $nom = "novembre"; break;
    case 12: $nom = "décembre"; break;
    default: $nom = "mois inconnu";
}
echo "Nous sommes en $nom.<br>";
// Q3 : sans break, l'exécution « tombe » dans le case suivant (fall-through) :
// les instructions des cases suivants s'exécutent jusqu'au prochain break
// (ou la fin du switch), même si leur condition n'est pas vraie.

echo "<h2>Exercice 2.3 : boucles</h2>";
echo "<h3>1. Triangle</h3>";
for ($i = 1; $i <= 6; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

echo "<h3>2. while : 0 à 20 par pas de 2</h3>";
$n = 0;
while ($n <= 20) {
    echo ($n == 10) ? "<strong>$n</strong> " : "$n ";
    $n += 2;
}

echo "<h3>3. for + continue : nombres pairs de 0 à 10</h3>";
for ($n = 0; $n <= 10; $n++) {
    if ($n % 2 != 0) {
        continue; // saute les impairs
    }
    echo "$n ";
}

echo "<h3>4. while + switch + break 2</h3>";
$i = 1;
while (true) {
    switch ($i) {
        case 5:
            echo "At 5<br>";
            break;          // sort uniquement du switch
        case 10:
            echo "At 10; quitting<br>";
            break 2;        // sort du switch ET de la boucle
        default:
            break;
    }
    $i++;
}

echo "<h3>5. do-while : 0 à 20 par pas de 2</h3>";
$n = 0;
do {
    echo ($n == 10) ? "<strong>$n</strong> " : "$n ";
    $n += 2;
} while ($n <= 20);
// Différence essentielle : while teste la condition AVANT chaque tour (peut ne
// jamais s'exécuter), do-while la teste APRÈS : le corps s'exécute au moins une fois.
echo "<br>Avec \$n = 30 : ";
$n = 30;
while ($n <= 20) { echo "while : $n "; $n += 2; }   // n'affiche rien
do { echo "do-while : $n "; $n += 2; } while ($n <= 20); // affiche 30 une fois
