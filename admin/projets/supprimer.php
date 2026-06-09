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

$sql = "DELETE FROM projets WHERE id = ?";
$requete = $pdo->prepare($sql);
$requete->execute([$id]);

header('Location: liste.php');
exit;
