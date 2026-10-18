<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Partie 0 et 1 - variables, constantes, types et chaînes
 * Date     : 18/10/2026
 */
header('Content-Type: text/html; charset=utf-8');
?>
<?php echo 'Hello PHP'; ?>
<br>
<?php
// Commentaire sur une ligne avec //
# Commentaire sur une ligne avec #
/* Commentaire
   sur plusieurs lignes */

echo "<h2>Exercice 1.1 : noms de variables</h2>";
// $x       : valide
// $_x      : valide (le underscore est autorisé en premier caractère)
// $2x      : INVALIDE (ne peut pas commencer par un chiffre)
// $x-y     : INVALIDE (le tiret est lu comme l'opérateur « moins »)
// $Prix_HT : valide (lettres, chiffres et underscore)
// $prix ht : INVALIDE (l'espace est interdit)
// $état    : valide (les octets 0x80-0xFF sont acceptés), mais déconseillé
$x = 1;
$_x = 2;
$Prix_HT = 100;
$état = "ok";
echo "x=$x, _x=$_x, Prix_HT=$Prix_HT, état=$état<br>";

$a = 1;
$A = 2;
echo "\$a vaut $a et \$A vaut $A : PHP est sensible à la casse, ce sont deux variables distinctes.<br>";

echo "<h2>Exercice 1.2 : constantes</h2>";
require __DIR__ . '/config.php';
echo "ETABLISSEMENT = " . ETABLISSEMENT . "<br>";
echo "NOTE_MIN = " . NOTE_MIN . "<br>";
echo "NOTE_MAX = " . NOTE_MAX . "<br>";
echo "SEUIL = " . SEUIL . "<br>";
echo "defined('SEUIL') : ";
var_dump(defined('SEUIL'));
echo "<br>defined('INCONNUE') : ";
var_dump(defined('INCONNUE'));
echo "<br>";

// Q1 : afficher une constante non définie ?
//   PHP 8+ : lève une Error « Undefined constant "INCONNUE" » (le script s'arrête).
//   PHP 7  : simple Warning, et la constante est traitée comme la chaîne "INCONNUE".
try {
    echo INCONNUE;
} catch (Error $e) {
    echo "Erreur attrapée : " . $e->getMessage() . "<br>";
}
// Q2 : différence const / define()
//   - const est résolu à la compilation : il doit être au niveau global (ou dans une classe),
//     pas dans un if, une boucle ou une fonction, et son nom est écrit en littéral.
//   - define() est une fonction exécutée à l'exécution : on peut l'appeler dans une
//     condition et calculer le nom de la constante dynamiquement.
//   - const peut aussi être utilisé pour les constantes de classe.

echo "<h2>Exercice 1.3 : calcul</h2>";
$prix_ht = 60;
$tva = 20;
$prix_ttc = $prix_ht + $prix_ht * $tva / 100;
echo "Le prix TTC du produit est de $prix_ttc €.<br>";

echo "<h2>Exercice 1.4 : types et conversions</h2><pre>";
$test = 42;
$test = (string) $test;
var_dump($test);                      // string(2) "42"

// Prédictions : 0 => false, 0.0 => false, "0" => false, "" => false,
//               "abc" => true, [] => false, null => false
foreach ([0, 0.0, "0", "", "abc", [], null] as $v) {
    echo str_pad(var_export($v, true), 8) . " => ";
    var_dump((bool) $v);
}

// Prédictions : (int) 3.9 = 3 (troncature), (int) "12abc" = 12,
//               (float) "1.5e3" = 1500, (int) true = 1
var_dump((int) 3.9);
var_dump((int) "12abc");
var_dump((float) "1.5e3");
var_dump((int) true);

// 255 dans les quatre notations (la valeur affichée est toujours 255)
$dec = 255;
$hex = 0xFF;
$oct = 0377;
$bin = 0b11111111;
echo "Décimal     : $dec\n";
echo "Hexadécimal : $hex (écrit 0xFF, affiché en hexa : " . dechex($hex) . ")\n";
echo "Octal       : $oct (écrit 0377, affiché en octal : " . decoct($oct) . ")\n";
echo "Binaire     : $bin (écrit 0b11111111, affiché en binaire : " . decbin($bin) . ")\n";
echo "</pre>";

echo "<h2>Exercice 1.5 : chaînes de caractères</h2>";
$traitees = "égales à";
$ici = 2;
echo 'Ahmed a dit : "J\'ai réussi"', "<br>";
echo 'Voulez-vous supprimer C:\*.*?', "<br>";
echo 'Ceci n\'affichera pas \n de nouvelle ligne', "<br>";
echo 'Les variables ne seront pas $traitees $ici', "<br>";
echo "Les variables seront $traitees $ici", "<br>";

$chaine = trim("*Bonjour les développeurs*", "*");
echo "Après trim : $chaine<br>";

// strlen() compte des OCTETS : « é » en occupe 2 en UTF-8, donc une boucle
// for($i < strlen) coupe la lettre « é » en deux octets illisibles.
// On découpe donc d'abord la chaîne en vrais caractères (modificateur /u).
$lettres = preg_split('//u', $chaine, -1, PREG_SPLIT_NO_EMPTY);
echo "strlen = " . strlen($chaine) . " octets, " . count($lettres) . " caractères<br>";
for ($i = 0; $i < count($lettres); $i++) {
    echo $lettres[$i] . "<br>";
}
