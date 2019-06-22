<?php
 
 		require ("connessione.php");
                //aggiunto da me mysql query
      
                $datiDom = array();
                $IDcategoria = $_POST["testAssegnato"];
                $IDutente =$_POST["id_utente"];
		$sql="
        	SELECT id, domanda, fk_categoria 
			FROM _webquiz,_webquizUtenti
			WHERE  fk_categoria='$IDcategoria' AND idUtente='$IDutente' ORDER BY RAND()			
        ";
		
        //effettuo le query
		$ris = mysql_query($sql) or die("errore esecuzione query1");
		while($row = mysql_fetch_array($ris))
        {
  			$datiDom[] = array($row["id"],$row["fk_categoria"],$row["domanda"]);
             
        }        
             print_r(json_encode($datiDom));

      ?>


      
      