<?php
session_start();
include_once 'connect.php';
?> 

<?php

  if (isset($_POST["login"])) { 
      $sql = "
        SELECT *
        FROM uzivatel
        WHERE login = '{$_POST["login"]}'
        AND heslo = '".sha1($_POST["heslo"])."'
      ";
    
    $uzivatelDB = $conn->query($sql); 
    $uzivatel = $uzivatelDB->fetch_assoc();
    
    if ($uzivatel)
    {
      $_SESSION["uzivatel"] = $uzivatel;
      header("Location: index.php");
    }
    else
    {
      $hlaska = "Přihlašovací údaje nejsou správné!";
    }
    
  }
?>

<!DOCTYPE html>
<html lang='cs'>
  <head>
    <title>Přihlášení uživatele</title>
    <meta charset='utf-8'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<link rel="stylesheet" href="css/panel.css">
<link rel="stylesheet" href="css/prihlaseni.css">
  <body>
  <div class="topnav">

<i class="fa fa-bars" ></i>
 
<a href="index.php">Katalog</a>
<a class="prihlaseni" >Přihlášení uživatele</a> 
</div>
<?php
if (!empty($hlaska)) {
  echo"".$hlaska;
    }?>
<fieldset>
<legend>Zadejte data do tabulky</legend>    
  <form method="post">
    <div>
      <label for="login">Uživatelské jméno</label>
      <input type="text" name="login" id="login" required>
    </div>
    <div>
      <label for="heslo">Heslo</label>
      <input type="password" name="heslo" id="heslo" required>
    </div>
    <input type="submit" value="Přihlásit se">
  </form>
   
  </body>
</html>



