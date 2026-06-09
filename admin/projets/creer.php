<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';
require_once '../../fonctions.php';

$erreurs = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titre = nettoyer($_POST['titre'] ?? '');
    $description = nettoyer($_POST['description'] ?? '');
    $technologies = nettoyer($_POST['technologies'] ?? '');
    $lien = nettoyer($_POST['lien'] ?? '');

    if (!champ_requis($titre)) {
        $erreurs[] = "Le titre est obligatoire.";
    }

    if (!champ_requis($description)) {
        $erreurs[] = "La description est obligatoire.";
    }

    if (!champ_requis($technologies)) {
        $erreurs[] = "Les technologies sont obligatoires.";
    }

    $nomImage = null;

    if (!empty($_FILES['image']['name'])) {

        $extensionsAutorisees = [
            'jpg',
            'jpeg',
            'png',
            'webp',
            'gif'
        ];

        $extension = strtolower(
            pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)
        );

        if (!in_array($extension, $extensionsAutorisees)) {

            $erreurs[] =
                "Format d'image non autorisé.";
        } else {

            $nomImage =
                uniqid() . '.' . $extension;

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                '../../images/projets/' . $nomImage
            );
        }
    }

    if (empty($erreurs)) {

        $sql = "INSERT INTO projets
        (titre, description, technologies, image, lien)
        VALUES (?, ?, ?, ?, ?)";

        $requete = $pdo->prepare($sql);

        $requete->execute([
            $titre,
            $description,
            $technologies,
            $nomImage,
            $lien
        ]);

        $success = "Projet ajouté avec succès.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Créer un projet</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>

    <h1>Créer un projet</h1>

    <p>
        <a href="liste.php">Retour à la liste</a>
    </p>

    <?php foreach ($erreurs as $erreur) : ?>
        <p style="color:red">
            <?= $erreur ?>
        </p>
    <?php endforeach; ?>

    <?php if (!empty($success)) : ?>
        <p style="color:green">
            <?= $success ?>
        </p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <p>
            <label>Titre</label><br>
            <input type="text" name="titre">
        </p>

        <p>
            <label>Description</label><br>
            <textarea name="description"></textarea>
        </p>

        <p>
            <label>Technologies</label><br>
            <input type="text" name="technologies">
        </p>

        <p>
            <label>Lien</label><br>
            <input type="text" name="lien">
        </p>

        <p>
            <label>Image</label><br>
            <input type="file" name="image">
        </p>

        <button type="submit">
            Ajouter
        </button>

    </form>

</body>

</html>