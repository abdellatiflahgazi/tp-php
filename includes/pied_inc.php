<?php
/**
 * Auteur   : Abdellatif Lahgazi
 * Objectif : Pied de page (date du jour, jours restants avant la fin du semestre)
 * Date     : 18/10/2026
 */
$finSemestre = new DateTime('2027-01-31'); // date de fin de semestre choisie
$aujourdhui  = new DateTime('today');
$ecart       = $aujourdhui->diff($finSemestre);
?>
<footer>
    <p>Date du jour : <?= date('d/m/Y') ?></p>
    <p>
        <?php if ($ecart->invert): ?>
            Le semestre est terminé (fin le 31/01/2027).
        <?php else: ?>
            Il reste <?= $ecart->days ?> jour(s) avant la fin du semestre (31/01/2027).
        <?php endif; ?>
    </p>
</footer>
</body>
</html>
