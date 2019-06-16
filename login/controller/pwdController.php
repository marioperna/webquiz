<?php
         	
require("../../connessione.php");
$chiavePrivata="ß@h/9#02'+a!(DkÄ.";

//la  variabile st contiene lo stato della chiamata 

$st = $_POST["stato"];
//$st = "controlloSblocco";$ct =  "9pjbTfjcQxtUlf";

switch ($st) {
    case "controlloPwd":
            $pwd =$_POST["password"];
			$pwd = str_replace("'", "", $pwd);
        	$cPwd = "SELECT wu.idUtente, wu.cognome,wu.nome,wu.testAssegnato,wc.titolo,wc.id,wu.stato FROM _webquizUtenti wu, _webquizCat wc
  		     		 WHERE wu.pwd = '".md5($pwd)."' AND wu.testAssegnato = wc.id AND wu.stato ='sbloccato' 
            		";
  			$qPwd = mysql_query($cPwd);
    		if(mysql_num_rows($qPwd)>=1)
    		{
    			while($row = mysql_fetch_array($qPwd))
      			{
                  $dati["utente"] = array($row["idUtente"], $row["cognome"], $row["nome"]);
                  $dati["test"] = array($row["titolo"]);
                  $dati["statoAccount"]= array($row["stato"]);
      			}
			}
        break;
        /*
    case "sospTmb":
        	$bloccaTimbratore = "UPDATE ci_timbratori 
    					 		 SET stato = 'bloccato'
                         		 WHERE codiceTimbratore = '$ct'
                        		";
  			$qBloccaTimbratore = mysql_query($bloccaTimbratore);
            if(mysql_affected_rows($qBloccaTimbratore)>=0)
              {
                      $datiTimbratore["stato"] = "bloccato";
                  //$datiTimbratore["response"] = true;
              }  
        break;   
        
        */
}
print_r(json_encode($dati));
mysql_close(); //Make sure to close out the database connection
?>

