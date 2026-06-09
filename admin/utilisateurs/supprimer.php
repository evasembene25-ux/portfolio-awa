<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../connexion.php');
    exit;
}

require_once '../../config/connexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: liste.php');
    exit;
}

$id = $_POST['id'] ?? 0;

/* Empêcher la suppression de son propre compte */
if ($id == $_SESSION['admin_id']) {
    die("Vous ne pouvez pas supprimer votre propre compte.");
}

/* Vérifier que l'administrateur existe */
$sql = "SELECT * FROM administrateurs WHERE id = ?";
$requete = $pdo->prepare($sql);
$requete->execute([$id]);

$admin = $requete->fetch();

if (!$admin) {
    die("Administrateur introuvable.");
}

/* Suppression */
$sql = "DELETE FROM administrateurs WHERE id = ?";
$requete = $pdo->prepare($sql);
$requete->execute([$id]);

header('Location: liste.php');
exit;
