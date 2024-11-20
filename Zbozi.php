<?php
session_start();
include_once 'connect.php';
?> 


<?php
if (isset($_SESSION["uzivatel"]))
{

if(isset($_POST['Odeslani_dat'])){
  if (empty($_POST["ID_ZB"]))
  {
   
  $sqlzbo = "INSERT INTO zbozi (nazev,modelove_oznaceni,rozmery,spotreba,pamet,vykon,frekvence,socket,cipset,typ_pameti,cteni,zapis,hmotnost,format,
                                konektory,pokrocile_parametry,funkce,ID_VY,ID_KA)
  VALUES ('{$_POST["nazev"]}','{$_POST["modelove_oznaceni"]}','{$_POST["rozmery"]}','{$_POST["spotreba"]}','{$_POST["pamet"]}','{$_POST["vykon"]}','{$_POST["frekvence"]}','{$_POST["socket"]}',
  '{$_POST["cipset"]}','{$_POST["typ_pameti"]}','{$_POST["cteni"]}','{$_POST["zapis"]}','{$_POST["hmotnost"]}','{$_POST["format"]}','{$_POST["konektory"]}','{$_POST["pokrocile_parametry"]}',
  '{$_POST["funkce"]}',{$_POST["Vyrobce"]},{$_POST["Kategorie"]})";
  $conn->query($sqlzbo);
  $last_id = $conn->insert_id;
  
  
  // obrázek
   if(!empty($_FILES['obrazek']['name'])){
    mkdir("foto/$last_id");
     $nazev_obrazku=$_FILES['obrazek']['name'];
     move_uploaded_file($_FILES['obrazek']['tmp_name'], "foto/$last_id/".$_FILES['obrazek']['name']);
   }
  
  header("Location: prehledspravce.php");
}

else 
    {
      $sqlzbo = "
        UPDATE zbozi SET   nazev='{$_POST["nazev"]}', modelove_oznaceni='{$_POST["modelove_oznaceni"]}',rozmery='{$_POST["rozmery"]}',spotreba='{$_POST["spotreba"]}',
                           pamet='{$_POST["pamet"]}',vykon='{$_POST["vykon"]}',frekvence='{$_POST["frekvence"]}',socket='{$_POST["socket"]}',cipset='{$_POST["cipset"]}',
                           typ_pameti='{$_POST["typ_pameti"]}',cteni='{$_POST["cteni"]}',zapis='{$_POST["zapis"]}',hmotnost='{$_POST["hmotnost"]}',
                           format='{$_POST["format"]}',konektory='{$_POST["konektory"]}',pokrocile_parametry='{$_POST["pokrocile_parametry"]}',
                           funkce='{$_POST["funkce"]}', ID_VY='{$_POST["Vyrobce"]}',ID_KA='{$_POST["Kategorie"]}'
        WHERE ID_ZB = {$_POST["ID_ZB"]} 
      ";  
    $conn->query($sqlzbo);

    // obrázek
   if(!empty($_FILES['obrazek']['name'])){
      if (!file_exists("foto/{$_POST["ID_ZB"]}"))
      	mkdir("foto/{$_POST["ID_ZB"]}");
      
     foreach (glob("foto/{$_POST["ID_ZB"]}/*.*") as $soubor)
    
       unlink($soubor); // pokud chceme img nahradit // jinak tento řádek zakomentovat a budou se img přidávat
     
     move_uploaded_file($_FILES['obrazek']['tmp_name'], "foto/{$_POST["ID_ZB"]}/".$_FILES['obrazek']['name']);
   }
    
     
    header("Location: prehledspravce.php");
    }
    
  }

if (isset($_GET["odstranitZbozi"]))
{
  $sqlzbo="
    DELETE FROM zbozi
    WHERE ID_ZB = {$_GET["odstranitZbozi"]}
  ";
  
  foreach (glob("foto/{$_GET["odstranitZbozi"]}/*.*") as $soubor)
    
  unlink($soubor);
 
  rmdir("foto/{$_GET["odstranitZbozi"]}");
  
  $conn->query($sqlzbo);
  header("Location: prehledspravce.php");
}

if (isset($_GET["editovatZbozi"]))
{
  $sqlzbo="
    SELECT *
    FROM  zbozi
    WHERE  ID_ZB = {$_GET["editovatZbozi"]}

    ORDER BY nazev
  ";
  $editovatZB = $conn->query($sqlzbo);
  $zbo = $editovatZB->fetch_assoc();
              
} 
else
  $zbo = array("ID_ZB" => "","nazev" => "", "modelove_oznaceni"=> "" ,"rozmery" => "","spotreba" => "","pamet" => "","vykon" => "","frekvence" => "","socket" => "","cipset" => "",
  "typ_pameti" => "","cteni" => "","zapis" => "","hmotnost" => "","format" => "",
  "konektory" => "","pokrocile_parametry" => "","funkce" => "","ID_VY" => "","ID_KA" => ""); 
}
else
$hlaska = "Pro správu zboží se přihlašte"; 
?>

<!DOCTYPE html>
<html >
<head>
    
    <title>Hello there</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<link rel="stylesheet" href="css/zbozi.css">
