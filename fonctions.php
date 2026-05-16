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
    return htmlspecialchars(trim($valeur));
}
