<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';
$sql = "SELECT * FROM administrateurs
ORDER BY date_creation DESC";

$requete = $pdo->query($sql);
$admins = $requete->fetchAll(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des administrateurs</title>

    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>

    <h1>Gestion des administrateurs</h1>
    <table border="1">

        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Date</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>

        <?php foreach ($admins as $admin) : ?>

            <tr>

                <td><?= htmlspecialchars($admin['prenom']) ?></td>
                <td><?= htmlspecialchars($admin['nom']) ?></td>
                <td><?= htmlspecialchars($admin['email']) ?></td>
                <td><?= htmlspecialchars($admin['date_creation']) ?></td>

                <td>
                    <a href="modifier.php?id=<?= $admin['id'] ?>">
                        Modifier
                    </a>
                </td>

                <td>
                    <form method="POST" action="supprimer.php">
                        <input type="hidden" name="id"
                            value="<?= $admin['id'] ?>">
                        <button type="submit">
                            Supprimer
                        </button>
                    </form>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>