<?php
require_once __DIR__ . '/db.php';

$feedback = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brukernavn = $_POST['brukernavn'] ?? '';
    if ($brukernavn === '') {
        $feedback = 'Velg en student å slette.';
    } else {
        $stmt = $mysqli->prepare('DELETE FROM student WHERE brukernavn = ?');
        $stmt->bind_param('s', $brukernavn);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $feedback = 'Student slettet.';
            } else {
                $feedback = 'Fant ikke valgt student, ingen endring.';
            }
        } else {
            $feedback = 'Feil ved sletting: ' . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    }
}

$studenter = $mysqli->query('SELECT brukernavn, fornavn, etternavn FROM student ORDER BY brukernavn');
?>
<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8">
<title>Slett student</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="container">
<h1>Slett student</h1>
<?php if ($feedback): ?><div class="notice"><?= htmlspecialchars($feedback) ?></div><?php endif; ?>
<form method="post" onsubmit="return confirm('Er du sikker på at du vil slette valgt student?')">
  <label for="brukernavn">Velg student</label>
  <select id="brukernavn" name="brukernavn" required>
    <option value="">— Velg —</option>
    <?php if ($studenter): while ($row = $studenter->fetch_assoc()): ?>
      <option value="<?= htmlspecialchars($row['brukernavn']) ?>">
        <?= htmlspecialchars($row['brukernavn']) ?> – <?= htmlspecialchars($row['fornavn'] . ' ' . $row['etternavn']) ?>
      </option>
    <?php endwhile; endif; ?>
  </select>
  <button type="submit" class="danger">Slett</button>
</form>
<p><a href="index.php">Tilbake</a></p>
</body>
</html>
