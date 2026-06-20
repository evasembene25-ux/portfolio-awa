<?php require_once 'menu.php'; ?>
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: connexion.php');
    exit;
}
require_once '../config/connexion.php';
$total_projets = $pdo->query(
    "SELECT COUNT(*) FROM projets"
)->fetchColumn();
$total_messages = $pdo->query(
    "SELECT COUNT(*) FROM messages_contact WHERE lu = 0"
)->fetchColumn();
$visites = $pdo->query(
    "SELECT adresse_ip, page, date_visite
     FROM visites
     ORDER BY date_visite DESC
     LIMIT 5"
)->fetchAll();
$total_demandes = $pdo->query(
    "SELECT COUNT(*) FROM demandes_projet WHERE lu = 0"
)->fetchColumn();
$demandes = $pdo->query(
    "SELECT nom, type_projet, date_demande
     FROM demandes_projet
     ORDER BY date_demande DESC
     LIMIT 5"
)->fetchAll();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <h1>Bienvenue <?= htmlspecialchars($_SESSION['admin_prenom']) ?> !</h1>

    <h2>Statistiques</h2>

    <p>Total projets : <?= $total_projets ?></p>

    <p>Messages non lus : <?= $total_messages ?></p>

    <p>Demandes non lues : <?= $total_demandes ?></p>
    <h2>5 dernières visites</h2>

    <table border="1">

        <tr>
            <th>IP</th>
            <th>Page</th>
            <th>Date</th>
        </tr>

        <?php foreach ($visites as $visite) : ?>

            <tr>
                <td><?= htmlspecialchars($visite['adresse_ip']) ?></td>
                <td><?= htmlspecialchars($visite['page']) ?></td>
                <td><?= htmlspecialchars($visite['date_visite']) ?></td>
            </tr>

        <?php endforeach; ?>

    </table>
    <h2>5 dernières demandes</h2>

    <table border="1">

        <tr>
            <th>Nom</th>
            <th>Type de projet</th>
            <th>Date</th>
        </tr>

        <?php foreach ($demandes as $demande) : ?>

            <tr>
                <td><?= htmlspecialchars($demande['nom']) ?></td>
                <td><?= htmlspecialchars($demande['type_projet']) ?></td>
                <td><?= htmlspecialchars($demande['date_demande']) ?></td>
            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>