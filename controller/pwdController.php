<?php
         	
require("../connessione.php");
$chiavePrivata="ß@h/9#02'+a!(DkÄ.";

//la  variabile st contiene lo stato della chiamata 

$st = $_POST["stato"];
//$st = "controlloSblocco";$ct =  "9pjbTfjcQxtUlf";

switch ($st) {
    case "controlloPwd":
            $pwd =$_POST["password"];
			$pwd = str_replace("'", "", $pwd);
        	$cPwd = "SELECT wu.idUtente, wu.cognome,wu.nome,wu.testAssegnato,wc.titolo,wc.durataTest,wc.id,wu.stato 
            FROM _webquizUtenti wu, _webquizCat wc
  		     		 WHERE wu.pwd = '".md5($pwd)."' AND wu.testAssegnato = wc.id AND wu.stato ='sbloccato' 
            		";
  			$qPwd = mysql_query($cPwd);
    		if(mysql_num_rows($qPwd)>=1)
    		{
    			while($row = mysql_fetch_array($qPwd))
      			{
                  $dati["utente"] = array($row["idUtente"], $row["testAssegnato"], $row["cognome"], $row["nome"]);
                  $dati["test"] = array($row["titolo"],$row["durataTest"] );
                  $dati["statoAccount"]= array($row["stato"]);
      			}
			}
            else
            {
            	$dati["statoAccount"]= array("bloccato");
            }
        break;
       
    case "sospTest":
    		$idUtente = $_POST["id_utente"];
        	$bloccaUtente = "UPDATE _webquizUtenti
    					 		 SET stato = 'bloccato'
                         		 WHERE idUtente = '$idUtente'
                        		";
  			$qBloccaUtente = mysql_query($bloccaUtente);
            if(mysql_affected_rows($qBloccaUtente)>=0)
              {
                      $dati["statoAccount"] = "bloccato";
              }  
        break;
            case "provaTerminata":
    		$idUtente = $_POST["id_utente"];
        	$terminaProva = "UPDATE _webquizUtenti
    					 		 SET stato = 'provaTerminata'
                         		 WHERE idUtente = '$idUtente'
                        		";
  			$qTerminaProva = mysql_query($terminaProva);
            if(mysql_affected_rows($qTerminaProva)>=0)
              {
                      $dati["statoAccount"] = "provaTerminata";
              }  
        break;
}
print_r(json_encode($dati));
mysql_close(); //Make sure to close out the database connection
?>

