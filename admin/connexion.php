<?php require_once 'menu.php'; ?>
<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}
require_once '../config/connexion.php';
require_once '../fonctions.php';

$erreur = '';
$csrf = genererCSRF();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifierCSRF($_POST['csrf'] ?? '')) {
        die("Jeton CSRF invalide");
    }

    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT * FROM administrateurs WHERE email = ?";
    $requete = $pdo->prepare($sql);
    $requete->execute([$email]);

    $admin = $requete->fetch();

    if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {

        session_regenerate_id(true);

        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_prenom'] = $admin['prenom'];

        header('Location: dashboard.php');
        exit;
    } else {

        $erreur = "Email ou mot de passe incorrect.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion administrateur</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <h2>Connexion administrateur</h2>

    <?php if (!empty($erreur)) : ?>
        <p style="color:red"><?= $erreur ?></p>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <input type="hidden" name="csrf" value="<?= $csrf ?>">

        <label>Email :</label><br>
        <input type="email"
            name="email"
            autocomplete="off"
            required><br><br>

        <label>Mot de passe :</label><br>
        <input type="password"
            name="mot_de_passe"
            autocomplete="new-password"
            required><br><br>

        <button type="submit">Se connecter</button>

    </form>

</body>

</html>