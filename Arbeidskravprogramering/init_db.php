<?php
require_once __DIR__ . '/db.php';

$sqls = [
    // Lag tabell klasse
    "CREATE TABLE IF NOT EXISTS klasse (
        klassekode CHAR(5) NOT NULL,
        klassenavn VARCHAR(50) NOT NULL,
        studiumkode VARCHAR(50) NOT NULL,
        PRIMARY KEY (klassekode)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",
    // Lag tabell student
    "CREATE TABLE IF NOT EXISTS student (
        brukernavn CHAR(7) NOT NULL,
        fornavn VARCHAR(50) NOT NULL,
        etternavn VARCHAR(50) NOT NULL,
        klassekode CHAR(5) NOT NULL,
        PRIMARY KEY (brukernavn),
        CONSTRAINT fk_klasse FOREIGN KEY (klassekode) REFERENCES klasse (klassekode)
            ON UPDATE RESTRICT
            ON DELETE RESTRICT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
];

$ok = true;
foreach ($sqls as $stmt) {
    if (!$mysqli->query($stmt)) {
        $ok = false;
        $err = $mysqli->error;
        break;
    }
}
?>
<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8">
<title>Init DB</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="container">
<h1>Databaseinitialisering</h1>
<?php if ($ok): ?>
    <div class="notice">Tabellene <strong>klasse</strong> og <strong>student</strong> er klare. Du kan gå tilbake til <a href="index.php">forsiden</a>.</div>
<?php else: ?>
    <div class="notice" style="border-color:#e06666;color:#f8b4b4">Feil ved oppretting: <?= htmlspecialchars($err) ?></div>
<?php endif; ?>
</body>
</html>
