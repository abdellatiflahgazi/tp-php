<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Exercice 6.1 - déconnexion (vider et détruire la session)
 * Date     : 18/10/2026
 */
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit;
