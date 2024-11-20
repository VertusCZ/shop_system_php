<?php
session_start();
include_once 'connect.php';
?>
<?php 
if (isset($_SESSION["uzivatel"]))
{
}
else
$hlaska = "Pro správu se přihlašte"; 
?>
<!DOCTYPE html>

<html>

<head>



  
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  <script type="text/javascript" src="jquery.dataTables.js"></script>
 <script  type="text/javascript">
  

    $(document).ready(function() {
        $('.datatable').dataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Czech.json"
            }
            
        } );
    } );
  </script>
  
</head>
<link rel="stylesheet" href="css/panel.css">
<link rel="stylesheet" href="css/prehledspravce.css">
<body>
<?php
include_once 'panelPrihlaseni.php';
?>
<div class="topnav">
<i class="fa fa-bars" ></i>
<a href="index.php">Katalog</a>
<?php
if (!empty($hlaska)) {?> 
  <a class="neprihlasen" href="prihlaseni.php"><?= $hlaska; ?></a>
   <?php }?>
<a class="active">Přehled správce</a>
    </div>  
    <?php
  if (isset($_SESSION["uzivatel"])) {
?>

<div class="container">
<label class="l1">Zboží
 <button type="button" onclick="location.href =  'Zbozi.php'" class="btn btn-primary">Přidat</button></label>

    
  <?php
    $sqlzbo = "
    SELECT ID_ZB, zbozi.nazev, 
    zbozi.ID_KA, kategorie.nazev AS nazev_kategorie, 
    zbozi.ID_VY, vyrobce.jmeno AS jmeno_vyrobce
    FROM zbozi
    INNER JOIN kategorie
    ON zbozi.ID_KA = kategorie.ID_KA
   INNER JOIN  vyrobce
    ON zbozi.ID_VY= vyrobce.ID_VY 
    ";
    $vybratzbozi= $conn->query($sqlzbo);
    $zbozi =$vybratzbozi->fetch_all(MYSQLI_ASSOC);
?>
 
  <table class="datatable">
    <thead>
      <tr>
        <th>Název</th>
        <th>Kategorie</th>
        <th>Výrobce</th>
        <th>Admin</th>
      </tr>
    </thead>
    <tbody>
    
    <?php
    foreach ($zbozi as $zbo) {
      ?>
      
    <tr>
  <td><?= $zbo["nazev"] ?></td> 
  <td><?= $zbo["nazev_kategorie"] ?></td>
  <td><?= $zbo["jmeno_vyrobce"] ?></td>
  <td> 
      <button type="button" onclick="location.href =  'Zbozi.php?editovatZbozi=<?= $zbo["ID_ZB"] ?>'" 
      class="btn btn-primary">Editovat</button>
    
  <button type="button" onclick=" if (window.confirm('Chcete odstranit zbozi: <?= $zbo["nazev"] ?> ?')) 
    location.href = 'Zbozi.php?odstranitZbozi=<?= $zbo["ID_ZB"] ?>' " 
            class="btn btn-danger">Smazat</button> </td>
  </tr>
  <?php } 
 ?>
 
 
   </tbody>
  </table>
  
  
  <?php
    $sqlkat = "
    SELECT ID_KA, kategorie.nazev AS nazev_kategorie 
    FROM  kategorie
    ";
    $resultKategorie = $conn->query($sqlkat);
    $kategorie = $resultKategorie->fetch_all(MYSQLI_ASSOC);
?>
<label class="l1">Kategorie
<button type="button" onclick="location.href =  'Kategorie.php'" class="btn btn-primary">Přidat</button></label>
  <table class="datatable">
    <thead>
      <tr>
        <th>Kategorie</th>
        <th>Admin</th>
      </tr>
    </thead>
    <body>
    
    <?php
    foreach ($kategorie as $kat) {
      ?>
      
    <tr>
  <td><?= $kat["nazev_kategorie"] ?></td>
  <td> 
      <button type="button" onclick="location.href =  'Kategorie.php?editovatKategorii=<?= $kat["ID_KA"] ?>'" class="btn btn-primary">Editovat</button>
    
  <button type="button" onclick=" if (window.confirm('Chcete odstranit kategorii: <?= $kat["nazev_kategorie"] ?> ?')) location.href = 
          'Kategorie.php?odstranitKategorii=<?= $kat["ID_KA"] ?>' "class="btn btn-danger">Smazat</button> </td>
  </tr>
  


 
    
    <?php } 
 
 ?>
 
 
   </body>
  </table>
  
  
  <?php
    $sqlvyr = "
    SELECT ID_VY, vyrobce.jmeno AS jmeno_vyrobce 
    FROM  vyrobce
    ";
    $resultVyrobce = $conn->query($sqlvyr);
    $vyrobce = $resultVyrobce->fetch_all(MYSQLI_ASSOC);
?>
<label class="l1">Vyrobce
 <button type="button" onclick="location.href =  'Vyrobce.php'" class="btn btn-primary">Přidat</button></label>
  <table class="datatable">
    <thead>
      <tr>
        <th>Vyrobce</th>
        <th>Admin</th>
      </tr>
    </thead>
    <body>
    
    <?php
    foreach ($vyrobce as $vyr) {
      ?>
      
    <tr>
  <td><?= $vyr["jmeno_vyrobce"] ?></td>
  <td> 
      <button type="button" onclick="location.href =  'Vyrobce.php?editovatVyrobce=<?= $vyr["ID_VY"] ?>'" class="btn btn-primary">Editovat</button>
    
  <button type="button" onclick=" if (window.confirm('Chcete odstranit výrobce: <?= $vyr["jmeno_vyrobce"] ?> ?')) 
                                      location.href = 'Vyrobce.php?odstranitVyrobce=<?= $vyr["ID_VY"] ?>' "class="btn btn-danger">Smazat</button> </td>
   </tr>
  
<?php } ?>
 
 
   </body>
  </table>
  
</div>
<?php } ?>  


</body>
</html>