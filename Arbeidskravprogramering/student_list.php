<?php
require_once __DIR__ . '/db.php';
$sql = 'SELECT s.brukernavn, s.fornavn, s.etternavn, s.klassekode, k.klassenavn
        FROM student s
        LEFT JOIN klasse k ON s.klassekode = k.klassekode
        ORDER BY s.brukernavn';
$result = $mysqli->query($sql);
?>
<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8">
<title>Vis studenter</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="container">
<h1>Alle studenter</h1>
<table class="table">
  <thead>
    <tr><th>Brukernavn</th><th>Fornavn</th><th>Etternavn</th><th>Klassekode</th><th>Klassenavn</th></tr>
  </thead>
  <tbody>
  <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['brukernavn']) ?></td>
        <td><?= htmlspecialchars($row['fornavn']) ?></td>
        <td><?= htmlspecialchars($row['etternavn']) ?></td>
        <td><?= htmlspecialchars($row['klassekode']) ?></td>
        <td><?= htmlspecialchars($row['klassenavn'] ?? '') ?></td>
      </tr>
    <?php endwhile; ?>
  <?php else: ?>
    <tr><td colspan="5">Ingen studenter registrert.</td></tr>
  <?php endif; ?>
  </tbody>
</table>
<p><a href="index.php">Tilbake</a></p>
</body>
</html>
