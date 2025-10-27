<?php
require_once __DIR__ . '/db.php';
$result = $mysqli->query('SELECT klassekode, klassenavn, studiumkode FROM klasse ORDER BY klassekode');
?>
<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8">
<title>Vis klasser</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="container">
<h1>Alle klasser</h1>
<table class="table">
  <thead>
    <tr><th>Klassekode</th><th>Klassenavn</th><th>Studiumkode</th></tr>
  </thead>
  <tbody>
  <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['klassekode']) ?></td>
        <td><?= htmlspecialchars($row['klassenavn']) ?></td>
        <td><?= htmlspecialchars($row['studiumkode']) ?></td>
      </tr>
    <?php endwhile; ?>
  <?php else: ?>
    <tr><td colspan="3">Ingen klasser registrert.</td></tr>
  <?php endif; ?>
  </tbody>
</table>
<p><a href="index.php">Tilbake</a></p>
</body>
</html>
