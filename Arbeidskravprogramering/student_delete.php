<?php  /* slett-student */
/*
/*  Programmet lager et skjema for å velge et kstudent som skal slettes  
/*  Programmet sletter det valgte poststedet
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett student</h3>

<form method="post" action="" id="slettstudentSkjema" name="slettstudentSkjema" onSubmit="return bekreft()">
 <select name="student" id="student">
    <option value="">velg student</option>
    <?php include("dynamiske-funksjoner.php"); listeboksStudent(); ?> 
  </select>  <br/> 
  <input type="submit" value="Slett student" name="slettstudentKnapp" id="slettstudentKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettstudentKnapp"]))
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