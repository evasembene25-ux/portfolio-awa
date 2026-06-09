<?php
require_once '../config/connexion.php';
require_once '../fonctions.php';

enregistrerVisite($pdo, 'Sécurité Avancée');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sécurité avancée</title>

    <link rel="stylesheet" href="../css/projets.css">
</head>

<body>

    <section class="project-banner">

        <h1>Sécurité avancée</h1>



    </section>

    <section class="project-details">

        <img src="../images/securiteavance.36.jpeg" alt="Projet sécurité avancée">

        <h2>Présentation du projet</h2>

        <p>
            Projet de cybersécurité basé sur l’utilisation de Nmap
            afin d’identifier les machines actives, les ports ouverts
            et les services vulnérables présents sur un réseau local.
        </p>

        <h2>Objectifs</h2>

        <ul>
            <li>Analyser un réseau local</li>
            <li>Identifier les vulnérabilités</li>
            <li>Scanner les ports ouverts</li>
            <li>Renforcer la sécurité réseau</li>
        </ul>

        <h2>Technologies utilisées</h2>

        <div class="tags">
            <span>Nmap</span>
            <span>Linux</span>
            <span>Cybersécurité</span>
        </div>

        <h2>Fonctionnalités</h2>

        <ul>
            <li>Scan réseau</li>
            <li>Détection des machines</li>
            <li>Analyse des ports</li>
            <li>Identification des services</li>
        </ul>



        <div class="project-buttons">

            <a href="../index.php" class="btn">
                Retour à l'accueil
            </a>

        </div>

    </section>

</body>

</html>