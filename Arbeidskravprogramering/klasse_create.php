
<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8">
<title>Registrer klasse</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="container">
<h1>Registrer klasse</h1>
<form method="post" action="">
  <label for="klassekode">Klassekode (maks 5 tegn)</label>
  <input id="klassekode" name="klassekode" maxlength="5" required>

  <label for="klassenavn">Klassenavn</label>
  <input id="klassenavn" name="klassenavn" maxlength="50" required>

  <label for="studiumkode">Studiumkode</label>
  <input id="studiumkode" name="studiumkode" maxlength="50" required>

  <button type="submit">Lagre</button>
</form>
</body>
</html>



<?php 
  if (isset($_POST ["submit"]))
    {
      $klassekode=$_POST ["klassekode"];
      $klassenavn=$_POST ["klassenavn"];
      $studiumkode=$_POST ["studiumkode"];
    

      if (!$klassekode || !$klassenavn || !$studiumkode )
        {
          print ("B&aring;de klassekode, klassenavn og studiumkode m&aring; fylles ut");
        }
      else
        {
          include("db.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* klassenavnet er registrert fra før */
            {
              print ("klassen er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO klasse VALUES('$klassekode','$klassenavn', '$studiumkode');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende klassenavn er n&aring; registrert: $klassekode $klassenavn $studiumkode "); 
            }
        }
    }
?> 