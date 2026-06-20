<?php require_once '../menu.php'; ?>
<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';

$sql = "SELECT * FROM messages_contact
        ORDER BY date_envoi DESC";

$requete = $pdo->query($sql);
$messages = $requete->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Messages de contact</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>

    <h1>Messages de contact</h1>

    <table border="1">

        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Date</th>
            <th>État</th>
            <th>Voir</th>
        </tr>

        <?php foreach ($messages as $message) : ?>

            <tr>
                <td><?= htmlspecialchars($message['nom']) ?></td>
                <td><?= htmlspecialchars($message['email']) ?></td>
                <td><?= htmlspecialchars($message['date_envoi']) ?></td>

                <td>
                    <?= $message['lu'] ? 'Lu' : 'Non lu' ?>
                </td>

                <td>
                    <a href="voir.php?id=<?= $message['id'] ?>">
                        Voir
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>