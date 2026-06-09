<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';

$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM administrateurs WHERE id = ?";
$requete = $pdo->prepare($sql);
$requete->execute([$id]);

$admin = $requete->fetch();

if (!$admin) {
    die("Administrateur introuvable.");
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $mot_de_passe = trim($_POST['mot_de_passe']);

    if (!empty($mot_de_passe)) {

        $hash = password_hash(
            $mot_de_passe,
            PASSWORD_DEFAULT
        );

        $sql = "UPDATE administrateurs
                SET prenom = ?,
                    nom = ?,
                    email = ?,
                    mot_de_passe = ?
                WHERE id = ?";

        $requete = $pdo->prepare($sql);

        $requete->execute([
            $prenom,
            $nom,
            $email,
            $hash,
            $id
        ]);
    } else {

        $sql = "UPDATE administrateurs
                SET prenom = ?,
                    nom = ?,
                    email = ?
                WHERE id = ?";

        $requete = $pdo->prepare($sql);

        $requete->execute([
            $prenom,
            $nom,
            $email,
            $id
        ]);
    }

    $sql = "SELECT * FROM administrateurs WHERE id = ?";
    $requete = $pdo->prepare($sql);
    $requete->execute([$id]);
    $admin = $requete->fetch();

    $message = "Administrateur modifié avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un administrateur</title>
    <link rel="stylesheet" href="../../css/admin.css">

</head>

<body>

    <h1>Modifier un administrateur</h1>

    <p>
        <a href="liste.php">Retour à la liste</a>
    </p>

    <?php if (!empty($message)) : ?>
        <p style="color:green">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <label>Prénom</label><br>
        <input
            type="text"
            name="prenom"
            value="<?= htmlspecialchars($admin['prenom']) ?>">
        <br><br>

        <label>Nom</label><br>
        <input
            type="text"
            name="nom"
            value="<?= htmlspecialchars($admin['nom']) ?>">
        <br><br>

        <label>Email</label><br>
        <input
            type="email"
            name="email"
            value="<?= htmlspecialchars($admin['email']) ?>">
        <br><br>

        <label>Nouveau mot de passe (laisser vide pour conserver l'ancien)</label><br>
        <input type="password" name="mot_de_passe">
        <br><br>

        <button type="submit">
            Modifier
        </button>

    </form>

</body>

</html>