<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';

$id = $_GET['id'] ?? 0;

$sql = "UPDATE messages_contact
        SET lu = 1
        WHERE id = ?";

$requete = $pdo->prepare($sql);
$requete->execute([$id]);

$sql = "SELECT * FROM messages_contact
        WHERE id = ?";

$requete = $pdo->prepare($sql);
$requete->execute([$id]);

$message = $requete->fetch();

if (!$message) {
    die("Message introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Voir message</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>

    <h1>Détail du message</h1>

    <p><strong>Nom :</strong>
        <?= htmlspecialchars($message['nom']) ?></p>

    <p><strong>Email :</strong>
        <?= htmlspecialchars($message['email']) ?></p>

    <p><strong>Date :</strong>
        <?= htmlspecialchars($message['date_envoi']) ?></p>

    <p><strong>Message :</strong></p>

    <p>
        <?= nl2br(htmlspecialchars($message['message'])) ?>
    </p>

    <a href="liste.php">Retour</a>

</body>

</html>