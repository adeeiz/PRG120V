<?php
require_once __DIR__ . '/db.php';

$feedback = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $klassekode = $_POST['klassekode'] ?? '';
    if ($klassekode === '') {
        $feedback = 'Velg en klasse å slette.';
    } else {
        $stmt = $mysqli->prepare('DELETE FROM klasse WHERE klassekode = ?');
        $stmt->bind_param('s', $klassekode);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $feedback = 'Klasse slettet.';
            } else {
                $feedback = 'Fant ikke valgt klasse, ingen endring.';
            }
        } else {
            $feedback = 'Feil ved sletting (sjekk om klassen brukes av studenter): ' . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    }
}

$klasser = $mysqli->query('SELECT klassekode, klassenavn FROM klasse ORDER BY klassekode');
?>
<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8">
<title>Slett klasse</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="container">
<h1>Slett klasse</h1>
<?php if ($feedback): ?><div class="notice"><?= htmlspecialchars($feedback) ?></div><?php endif; ?>
<form method="post" onsubmit="return confirm('Er du sikker på at du vil slette valgt klasse?')">
  <label for="klassekode">Velg klasse</label>
  <select id="klassekode" name="klassekode" required>
    <option value="">— Velg —</option>
    <?php if ($klasser): while ($row = $klasser->fetch_assoc()): ?>
      <option value="<?= htmlspecialchars($row['klassekode']) ?>">
        <?= htmlspecialchars($row['klassekode']) ?> – <?= htmlspecialchars($row['klassenavn']) ?>
      </option>
    <?php endwhile; endif; ?>
  </select>
  <button type="submit" class="danger">Slett</button>
</form>
<p><a href="index.php">Tilbake</a></p>
</body>
</html>
