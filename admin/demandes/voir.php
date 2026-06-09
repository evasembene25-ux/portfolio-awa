<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';

$id = $_GET['id'] ?? 0;

/* Marquer comme lu */

$sql = "UPDATE demandes_projet
        SET lu = 1
        WHERE id = ?";

$requete = $pdo->prepare($sql);
$requete->execute([$id]);

/* Récupérer la demande */

$sql = "SELECT *
        FROM demandes_projet
        WHERE id = ?";

$requete = $pdo->prepare($sql);
$requete->execute([$id]);

$demande = $requete->fetch();

if (!$demande) {
    die("Demande introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détail de la demande</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>

    <h1>Détail de la demande</h1>

    <p>
        <strong>Nom :</strong>
        <?= htmlspecialchars($demande['nom']) ?>
    </p>

    <p>
        <strong>Email :</strong>
        <?= htmlspecialchars($demande['email']) ?>
    </p>

    <p>
        <strong>Type de projet :</strong>
        <?= htmlspecialchars($demande['type_projet']) ?>
    </p>

    <p>
        <strong>Description :</strong>
    </p>

    <p>
        <?= nl2br(htmlspecialchars($demande['description'])) ?>
    </p>

    <p>
        <strong>Budget :</strong>
        <?= htmlspecialchars($demande['budget']) ?>
    </p>

    <p>
        <strong>Date :</strong>
        <?= htmlspecialchars($demande['date_demande']) ?>
    </p>

    <a href="liste.php">Retour</a>

</body>

</html>