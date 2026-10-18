<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Exercice 4.2 - traiter le formulaire info.html (méthode GET)
 * Date     : 18/10/2026
 */
require 'includes/entete_inc.php';
require 'includes/menu_inc.php';

$nom    = trim($_GET['nom'] ?? '');
$prenom = trim($_GET['prenom'] ?? '');
$sexe   = $_GET['sexe'] ?? '';

if ($nom === '' || $prenom === '') {
    echo '<p class="erreur">Veuillez remplir le nom et le prénom.</p>';
} else {
    $civilite = ($sexe === 'F') ? 'Madame' : 'Monsieur';
    echo "<p>Bonjour $civilite " . htmlspecialchars($prenom) . " " . htmlspecialchars($nom) . "</p>";
}
echo '<p><a href="info.html">Retour au formulaire</a></p>';

// Observation : avec GET, les données apparaissent dans l'URL, par exemple
// info.php?nom=Lahgazi&prenom=Abdellatif&sexe=M (visible, copiable, gardée dans
// l'historique et les logs du serveur).

require 'includes/pied_inc.php';
