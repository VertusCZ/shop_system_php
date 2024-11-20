<?php
session_start();
include_once 'connect.php';
?> 
<?php
if (isset($_SESSION["uzivatel"]))
{
}
else
$hlaska = "Pro správu zboží se přihlašte"; 
?>
<!DOCTYPE html>
<html >
<head>
    
    <title>Hello there</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="lightbox/css/lightbox.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="lightbox/js/lightbox.js"></script>
</head>
<link rel="stylesheet" href="css/panel.css">
<link rel="stylesheet" href="css/index.css">
<body>

<?php
  include 'panelPrihlaseni.php';
?>
  <div class="hlasky">

<div class="topnav">
<i class="fa fa-bars" ></i>
  <?php
  if (isset($_SESSION["uzivatel"])) {
?>
<a class="prehled" href="prehledspravce.php">Přehled správce</a>

  <?php }  if (!empty($hlaska)) {?> 
  <a class="neprihlasen" href="prihlaseni.php"><?= $hlaska; ?></a>
   <?php }?>
  <a class="active"href="index.php" >Katalog zboží</a>
  <div class="search-container">
    <form>
      <input type="text" placeholder="Hledaný výraz..." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

  <?php

$sqlkat = "SELECT ID_KA, nazev FROM kategorie ORDER BY nazev";
$resultKategorie = $conn->query($sqlkat);
$kategorie = $resultKategorie->fetch_all(MYSQLI_ASSOC);

$option1 = '';

$sqlvyr = "SELECT ID_VY, jmeno FROM vyrobce ORDER BY jmeno";
$resultVyrobce = $conn->query($sqlvyr );
$vyrobce = $resultVyrobce->fetch_all(MYSQLI_ASSOC);
$option = '';
?>


<div class="sidebar">
<ul>
  <li><a class="active">Nabídka podle:</a></li>
  <li><a class="active" >Vyrobce:</a></li>
  <?php foreach ($vyrobce as $vyr) { ?>
  <li><a href="?vyrobce=<?= $vyr["ID_VY"]?>"><?php  echo "".$vyr["jmeno"]; } ?></a></li>
  <li><a class="active" >Kategorie:</a></li>
  <?php foreach ($kategorie as $kat) { ?>
  <li><a  href="?kategorie=<?= $kat["ID_KA"]?> "><?php  echo "".$kat["nazev"]; } ?></a></li>
</ul>
</div>

<?php
$zbo = "
  SELECT ID_ZB, zbozi.nazev,modelove_oznaceni,
         rozmery,spotreba,pamet,vykon,frekvence,socket,cipset,typ_pameti,
         cteni,zapis,hmotnost,format,
         konektory,pokrocile_parametry,funkce,
         zbozi.ID_KA, kategorie.nazev AS nazev_kategorie, 
         zbozi.ID_VY, vyrobce.jmeno AS jmeno_vyrobce
  FROM zbozi
    INNER JOIN kategorie
      ON zbozi.ID_KA = kategorie.ID_KA
    INNER JOIN  vyrobce
    ON zbozi.ID_VY= vyrobce.ID_VY 
";

 if(isset($_GET["kategorie"]))
    $zbo .= "WHERE zbozi.ID_KA={$_GET["kategorie"]}";
    
  if(isset($_GET["vyrobce"]))
    $zbo .= "WHERE vyrobce.ID_VY={$_GET["vyrobce"]}";
    
    if(isset($_GET["search"]))
    $zbo .= "WHERE 
       zbozi.nazev LIKE '%{$_GET["search"]}%'
       OR kategorie.nazev  LIKE '%{$_GET["search"]}%'
       OR vyrobce.jmeno  LIKE '%{$_GET["search"]}%'
    ";
    
    
$resultzbozi = $conn->query($zbo);
$zbozi = $resultzbozi->fetch_all(MYSQLI_ASSOC);
 
 ?>
 
