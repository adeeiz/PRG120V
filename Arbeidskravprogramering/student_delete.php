<?php  /* slett-student */ ?>

<script src="funksjoner.js"> </script>

<h3>Slett student</h3>

<form method="post" action="" id="slettstudentSkjema" name="slettstudentSkjema" onSubmit="return bekreft()">
 <select name="brukernavn" id="brukernavn">
    <option value="">velg student</option>
    <?php 
    include("dynamiske-funksjoner.php"); 
    if (function_exists('listeboksStudent')) {
        listeboksStudent();
    } else {
        echo "<!-- Funksjonen listeboksStudent finnes ikke -->";
    }
    ?> 
  </select>  <br/> 
  <input type="submit" value="Slett student" name="slettstudentKnapp" id="slettstudentKnapp" /> 
</form>

<?php
if (isset($_POST["slettstudentKnapp"])) {	
    $brukernavn = $_POST["brukernavn"];
    
    if (empty($brukernavn)) {
        echo "<p style='color: red;'>Du må velge en student å slette</p>";
    } else {
        include("db.php");

        // Sjekk om studenten eksisterer
        $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn'";
        $sqlResultat = mysqli_query($db, $sqlSetning);
        
        if (!$sqlResultat) {
            die("Feil ved database-spørring: " . mysqli_error($db));
        }
        
        $antallRader = mysqli_num_rows($sqlResultat); 

        if ($antallRader == 0) {
            echo "<p style='color: red;'>Studenten finnes ikke</p>";
        } else {
            // Hent studentinfo for bekreftelsesmelding
            $rad = mysqli_fetch_assoc($sqlResultat);
            $studentNavn = $rad['fornavn'] . " " . $rad['etternavn'];
            
            // Slett studenten
            $sqlSlett = "DELETE FROM student WHERE brukernavn='$brukernavn'";
            $resultatSlett = mysqli_query($db, $sqlSlett);
            
            if ($resultatSlett) {
                echo "<p style='color: green;'>Studenten <strong>$studentNavn</strong> ($brukernavn) er nå slettet</p>";
            } else {
                echo "<p style='color: red;'>Kunne ikke slette studenten: " . mysqli_error($db) . "</p>";
            }
        }
    }
}
?>