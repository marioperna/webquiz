 <?php

 	require("connessione.php");

        $IDomanda = $_POST["id_domanda"];
        $rispUtente =$_POST["prova"];



if(!empty($rispUtente))
{
            $sqlInserisciRisposta =
            "
    INSERT INTO _webquizRisp (fk_domanda,risposta)
    VALUES ('$IDomanda','$rispUtente')
	ON DUPLICATE KEY UPDATE risposta = '$rispUtente';

    ";

            $q = mysql_query($sqlInserisciRisposta) or die("errore esecuzione query".mysql_error());

            if($q)
            {
                $esito["stato"] = "eseguito";
            }
            else
            {
                $esito["stato"] = "non eseguito";
            }
            print_r(json_encode($esito));
}
else
{
        $sqlRimuoviRisposta =
        "
        	DELETE  FROM _webquizRisp
            WHERE fk_domanda = '$IDomanda'
        ";
        $q = mysql_query($sqlRimuoviRisposta) or die("errore esecuzione query");
        if($q)
        {
        	$esito["stato"] = "eseguito";
        }
        else
        {
        	$esito["stato"] = "non eseguito";
        }
        print_r(json_encode($esito));
}


 ?>
