<?php
$page_courante = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Portfolio - Awa Cissé Soré SEMBENE</title>
    <link rel="stylesheet" href="<?= isset($page_courante) && $page_courante == 'index.php'
                                        ? 'css/style.css'
                                        : '../css/style.css' ?>">
</head>

<body>
    <header class="mobile-header">
        <div class="logo">ACSS<span>.</span></div>

        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="menu-icon">
            ☰
        </label>

        <nav class="menu">
            <a href="<?= $page_courante == 'index.php' ? 'index.php' : '../index.php' ?>">Accueil</a>
            <a href="<?= $page_courante == 'index.php' ? 'pages/projets.php' : 'projets.php' ?>">Projets</a>
            <a href="<?= $page_courante == 'index.php' ? 'pages/contact.php' : 'contact.php' ?>">Contact</a>
        </nav>
    </header>