<link rel="stylesheet" href="css/panel.css">
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
<a class="zbozi" >Portál pro zadávání dat</a> 
</div>
<?php
  if (isset($_SESSION["uzivatel"])) {

?>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="ID_ZB" value="<?= $zbo["ID_ZB"] ?>">
<fieldset>
<legend>Zadejte data do tabulek (Je-li uvedeno zapište v odpovídajících jednotkách)</legend>
<!------------ kategorie--------- -->
<div>
 <label for="Kategorie" class="nazev">Kategorie</label>
 <select name="Kategorie" id="Kategorie"class="editkat" required>
 <option value="">Vyberte:</option>
 <?php

$sqlkat = "SELECT ID_KA, nazev FROM kategorie ORDER BY nazev";
$resultKategorie = $conn->query($sqlkat);
$kategorie = $resultKategorie->fetch_all(MYSQLI_ASSOC);

$option1 = '';
 foreach ($kategorie as $kat) {
?>  
  <option value="<?= $kat['ID_KA'] ?>" <?= isset($zbo["ID_KA"]) && $zbo["ID_KA"] == $kat['ID_KA'] ? "selected" : "" ?>><?= $kat['nazev'] ?></option>
<?php } ?> 
</select> 
</div> 
<!------------ vyrobce--------- -->
<div>
 <label for="Vyrobce" class="nazev">Vyrobce</label>
 <select name="Vyrobce" id="Vyrobce"class="editvyr" required>
 <option value="">Vyberte:</option>
 <?php

$sqlvyr = "SELECT ID_VY, jmeno FROM vyrobce ORDER BY jmeno";
$resultVyrobce = $conn->query($sqlvyr );
$vyrobce = $resultVyrobce->fetch_all(MYSQLI_ASSOC);

$option = '';
 foreach ($vyrobce as $vyr) {
?>  
  <option value="<?= $vyr['ID_VY'] ?>" <?= isset($zbo["ID_VY"]) && $zbo["ID_VY"] == $vyr['ID_VY'] ? "selected" : "" ?>><?= $vyr['jmeno'] ?></option>
<?php } ?>  
</select> 
</div> 
<!------------ zbozi--------- -->

<div>
<label class="nazev">Název</label>
<input type="text" name="nazev"value="<?= $zbo["nazev"]?>" placeholder="nazev" required>
</div>
<div>
<label class="nazev">Modelové označeni</label>
<input type="text" name="modelove_oznaceni"value="<?= $zbo["modelove_oznaceni"]?>" placeholder="modelové označení " >
</div>
<div>
<label class="nazev">Rozměry</label>
<input type="text" name="rozmery"value="<?= $zbo["rozmery"]?>" placeholder="v cm" >
</div>
<div>
<label class="nazev">Spotřeba</label>
<input type="text" name="spotreba"value="<?= $zbo["spotreba"]?>" placeholder="ve Wattech" >
</div>
<div>
<label class="nazev">Paměť</label>
<input type="text" name="pamet"value="<?= $zbo["pamet"]?>" placeholder="v Gb" >
</div>
<div>
<label class="nazev">Výkon</label>
<input type="text" name="vykon"value="<?= $zbo["vykon"]?>" placeholder="výkon" >
</div>
<div>
<label class="nazev">Frekvence</label>
<input type="text" name="frekvence"value="<?= $zbo["frekvence"]?>" placeholder="v GHz" >
</div>
<div>
<label class="nazev">Socket</label>
<input type="text" name="socket"value="<?= $zbo["socket"]?>" placeholder="socket" >
</div>

<label class="nazev">Čipset</label>
<input type="text" name="cipset"value="<?= $zbo["cipset"]?>" placeholder="čipset" >
</div>
<div>
<label class="nazev">Typ paměti</label>
<input type="text" name="typ_pameti"value="<?= $zbo["typ_pameti"]?>" placeholder="typ pameti" >
</div>
<div>
<label class="nazev">Čtení</label>
<input type="text" name="cteni"value="<?= $zbo["cteni"]?>" placeholder="v Mb/s" >
</div>
<div>
<label class="nazev">Zápis</label>
<input type="text" name="zapis"value="<?= $zbo["zapis"]?>" placeholder="v Mb/s" >
</div>
<div>
<label class="nazev">Hmotnost</label>
<input type="text" name="hmotnost"value="<?= $zbo["hmotnost"]?>" placeholder="v Gramech" >
</div>
<div>
<label class="nazev">Formát</label>
<input type="text" name="format"value="<?= $zbo["format"]?>" placeholder="format" >
</div>
<div>
<label class="nazev">Konectory</label>
<input type="text" name="konektory"value="<?= $zbo["konektory"]?>" placeholder="konektory" >
</div>
<div>
<label class="nazev">Pokročilé parametry</label>
<input type="text" name="pokrocile_parametry"value="<?= $zbo["pokrocile_parametry"]?>" placeholder="pokročilé parametry" >
</div>
<div>
<label class="nazev">Funkce</label>
<input type="text" name="funkce"value="<?= $zbo["funkce"]?>" placeholder="funkce" >
</div>

<!------------ obrazek--------- -->
 
<div>
<input type="file" name="obrazek">
</div>
<div>
<input type="submit" name="Odeslani_dat" value="Odeslat data">
</div>
</fieldset>
</form>

 <?php  } ?> 

</body>
</html>
