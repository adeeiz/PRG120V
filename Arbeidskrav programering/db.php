<?php
require_once __DIR__ . '/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_error) {
    die('Kunne ikke koble til databasen: ' . htmlspecialchars($mysqli->connect_error));
}

// Sett korrekt charset
if (!$mysqli->set_charset('utf8mb4')) {
    die('Kunne ikke sette charset: ' . htmlspecialchars($mysqli->error));
}
?>
