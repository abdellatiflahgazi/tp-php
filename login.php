<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Exercices 6.1 et 6.2 - connexion par session et cookies
 * Date     : 18/10/2026
 */
session_start(); // doit être la toute première instruction (avant tout affichage)

$erreur = '';
$login  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    if ($login === '') {
        $erreur = "Veuillez saisir un login.";
    } else {
        $_SESSION['login'] = $login;

        // Cookie simple valable 24 h
        setcookie("dernier_login", $login, time() + 86400, "/");
        // Variante : un seul cookie contenant un tableau (login + date) encodé en JSON
        setcookie("connexion_info", json_encode(['login' => $login, 'date' => date('d/m/Y H:i')]), time() + 86400, "/");

        header("Location: profil.php");
        exit;
    }
}

// Pré-remplissage avec le dernier login mémorisé
$valeur = $login !== '' ? $login : ($_COOKIE['dernier_login'] ?? '');
$derniere = isset($_COOKIE['connexion_info']) ? json_decode($_COOKIE['connexion_info'], true) : null;

require 'includes/entete_inc.php';
require 'includes/menu_inc.php';
?>
<h2>Connexion</h2>
<?php if ($erreur): ?>
    <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>
<?php if (is_array($derniere) && isset($derniere['login'], $derniere['date'])): ?>
    <p>Dernière connexion : <?= htmlspecialchars($derniere['login']) ?> le <?= htmlspecialchars($derniere['date']) ?></p>
<?php endif; ?>
<form action="login.php" method="post">
    <p><label>Login : <input type="text" name="login" value="<?= htmlspecialchars($valeur) ?>" required></label></p>
    <p><button type="submit">Se connecter</button></p>
</form>
<?php
// Questions :
// - Une session est stockée CÔTÉ SERVEUR (fichiers dans session.save_path) ; le navigateur
//   ne garde que l'identifiant PHPSESSID dans un cookie. Un cookie est stocké CÔTÉ CLIENT
//   (dans le navigateur), donc modifiable par l'utilisateur : on n'y met rien de sensible.
// - setcookie() et header() envoient des EN-TÊTES HTTP, qui doivent précéder le corps de la
//   réponse. Dès qu'un affichage (même un espace ou une ligne vide avant <?php) est envoyé,
//   les en-têtes partent et on obtient « Cannot modify header information - headers already sent ».
require 'includes/pied_inc.php';
