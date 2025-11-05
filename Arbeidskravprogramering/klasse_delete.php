<?php
  if (isset($_POST ["velgklasseKnapp"]))  // Endre til riktig knapp-navn
    {	
      $klassekode=$_POST ["klasse"];  // Endre til riktig feltnavn
	  
	  if (!$klassekode)
        {
          print ("klassekode m&aring; fylles ut");
        }
      else
        {
          include("db.php");

          $sqlValidering="SELECT * FROM student WHERE klassekode='$klassekode';";
          $sqlResultat1=mysqli_query($db,$sqlValidering) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat1); 

          if ($antallRader>0)
            {
              print ("Kan ikke slette klasse som en student er registrert i");
              exit;
            }

          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if($antallRader==0)
            {
              print ("Klassen finnes ikke");
            }
          else
            {	  
              $sqlSetning="DELETE FROM klasse WHERE klassekode='$klassekode';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
		
              print ("F&oslash;lgende klasse er n&aring; slettet: $klassekode  <br />");
            }
        }
    }
?>