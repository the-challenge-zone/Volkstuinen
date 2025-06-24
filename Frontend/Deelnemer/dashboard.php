<?php
require_once __DIR__ . "/../../Backend/SessionChecker.php";
checkSession([1]); // Only allow user type 1
session_start();
$identifier = $_SESSION['identifier'] ?? 'Gebruiker'; // Get identifier from session


require_once "../../Backend/Models/User.php";// Include database connection file

$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "volkstuinen";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM parcel";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Volkstuin Vereniging Sittard</title>
  <link rel="stylesheet" href="CSS-Deelnemer/dashboard.css">
</head>
<body>

  <!-- Koptekst -->
  <div class="header">VOLKSTUIN VERENIGING SITTARD</div>

  <!-- Zijbalk -->
  <div class="sidebar">
    <img src="../Gedeeld/pictures/logo-volkstuinverenigingsittard.png" alt="Logo">

    <div class="Icoontjes">
      <a href="dashboard.php">
        <div class="icon1">
          <img src="../Gedeeld/pictures/HomeMenuButton.svg" alt="Dashboard">
        </div>
      </a>
      <a href="../../Frontend/Gedeeld/GebruikerInfo.php">
        <div class="icon2">
          <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="Gebruikersinstellingen">
        </div>
      </a>
      <a href="../../Backend/logout.php">
        <div class="icon3">
          <img src="../Gedeeld/pictures/ExitMenuButton.svg" alt="Uitloggen">
        </div>
      </a>
    </div>
  </div>

  <!-- Hoofdcontainer -->
  <div class="main-container">
    <div class="Dashtitle"><p>Hallo, <?= htmlspecialchars($identifier) ?></p></div>
    <div class="line1"></div>
    
    <div class="content">
      <div class="news-sectie">
        <div class="foto1">
          <img src="pictures/Slachthuis-800px.jpg" alt="Tuin foto">
        </div>
      </div>

      <div class="tuintje-gegevens">
        <div class="uw-tuintje">Uw tuintje</div>


        <div class="kosten"><p>Kosten</p></div>
        <div class="line2"></div>
        <div class="grond"><p>Grond</p></div>

        
        
      </div>
    </div>
  </div>

</body>
</html>
