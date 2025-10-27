<?php
require_once __DIR__ . '/db.php';

$feedback = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brukernavn = strtolower(trim($_POST['brukernavn'] ?? ''));
    $fornavn = trim($_POST['fornavn'] ?? '');
    $etternavn = trim($_POST['etternavn'] ?? '');
    $klassekode = trim($_POST['klassekode'] ?? '');

    if ($brukernavn === '' || $fornavn === '' || $etternavn === '' || $klassekode === '') {
        $feedback = 'Alle felter må fylles ut.';
    } elseif (strlen($brukernavn) > 7) {
        $feedback = 'Brukernavn kan maks være 7 tegn.';
    } else {
        $stmt = $mysqli->prepare('INSERT INTO student (brukernavn, fornavn, etternavn, klassekode) VALUES (?, ?, ?, ?)');
        if (!$stmt) {
            $feedback = 'Klarte ikke forberede spørring.';
        } else {
            $stmt->bind_param('ssss', $brukernavn, $fornavn, $etternavn, $klassekode);
            if ($stmt->execute()) {
                $feedback = 'Student lagret!';
            } else {
                $feedback = 'Feil ved lagring: ' . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        }
    }
}

$klasser = $mysqli->query('SELECT klassekode, klassenavn FROM klasse ORDER BY klassekode');
?>
<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8">
<title>Registrer student</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="container">
<h1>Registrer student</h1>
<?php if ($feedback): ?><div class="notice"><?= htmlspecialchars($feedback) ?></div><?php endif; ?>
<form method="post">
  <label for="brukernavn">Brukernavn (maks 7 tegn)</label>
  <input id="brukernavn" name="brukernavn" maxlength="7" required>

  <label for="fornavn">Fornavn</label>
  <input id="fornavn" name="fornavn" maxlength="50" required>

  <label for="etternavn">Etternavn</label>
  <input id="etternavn" name="etternavn" maxlength="50" required>

  <label for="klassekode">Klassekode</label>
  <select id="klassekode" name="klassekode" required>
    <option value="">— Velg —</option>
    <?php if ($klasser && $klasser->num_rows > 0): ?>
      <?php while ($row = $klasser->fetch_assoc()): ?>
        <option value="<?= htmlspecialchars($row['klassekode']) ?>">
          <?= htmlspecialchars($row['klassekode']) ?> – <?= htmlspecialchars($row['klassenavn']) ?>
        </option>
      <?php endwhile; ?>
    <?php else: ?>
      <!-- Ingen klasser -->
    <?php endif; ?>
  </select>

  <button type="submit">Lagre</button>
</form>
<p><a href="index.php">Tilbake</a></p>
</body>
</html>
