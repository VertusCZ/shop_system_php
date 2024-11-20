<?php
session_start();
include_once 'connect.php';
?> 

<?php
if (isset($_SESSION["uzivatel"]))
{
         


if (isset($_POST["pridatVyrobce"])) { 
    if (empty($_POST["ID_VY"]))
    {
        $sqlvyr="  INSERT INTO  vyrobce (jmeno,cele_jmeno,stat)
        VALUES ('{$_POST["jmeno"]}','{$_POST["cele_jmeno"]}','{$_POST["stat"]}')";
          $conn->query($sqlvyr);
    }
    else 
    {
      $sqlvyr = "
        UPDATE vyrobce SET jmeno='{$_POST["jmeno"]}',
                           cele_jmeno='{$_POST["cele_jmeno"]}',
                           stat='{$_POST["stat"]}'
        WHERE ID_VY = {$_POST["ID_VY"]} 
      ";
      $conn->query($sqlvyr);
    }
    header("Location: prehledspravce.php");  
  }
 
if (isset($_GET["odstranitVyrobce"]))
{
  $sqlvyr="
    DELETE FROM vyrobce
    WHERE ID_VY = {$_GET["odstranitVyrobce"]}
  ";
  $conn->query($sqlvyr);
  header("Location: prehledspravce.php");
}
   

if (isset($_GET["editovatVyrobce"]))
{
  $sqlvyr ="
    SELECT *
    FROM vyrobce
    WHERE ID_VY = {$_GET["editovatVyrobce"]}
    ORDER BY jmeno
  ";
  $editovatVYR = $conn->query($sqlvyr);
  $vyr = $editovatVYR->fetch_assoc();
               
} 
else
  $vyr = array("ID_VY" => "","jmeno" => "","cele_jmeno" => "" ,"stat" => ""  ); 
}
else
$hlaska = "Pro správu vyrobce se přihlašte";          

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
<link rel="stylesheet" href="css/vyrobce.css">
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
<a href="prehledspravce.php"class="prehled">Přehled správce</a>
  <?php }?>
<a class="vyrobce" >Editace výrobce</a> 
</div>
<?php
  if (isset($_SESSION["uzivatel"])) {

?>
<fieldset>
<legend>Zadejte data do tabulky</legend>
<form method='post'>
<div>
<label>Jmeno</label>
<input type="hidden" name="ID_VY" value="<?= $vyr["ID_VY"] ?>">
<input type="text" name="jmeno" value="<?= $vyr["jmeno"]?>" placeholder="vyrobce"required>
<label>Celé Jméno</label>
<input type="text" name="cele_jmeno" value="<?= $vyr["cele_jmeno"]?>" placeholder="celé jméno">
<label>Stát</label>
<input type="text" name="stat" value="<?= $vyr["stat"]?>" placeholder="stát">
</div>
<div>
<input type="submit" name="pridatVyrobce" value="Uložit">
</div>
</form>
<?php }
    
?>

</body>
</html>