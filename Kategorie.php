<?php
session_start();
include_once 'connect.php';
?>

<?php
if (isset($_SESSION["uzivatel"]))
{
         


if (isset($_POST["pridatKategorii"])) { 
    if (empty($_POST["ID_KA"]))
    {
        $sqlkat="  INSERT INTO  kategorie (nazev,popis)
        VALUES ('{$_POST["nazev"]}','{$_POST["popis"]}')";
          $conn->query($sqlkat);
    }
    else 
    {
      $sqlkat = "
        UPDATE kategorie SET nazev='{$_POST["nazev"]}',
                             popis='{$_POST["popis"]}'
        WHERE ID_KA = {$_POST["ID_KA"]} 
      ";
      $conn->query($sqlkat);
    }
    header("Location: prehledspravce.php");  
}
 
if (isset($_GET["odstranitKategorii"]))
{
  $sql="
    DELETE FROM kategorie
    WHERE ID_KA = {$_GET["odstranitKategorii"]}
  ";
  $conn->query($sql);
  header("Location: prehledspravce.php");
}
   

if (isset($_GET["editovatKategorii"]))
 {
  $sqlkat="
    SELECT *
    FROM kategorie
    WHERE ID_KA = {$_GET["editovatKategorii"]}
    ORDER BY nazev
  ";
  $editovatKAT = $conn->query($sqlkat);
  $kat = $editovatKAT->fetch_assoc();
               
 } 
else
  $kat = array("ID_KA" => "","nazev" => "","popis" => ""  ); 
}
else 
$hlaska = "Pro správu kategorií se přihlašte "; 
?>

      
<!DOCTYPE html>
<html >
<head>
    
    <title>Hello there</title>
    <meta charset="utf-8"> 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<link rel="stylesheet" href="css/panel.css">
<link rel="stylesheet" href="css/kategorie.css">
<body>
<?php
  include 'panelPrihlaseni.php';
?> 

<div class="topnav">

<i class="fa fa-bars" ></i>
 
<a href="index.php">Katalog</a>
<?php
if (!empty($hlaska)) {?> 
  <a class="neprihlasen" href="prihlaseni.php"><?= $hlaska; ?></a>
   <?php }?>
<?php
  if (isset($_SESSION["uzivatel"])) {

?>
<a href="prehledspravce.php">Přehled správce</a>
  <?php }?>
<a class="kategorie" >Editace kategorie</a> 
</div>
<?php
  if (isset($_SESSION["uzivatel"])) {

?>
<fieldset>
<legend>Zadejte data do tabulky</legend>
<form method='post'>
<div>
<label>Název</label>
<input type="hidden" name="ID_KA" value="<?= $kat["ID_KA"] ?>">
<input type="text" name="nazev" value="<?= $kat["nazev"]?>" placeholder="kategorie" required>
<label>Popis</label>
<input type="text" name="popis" value="<?= $kat["popis"]?>" placeholder="popis">
</div>
<div>
<input type="submit" name="pridatKategorii" value="Uložit">
</div>
</form>
</fieldset>
<?php }
    
?>

</body>
</html>