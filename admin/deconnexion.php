<?php require_once 'menu.php'; ?>
<?php

session_start();

session_unset();

session_destroy();

header('Location: connexion.php');
exit;
