<?php  /* slett-klasse */
/*
/*  Programmet lager et skjema for å velge et klasse som skal slettes  
/*  Programmet sletter det valgte poststedet
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettPoststedSkjema" name="slettPoststedSkjema" onSubmit="return bekreft()">
  brukernavn<input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  <input type="submit" value="Slett student" name="slettPoststedKnapp" id="slettPoststedKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettPoststedKnapp"]))
    {	
      $brukernavn=$_POST ["brukernavn"];
	  
	  if (!$brukernavn)
        {
          print ("brukernavn m&aring; fylles ut");
        }
      else
        {
          include("db.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if($antallRader==0)  /* poststedet er ikke registrert */
            {
              print ("Studenten finnes ikke");
            }
          else
            {	  
              $sqlSetning="DELETE FROM student WHERE brukernavn='$brukernavn';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
                /* SQL-setning sendt til database-serveren */
		
              print ("F&oslash;lgende student er n&aring; slettet: $brukernavn  <br />");
            }
        }
    }
?> 