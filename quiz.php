<?php
 header('Content-Type: application/json; charset=utf-8');

 		require ("connessione.php");
                //aggiunto da me mysql query

                $dati = array();

 		$IDomanda = $_POST["id_domanda"];
        $IDcategoria = $_POST["id_categoria"];
        $IDutente = $_POST["id_utente"];
		$sql="
        	SELECT * FROM _webquiz WHERE id='$IDomanda' AND fk_categoria = '$IDcategoria'
        ";
		$sql2="
        	SELECT * FROM _webquizRisp WHERE fk_domanda='$IDomanda' AND fk_categoria = '$IDcategoria' AND fk_utente='$IDutente'
        ";
        $sql3="
        	SELECT * FROM _webquizUtenti WHERE idUtente='$IDutente'
        ";

        //effettuo le query
		$ris = mysql_query($sql) or die("errore esecuzione query1");
        $ris2 = mysql_query($sql2) or die("errore esecuzione query2");
        $ris3 = mysql_query($sql3) or die("errore esecuzione query3");

        if(mysql_num_rows($ris2)>=1)
        {
       		 while($row2 = mysql_fetch_array($ris2))
        	{
          		$dati['rispDate']=array($row2["risposta"],$row2["commento"]);
        	}
        }
        else
        {
        	$dati['rispDate']=array("");
        }



         if(mysql_num_rows($ris3)>=1)
        {
       		 while($row3 = mysql_fetch_array($ris3))
        	{
          		$dati['infoAccount']=array($row3["idUtente"],$row3["cognome"],$row3["nome"],$row3["stato"]);
        	}
        }
        else
        {
        	$dati['infoAccount']=array("");
        }


        while($row = mysql_fetch_array($ris))
        {
        	//$dati['risposte'] = array($row["id"]."_".$row["r1"],$row["id"]."_".$row["r2"], $row["id"]."_".$row["r3"],$row["id"]."_".$row["r4"]);

			$dati['risposte'] = array($row["r1"],$row["r2"], $row["r3"],$row["r4"]);
			$dati['infoDom'] = array($row["id"],$row["fk_categoria"],$row["tipoDom"]);
        }

        //inverte le domande
        shuffle($dati['risposte']);
        print_r(json_encode($dati));

      ?>
