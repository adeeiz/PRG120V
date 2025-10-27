
<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8">
<title>Registrer klasse</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="container">
<h1>Registrer klasse</h1>
<form method="post">
  <label for="klassekode">Klassekode (maks 5 tegn)</label>
  <input id="klassekode" name="klassekode" maxlength="5" required>

  <label for="klassenavn">Klassenavn</label>
  <input id="klassenavn" name="klassenavn" maxlength="50" required>

  <label for="studiumkode">Studiumkode</label>
  <input id="studiumkode" name="studiumkode" maxlength="50" required>

  <button type="submit">Lagre</button>
</form>
<p><a href="index.php">Tilbake</a></p>
</body>
</html>

<?php
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $klassekode = strtoupper(trim($_POST['klassekode'] ?? ''));
    $klassenavn = trim($_POST['klassenavn'] ?? '');
    $studiumkode = trim($_POST['studiumkode'] ?? '');

    if ($klassekode === '' || $klassenavn === '' || $studiumkode === '') {
        echo 'Alle felter må fylles ut.';
    } elseif (strlen($klassekode) > 5) {
        echo 'Klassekode kan maks være 5 tegn.';
    } else {
        $stmt = $mysqli->prepare('INSERT INTO klasse (klassekode, klassenavn, studiumkode) VALUES (?, ?, ?)');
        if (!$stmt) {
            echo 'Klarte ikke forberede spørring.';
        } else {
            $stmt->bind_param('sss', $klassekode, $klassenavn, $studiumkode);
            if ($stmt->execute()) {
                echo 'Klasse lagret!';
            } else {
                echo 'Feil ved lagring: ' . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        }
    }
}
?>