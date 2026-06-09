<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';

$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM projets WHERE id = ?";
$requete = $pdo->prepare($sql);
$requete->execute([$id]);

$projet = $requete->fetch();

if (!$projet) {
    die("Projet introuvable.");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titre = trim($_POST['titre']);
    $description = trim($_POST['description']);
    $technologies = trim($_POST['technologies']);
    $lien = trim($_POST['lien']);

    $sql = "UPDATE projets
SET titre = ?,
description = ?,
technologies = ?,
lien = ?
WHERE id = ?";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        $titre,
        $description,
        $technologies,
        $lien,
        $id
    ]);
    #pour recharger les données depuis la base 
    $sql = "SELECT * FROM projets WHERE id = ?";
    $requete = $pdo->prepare($sql);
    $requete->execute([$id]);
    $projet = $requete->fetch();

    $message = "Projet modifié avec succès.";
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un projet</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>

    <h1>Modifier un projet</h1>
    <?php if (!empty($message)) : ?>
        <p style="color:green">
            <?= $message ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <label>Titre</label><br>
        <input type="text" name="titre"
            value="<?= htmlspecialchars($projet['titre']) ?>">
        <br><br>

        <label>Description</label><br>
        <textarea name="description"><?= htmlspecialchars($projet['description']) ?></textarea>
        <br><br>

        <label>Technologies</label><br>
        <input type="text" name="technologies"
            value="<?= htmlspecialchars($projet['technologies']) ?>">
        <br><br>

        <label>Lien</label><br>
        <input type="text" name="lien"
            value="<?= htmlspecialchars($projet['lien']) ?>">
        <br><br>

        <button type="submit">Modifier</button>

    </form>

</body>

</html>