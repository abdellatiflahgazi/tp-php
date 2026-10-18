<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Exercices 4.3 et 5.1 - valider la saisie POST et l'ajouter à data/notes.csv
 * Date     : 18/10/2026
 */
require 'includes/entete_inc.php';
require 'includes/menu_inc.php';

$erreurs = [];

if (!isset($_POST['nom'], $_POST['note_info'], $_POST['note_math'])) {
    $erreurs[] = "Formulaire non soumis ou champs manquants.";
} else {
    $nom  = trim($_POST['nom']);
    $info = str_replace(',', '.', trim($_POST['note_info']));
    $math = str_replace(',', '.', trim($_POST['note_math']));

    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }

    // Attention : empty("0") vaut true ! Une note de 0 est valide, donc pour les
    // notes on compare avec '' au lieu d'utiliser empty().
    foreach (['informatique' => $info, 'mathématiques' => $math] as $matiere => $valeur) {
        if ($valeur === '') {
            $erreurs[] = "La note de $matiere est obligatoire.";
        } elseif (!is_numeric($valeur)) {
            $erreurs[] = "La note de $matiere doit être un nombre.";
        } elseif ($valeur < NOTE_MIN || $valeur > NOTE_MAX) {
            $erreurs[] = "La note de $matiere doit être comprise entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
        }
    }
}

if (!empty($erreurs)) {
    foreach ($erreurs as $e) {
        echo '<p class="erreur">' . htmlspecialchars($e) . '</p>';
    }
    echo '<p><a href="saisie.html">Retour à la saisie</a></p>';
} else {
    // Exercice 5.1 : écriture dans le CSV
    $dossier = __DIR__ . '/data';
    if (!is_dir($dossier)) {
        mkdir($dossier, 0755, true);
    }
    $f = fopen($dossier . '/notes.csv', 'a');      // "a" : ajout en fin de fichier
    if ($f === false) {
        echo '<p class="erreur">Impossible d\'ouvrir le fichier de notes.</p>';
    } else {
        fputcsv($f, [$nom, $info, $math], ';', '"', '');
        fclose($f);

        echo "<h2>Récapitulatif</h2>";
        echo "<ul>";
        echo "<li>Nom : " . htmlspecialchars($nom) . "</li>";
        echo "<li>Informatique : " . htmlspecialchars($info) . "</li>";
        echo "<li>Mathématiques : " . htmlspecialchars($math) . "</li>";
        echo "</ul>";
        echo '<p>Enregistré. <a href="saisie.html">Saisir un autre apprenant</a> | <a href="liste.php">Voir la liste</a></p>';
    }
}

// Questions :
// - POST plutôt que GET pour un mot de passe : en GET, le mot de passe apparaît dans
//   l'URL (barre d'adresse, historique, favoris, logs du serveur, en-tête Referer).
//   En POST, il est dans le corps de la requête (il faut quand même HTTPS pour le chiffrer).
// - $_REQUEST : tableau qui fusionne $_GET, $_POST (et éventuellement $_COOKIE selon
//   la directive request_order / variables_order). Par défaut GET puis POST, POST écrase GET.
// - Mode "w" au lieu de "a" : le fichier est VIDÉ à chaque ouverture, donc seul le
//   dernier apprenant saisi serait conservé.

require 'includes/pied_inc.php';
