<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';

$sql = "SELECT *
        FROM demandes_projet
        ORDER BY date_demande DESC";

$requete = $pdo->query($sql);
$demandes = $requete->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Demandes de projet</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>

    <h1>Demandes de projet</h1>

    <table border="1">

        <tr>
            <th>Nom</th>
            <th>Type de projet</th>
            <th>Date</th>
            <th>État</th>
            <th>Voir</th>
        </tr>

        <?php foreach ($demandes as $demande) : ?>

            <tr>

                <td><?= htmlspecialchars($demande['nom']) ?></td>

                <td><?= htmlspecialchars($demande['type_projet']) ?></td>

                <td><?= htmlspecialchars($demande['date_demande']) ?></td>

                <td>
                    <?= $demande['lu'] ? 'Lu' : 'Non lu' ?>
                </td>

                <td>
                    <a href="voir.php?id=<?= $demande['id'] ?>">
                        Voir
                    </a>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>