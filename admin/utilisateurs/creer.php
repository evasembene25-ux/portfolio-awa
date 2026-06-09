<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';

$erreurs = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    if (empty($prenom)) {
        $erreurs[] = "Le prénom est obligatoire.";
    }

    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }

    if (empty($email)) {
        $erreurs[] = "L'email est obligatoire.";
    }

    if (empty($mot_de_passe)) {
        $erreurs[] = "Le mot de passe est obligatoire.";
    }

    if (empty($erreurs)) {

        $hash = password_hash(
            $mot_de_passe,
            PASSWORD_DEFAULT
        );

        $sql = "INSERT INTO administrateurs
                (prenom, nom, email, mot_de_passe)
                VALUES (?, ?, ?, ?)";

        $requete = $pdo->prepare($sql);

        $requete->execute([
            $prenom,
            $nom,
            $email,
            $hash
        ]);

        $success = "Administrateur ajouté avec succès.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Créer un administrateur</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>

    <h1>Créer un administrateur</h1>

    <p>
        <a href="liste.php">Retour à la liste</a>
    </p>

    <?php foreach ($erreurs as $erreur) : ?>
        <p style="color:red">
            <?= htmlspecialchars($erreur) ?>
        </p>
    <?php endforeach; ?>

    <?php if (!empty($success)) : ?>
        <p style="color:green">
            <?= htmlspecialchars($success) ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <label>Prénom</label><br>
        <input type="text" name="prenom"><br><br>

        <label>Nom</label><br>
        <input type="text" name="nom"><br><br>

        <label>Email</label><br>
        <input type="email" name="email"><br><br>

        <label>Mot de passe</label><br>
        <input type="password" name="mot_de_passe"><br><br>

        <button type="submit">
            Ajouter
        </button>

    </form>

</body>

</html>