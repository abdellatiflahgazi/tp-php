<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : En-tête HTML commun (titre basé sur la constante ETABLISSEMENT)
 * Date     : 18/10/2026
 */
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars(ETABLISSEMENT) ?> - TP PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; margin: 10px 0; }
        th, td { border: 1px solid #888; padding: 4px 10px; }
        th { background: #eee; }
        .echec { color: red; }
        .erreur { color: red; font-weight: bold; }
        nav a { margin-right: 12px; }
        footer { margin-top: 30px; border-top: 1px solid #ccc; color: #555; }
    </style>
</head>
<body>
<header>
    <h1>Suivi des notes - <?= htmlspecialchars(ETABLISSEMENT) ?></h1>
</header>
