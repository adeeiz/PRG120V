<?php  /* slett-klasse */
/*
/*  Programmet lager et skjema for å velge et klasse som skal slettes  
/*  Programmet sletter det valgte poststedet
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettPoststedSkjema" name="slettPoststedSkjema" onSubmit="return bekreft()">
  Klassekode<input type="text" id="klassekode" name="klassekode" required /> <br/>
  <input type="submit" value="Slett klasse" name="slettPoststedKnapp" id="slettPoststedKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettPoststedKnapp"]))
    {	
      $klassekode=$_POST ["klassekode"];
	  
	  if (!$klassekode)
        {
          print ("klassekode m&aring; fylles ut");
        }
      else
        {
          include("db.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlValidering="SELECT * FROM student WHERE klassekode='$klassekode';";
          $sqlResultat1=mysqli_query($db,$sqlValidering) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat1); 

          if ($antallRader>0)  /* poststedet er ikke registrert */
            {
              print ("Kan ikke slette klasse som en student er registrert i");
              exit;
            }

          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          elseif($antallRader==0)  /* poststedet er ikke registrert */
            {
              print ("Klassen finnes ikke");
            }
          else
            {	  
              $sqlSetning="DELETE FROM klasse WHERE klassekode='$klassekode';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
                /* SQL-setning sendt til database-serveren */
		
              print ("F&oslash;lgende klasse er n&aring; slettet: $klassekode  <br />");
            }
        }
    }
?> 