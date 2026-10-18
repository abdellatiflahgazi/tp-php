# TP 3 PHP - Suivi des notes des apprenants

Auteur : Abdellatif Lahgazi

## Lancer
```
cd tp_php
php -S localhost:8000
```
Puis ouvrir http://localhost:8000/exo1_bases.php (ou n'importe quelle page du menu).

## Notes
- `mention()` est dans `config.php` (et non dans `exo2_flux.php`) pour être réutilisée par
  `exo3_tableaux.php`, `liste.php`, etc.
- Les réponses aux questions du TP sont en commentaires dans les fichiers concernés.
- `data/notes.csv` et `data/notes.json` sont créés par les scripts : saisissez 4 apprenants
  via `saisie.html`, puis ouvrez `liste.php` et `export.php`.
- Testé avec PHP 8.3.

## Déposer sur GitHub
```
git init
git add .
git commit -m "TP PHP - Suivi des notes"
git branch -M main
git remote add origin <URL_DU_DEPOT>
git push -u origin main
```
