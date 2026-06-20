<?php require_once '../menu.php'; ?>
<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';

$sql = "SELECT * FROM projets ORDER BY date_creation DESC";
$requete = $pdo->query($sql);
$projets = $requete->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des projets</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>

    <h1>Gestion des projets</h1>

    <p>
        <a href="creer.php">Ajouter un projet</a>
    </p>

    <table border="1">

        <tr>
            <th>Titre</th>
            <th>Date</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>

        <?php foreach ($projets as $projet) : ?>

            <tr>

                <td><?= htmlspecialchars($projet['titre']) ?></td>

                <td><?= htmlspecialchars($projet['date_creation']) ?></td>

                <td>
                    <a href="modifier.php?id=<?= $projet['id'] ?>">
                        Modifier
                    </a>
                </td>


                <td>
                    <form method="POST" action="supprimer.php">
                        <input type="hidden" name="id" value="<?= $projet['id'] ?>">
                        <button type="submit">
                            Supprimer
                        </button>
                    </form>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>