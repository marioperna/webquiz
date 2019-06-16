<?php
require("connessione.php");
$IDomanda = $_POST["id_domanda"];
$rispUtente = $_POST["prova"];
$IDcategoria =$_POST["id_categoria"];
$IDutente = $_POST["id_utente"];
$c = $_POST["commento"];
$cmd = $_POST["cmd"];

switch ($cmd) {
    case "cancellaRisposta":
          $sqlRimuoviRisposta =
          "
          DELETE  FROM _webquizRisp
          WHERE fk_domanda = '$IDomanda' AND fk_categoria = '$IDcategoria' AND fk_utente = '$IDutente'
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
        break;
        case "ida":
    	  $sqlInserisciRisposta =
          "
          INSERT INTO _webquizRisp (fk_utente, fk_categoria, fk_domanda,dataRisposta,risposta, commento)
          VALUES ('$IDutente','$IDcategoria','$IDomanda',CURDATE(),'', '$c')
          ON DUPLICATE KEY UPDATE commento = '$c'

          ";

          $q = mysql_query($sqlInserisciRisposta) or die("errore esecuzione query".mysql_error());

          if($q)
          {$esito["stato"] = "eseguito";}
          else
          {
            $esito["stato"] = "non eseguito";
          }
          print_r(json_encode($esito));
          break;


    default:
    	  $sqlInserisciRisposta =
          "
          INSERT INTO _webquizRisp (fk_utente, fk_categoria, fk_domanda,dataRisposta, risposta, commento)
          VALUES ('$IDutente','$IDcategoria','$IDomanda',CURDATE(),'$rispUtente', '$c')
          ON DUPLICATE KEY UPDATE risposta = '$rispUtente', commento = '$c'

          ";

          $q = mysql_query($sqlInserisciRisposta) or die("errore esecuzione query".mysql_error());

          if($q)
          {$esito["stato"] = "eseguito";}
          else
          {
            $esito["stato"] = "non eseguito";
          }
          print_r(json_encode($esito));
}






?>
