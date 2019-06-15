 <?php
 
 		require ("connessione.php");
 		$IDomanda = $_POST["id_domanda"];

                    $sql = " SELECT
w.id, w.r1,w.r2,w.r3,w.r4,w.tipoDom, r.fk_domanda,r.risposta, r.commento
FROM _webquiz w
    LEFT OUTER JOIN _webquizRisp r
        ON w.id = r.fk_domanda WHERE w.id = '$IDomanda'";
        
           
        
        
        
        
    	$ris = mysql_query($sql) or die("errore esecuzione query");
        $dati = array();

        while($row = mysql_fetch_array($ris))
        {
        	//$dati['risposte'] = array($row["id"]."_".$row["r1"],$row["id"]."_".$row["r2"], $row["id"]."_".$row["r3"],$row["id"]."_".$row["r4"]);
           	$dati['rispDate'] = array($row["fk_domanda"], $row["risposta"]);
			$dati['risposte'] = array($row["r1"],$row["r2"], $row["r3"],$row["r4"]);
			$dati['infoDom'] = array($row["id"],$row["commento"],$row["tipoDom"]);

           /*$risp[] =  $row["r1"];
           $risp[] =  $row["r2"];
           $risp[] =  $row["r3"];
           $risp[] =  $row["r4"];*/
            
        }
        //inverte le domande
        shuffle($dati['risposte']);
        print_r(json_encode($dati));
      ?>
