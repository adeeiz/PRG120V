<?php  /* slett-klasse */
/*
/*  Programmet lager et skjema for å velge et klasse som skal slettes  
/*  Programmet sletter det valgte klasse
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett klasse</h3>

<form method="post" action="" id="SlettklasseSkjema" name="SlettklasseSkjema" onSubmit="return bekreft()">
  klasse 
  <select name="klasse" id="klasse">
    <option value="">velg klasse</option>
    <?php include("dynamiske-funksjoner.php"); listeboksklasse(); ?> 
  </select>  <br/>
  <input type="submit" value="Slett klasse" id="velgklasseKnapp" name="velgklasseKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettklasseKnapp"]))
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

          if ($antallRader>0)  /* klasse er ikke registrert */
            {
              print ("Kan ikke slette klasse som en student er registrert i");
              exit;
            }

          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if($antallRader==0)  /* klasse er ikke registrert */
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