<div class="vypis_komponentu">   
<?php
  foreach ($zbozi as $zbo) {
?>
 <div class="komponent">
   <div class="zakladni_info">

<?php
// vypis obrazku

$cisloobrazku=$zbo["ID_ZB"];
if (is_dir("foto/$cisloobrazku/" )) {
$adresar = opendir("foto/$cisloobrazku");

  
    while ( false !== ($nazevSouboru = readdir($adresar)) )
  {
     if ($nazevSouboru != "." && $nazevSouboru != "..")
        echo "<br><a href='foto/$cisloobrazku/$nazevSouboru' data-lightbox='obr_$cisloobrazku'>
        <img src='foto/$cisloobrazku/$nazevSouboru' width='240' height='150'></a>";
  
  }
}
else {
   
   {
       echo "<br><img src='foto/bez_obrazku/nic.png' width='240' height='150'></a>";
 
   }
  
}
  
  ?>

  <div>
    <h2><?php echo "".$zbo["nazev"]; ?></h2>
  </div>
  <div>
    <?php echo "<strong>kategorie</strong>: ".$zbo["nazev_kategorie"]; ?>
  </div>
  <div>
  <?php echo "<strong>výrobce</strong>: ".$zbo["jmeno_vyrobce"];?>
  </div>
 </div>
 <div class="detialni_info">
     <div>
   <?php if (!empty($zbo["modelove_oznaceni"]))
       echo "<strong>modelové označení</strong>: ".$zbo["modelove_oznaceni"];?>
       </div>
       <div> 
       <?php   
       if (!empty($zbo["rozmery"]))
       echo "<strong>rozměry</strong>: ".$zbo["rozmery"];?>
       </div>
       <div> 
       <?php   
       
       if (!empty($zbo["spotreba"]))
       echo "<strong>spotřeba</strong>: ".$zbo["spotreba"];?>
       </div>
       <div> 
       <?php   
       
       if (!empty($zbo["pamet"]))
       echo "<strong>pamět</strong>: ".$zbo["pamet"];?>
       </div> 
       <div>
       <?php   
       
       if (!empty($zbo["vykon"]))
       echo "<strong>vykon</strong>: ".$zbo["vykon"];?>
       </div> 
       <div>
       <?php   
       
       if (!empty($zbo["frekvence"]))
       echo "<strong>frekvence</strong>: ".$zbo["frekvence"];?>
       </div>
       <div> 
       <?php   
       
       if (!empty($zbo["socket"]))
       echo "<strong>socket</strong>: ".$zbo["socket"];?>
       </div>
       <div> 
       <?php   

       if (!empty($zbo["cipset"]))
       echo "<strong>čipset</strong>: ".$zbo["cipset"];?>
       </div>
       <div> 
       <?php   
       
       if (!empty($zbo["typ_pameti"]))
       echo "<strong>typ paměti</strong>: ".$zbo["typ_pameti"];?>
       </div> 
       <div>
       <?php   
      
       if (!empty($zbo["cteni"]))
       echo "<strong>čteni</strong>: ".$zbo["cteni"];?>
       </div> 
       <div>
       <?php   
      
       if (!empty($zbo["zapis"]))
       echo "<strong>zápis</strong>: ".$zbo["zapis"];?>
       </div> 
       <div>
       <?php   
       
       if (!empty($zbo["hmotnost"]))
       echo "<strong>hmotnost</strong>: ".$zbo["hmotnost"];?>
       </div> 
       <div>
       <?php   
       
       if (!empty($zbo["format"]))
       echo "<strong>formát</strong>: ".$zbo["format"];?>
       </div>
       <div> 
       <?php   
       
       if (!empty($zbo["konektory"]))
       echo "<strong>konektory</strong>: ".$zbo["konektory"];?>
       </div> 
       <div>
       <?php   
       
       if (!empty($zbo["pokrocile_parametry"]))
       echo "<strong>další parametry</strong>: ".$zbo["pokrocile_parametry"];?>
       </div>
       <div> 
       <?php   
       
       if (!empty($zbo["funkce"]))
       echo "<strong>funkce</strong>: ".$zbo["funkce"];?>
       </div> 
      
  </div>
  

</div>
<?php
}
$conn->close();
?>

</div>

</body>
</html> 