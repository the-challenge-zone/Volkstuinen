<?php
require_once __DIR__ . "/../../Backend/SessionChecker.php";
require_once __DIR__ . "/../../Backend/Models/User.php";

checkSession($allowedUserTypes = [2]);

$secondary_SearchTerm = $_SESSION['user_complex'];
$users = new User();
$usersResult = $users->SearchUsers("Complex", $secondary_SearchTerm);
        $counter = count($usersResult);

$gebruiker = $_SESSION['user_id'];
$users = new User();
$usersResult = $users->findAllUsers();
        $counter = count($usersResult);
s

// Haal UserType op
$userType = $users->getUserType(); // Zorg dat getUserType() bestaat in User.php

// Bepaal juiste dashboard link
switch ($gebruiker) {
    case 1:
        $dashboardLink = "../../Frontend/Bestuurder/gebruikersinfo.php";                         Jarolds creation
        break;
    case 2:
        $dashboardLink = "../../Frontend/Beheerder/gebruikerinfo.php";
        break;
    case 3:
        $dashboardLink = "../../Frontend/Deelnamer/gebruikerinfo.php";
        break;
    default:
        // Ongeldig usertype, stuur naar login
        header("Location: ../../Frontend/login.php");
        exit();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Volkstuin Vereniging Sittard</title>
  <link rel="stylesheet" href="CSS-Beheerder/dashboard.css">
    <!-- javascript library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- javascript link -->
    <script src="dashboard.js" defer></script>
</head>
<body>


  <div class="sidebar">
    <img src="../../Frontend/Gedeeld/pictures/logo-volkstuinverenigingsittard.png" alt="Logo">
    <div class="Icoontjes">

    <a href="dashboard.php">
        <div class="icon1">
            <img src="../Gedeeld/pictures/HomeMenuButton.svg" alt="huisknop">
        </div>
    </a>
    <a href="<?'$dashboardLink'?>">
        <div class="icon2">
            <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="settings">
        </div>
    </a>
    <a href="../../Frontend/login.php">
        <div class="icon2">
            <img src="../Gedeeld/pictures/ExitMenuButton.svg" alt="Uitloggen">
        </div>
    </a>
    </div>

  </div>

  <div class="header">
    VOLKSTUIN VERENIGING SITTARD
  </div>
  <div class="main-container">

    <p class="Dashtitle"> Welkom Beheerder</p>
    <div class="content">

        <!-- Modal voor Full View -->
        <div class="modal" id="modal">
            <div class="modal-content">
                <span class="close-btn" id="close-btn">&times;</span>
                <div id="modal-text">
                    <h2 id="modal-title"></h2>
                    <p id="modal-description"></p>
                </div>
            </div>
        </div>

      <div class="grote-foto">
        <img src="../../Frontend\Gedeeld\pictures\Slachthuis.jpg" alt="tuin foto">
      </div>

      <div class="stats-sectiie">
        <div class="stats-item">
            <a href="Leden-beheer.php">
          <h3>Aantal Deelnemers In Complex</h3></a>
          <div class="number"><?php echo $counter?></div>
      </div>
        <div class="stats-item1">
          <h3>Grond In Gebruik</h3>
            <div class="Pie_Chart_Container">
            <canvas id="Pie_Chart" class="Animate_Pie_Chart" width="220" height="560"></canvas>
            <ul id="Pie_Chart_"></ul>
            </div>
        </div>

      </div>
    </div>
</body>
</html>