<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 
Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<title>PAGINA CARICAMENTO DATI</title>
</head>

<body>
<table border="0">
  <tr>
    <td align="center">Inserisci i dati richiesti</td>
  </tr>
  <tr>
    <td>
      <table>
        <form method="POST" action="">
        <tr>
          <td>fk_cat</td>
          <td><input type="text" name="categoria" size="20">
          </td>
        </tr>
        <tr>
          <td>com</td>
          <td><input type="text" name="domanda" size="40">
          </td>
        </tr>
        <tr>
          <td></td>
          <td align="right"><input type="submit" 
          name="submit" value="Sent"></td>
        </tr>
        </form>
        </table>
      </td>
    </tr>
</table>
</body>
</html>
<?
//la stringa mysql_connect deve essere compilata con i dati relativi al proprio database
// HOST = IP server Mysql
// USER = Nome utente databse
// PASSWORD = Password utente databse
mysql_connect("localhost","marioperna","");//database connection
// Qui sotto al posto di NOME_DATABASE, inserite il nome del vostro DB
mysql_select_db("my_marioperna");

// recupero i valori si NOME e INDIRIZZO e li assegno alle variabili $name e $address
$categoria = stripslashes($_POST['categoria']);
$domanda = stripslashes($_POST['domanda']);

//inserting data order stripslashes()
$toinsert = "INSERT INTO _webquiz
			(fk_categoria, domanda)
			VALUES
			('$categoria',
			'$domanda')";

//declare in the order variable
$result = mysql_query($toinsert);	//order executes
if($result){
	echo("<br>Inserimento avvenuto correttamente");
} else{
	echo("<br>Inserimento non eseguito");
}
?>