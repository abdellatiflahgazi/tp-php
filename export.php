<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Exercice 5.4 - exporter les résultats en JSON et comparer avec serialize()
 * Date     : 18/10/2026
 */
require 'includes/entete_inc.php';
require 'includes/menu_inc.php';

$csv  = __DIR__ . '/data/notes.csv';
$json = __DIR__ . '/data/notes.json';

// 1. Construire le tableau associatif des résultats à partir du CSV
$resultats = [];
if (file_exists($csv) && ($f = fopen($csv, 'r')) !== false) {
    while (($l = fgetcsv($f, 0, ';', '"', '')) !== false) {
        if ($l === [null] || count($l) < 3) {
            continue;
        }
        $resultats[] = [
            'nom'     => $l[0],
            'info'    => (float) $l[1],
            'math'    => (float) $l[2],
            'moyenne' => ((float) $l[1] + (float) $l[2]) / 2,
        ];
    }
    fclose($f);
}

if (empty($resultats)) {
    echo '<p class="erreur">Aucun résultat à exporter. <a href="saisie.html">Saisir des apprenants</a></p>';
    require 'includes/pied_inc.php';
    exit;
}

// 2. Écriture dans notes.json
$contenu = json_encode($resultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents($json, $contenu);
echo "<p>Fichier <code>data/notes.json</code> écrit (" . count($resultats) . " apprenant(s)).</p>";

// 3. Relecture et affichage
$relu = json_decode(file_get_contents($json), true);
echo "<h2>Relu avec json_decode (print_r)</h2><pre>" . htmlspecialchars(print_r($relu, true)) . "</pre>";

// 4. Comparaison serialize / json_encode
echo "<h2>serialize()</h2><pre>" . htmlspecialchars(serialize($resultats)) . "</pre>";
echo "<h2>json_encode()</h2><pre>" . htmlspecialchars(json_encode($resultats, JSON_UNESCAPED_UNICODE)) . "</pre>";

// Question : JSON est directement exploitable par JavaScript (JSON.parse / fetch().json()).
// serialize() produit un format propre à PHP, lisible seulement par unserialize().

require 'includes/pied_inc.php';
