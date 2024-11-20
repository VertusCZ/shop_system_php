<div class="panelUzivatele">
<?php
  if (isset($_SESSION["uzivatel"])) {
?>
  Přihlášen:
  <strong> <?= $_SESSION["uzivatel"]["jmeno"] ?>
  <?= $_SESSION["uzivatel"]["prijmeni"] ?></strong>
  <a href="odhlaseni.php">Odhlásit se</a>
  <a href="editaceUzivatele.php">Nastavení</a>
<?php
	} else {
?>
  <a href="prihlaseni.php">Přihlásit se</a>
<?php
	       }
?>
</div>