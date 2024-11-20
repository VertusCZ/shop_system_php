<?php
session_start();
include_once 'connect.php';
?> 

<?php
if (isset($_SESSION["uzivatel"]))
{
         
if (isset($_POST["editovatUzivatele"]))
{
  $sqluz="  UPDATE uzivatel SET
          jmeno='{$_POST["jmeno"]}',
         prijmeni='{$_POST["prijmeni"]}',
           login='{$_POST["login"]}'
           ".
           ($_POST["heslo"] ? ", heslo='" .sha1($_POST["heslo"]) ."' " : "")
        ."
         WHERE ID_UZ= {$_POST["ID_UZ"]} 
";
$conn->query($sqluz); 
header("Location: index.php");
} 

$sqluz=" SELECT ID_UZ,jmeno,prijmeni,login,heslo 
          FROM  uzivatel
          WHERE login = '{$_SESSION["uzivatel"]["login"]}' 
  ";
  $editovatUZ = $conn->query($sqluz);
  $uzi = $editovatUZ->fetch_assoc();

}         
else $hlaska = "Pro editaci správce se přihlašte";?> 
      
<!DOCTYPE html>
<html >
<head>
    
    <title>Hello there</title>
    <meta charset="utf-8"> 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<link rel="stylesheet" href="css/panel.css">
<link rel="stylesheet" href="css/editaceUzivatele.css">
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
<a class="spravce" >Editace správce</a> 
</div>

<?php
 if (isset($_SESSION["uzivatel"])){
   ?>
  <fieldset>
<legend>Zadejte data do tabulky</legend>
<form method='post'>
<div>
<label>Jméno</label>
<input type="hidden" name="ID_UZ" value="<?= $uzi["ID_UZ"] ?>">
<input type="text" name="jmeno" value="<?= $uzi["jmeno"]?>" placeholder="jmeno" required>
</div>
<div>
<label>Příjmení</label>
<input type="text" name="prijmeni" value="<?= $uzi["prijmeni"]?>" placeholder="prijmeni" required>
</div>
<div>
<label>Login</label>
<input type="text" name="login" value="<?= $uzi["login"]?>" placeholder="login" required>
</div>
<div>
<label>Heslo</label>
<input type="text" name="heslo" placeholder="nové heslo ">
</div>
<div>
<input type="submit" name="editovatUzivatele" value="Změnit">
</div>
</form>
</fieldset>
<?php }
    
?>

</body>
</html>