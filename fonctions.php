<?php

/**
 * Vérifie qu'un champ est rempli.
 *
 * @param string $valeur
 * @return bool
 */
function champ_requis(string $valeur): bool
{
    return !empty(trim($valeur));
}
/**
 * Nettoie une donnée utilisateur.
 *
 * @param string $valeur
 * @return string
 */

function nettoyer(string $valeur): string
{
    return trim($valeur);
}
function enregistrerVisite($pdo, $page)
{

    $ip = $_SERVER['REMOTE_ADDR'];

    $sql = "INSERT INTO visites (adresse_ip, page)
            VALUES (?, ?)";

    $requete = $pdo->prepare($sql);
    $requete->execute([$ip, $page]);
}
function genererCSRF()
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf'];
}

function verifierCSRF($token)
{
    return isset($_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], $token);
}
