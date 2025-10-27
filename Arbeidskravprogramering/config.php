<?php
// Standard eksempel. Endre ved behov eller bruk miljøvariabler i Dokploy.
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'prg120v');
?>
