<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Configuration commune (constantes, fuseau horaire, fonction mention())
 * Date     : 18/10/2026
 */

date_default_timezone_set('Africa/Casablanca');

// Constante définie avec const (résolue à la compilation)
const ETABLISSEMENT = "Faculté des Sciences Semlalia - Marrakech";

// Constantes définies avec define() (résolues à l'exécution)
define('NOTE_MIN', 0);
define('NOTE_MAX', 20);
define('SEUIL', 10);

/**
 * Exercice 2.1 : retourne la mention correspondant à une note.
 * Placée ici (et non dans exo2_flux.php) pour être réutilisée par
 * exo3_tableaux.php, liste.php, etc. sans afficher le contenu d'exo2.
 */
function mention($note)
{
    if ($note >= 16) {
        return "Très bien";
    } elseif ($note >= 14) {
        return "Bien";
    } elseif ($note >= 12) {
        return "Assez bien";
    } elseif ($note >= SEUIL) {
        return "Passable";
    } else {
        return "Ajourné";
    }
}
