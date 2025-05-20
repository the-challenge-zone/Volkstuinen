<?php
require_once __DIR__ . "/../../Backend/SessionChecker.php";
require_once __DIR__ . "/../../Backend/Models/User.php";

// Controleer sessie
checkSession($allowedUserTypes = [1, 2, 3]);

// Haal gebruiker op
$user = new User();
$id = $_SESSION['user_id'];
$user->findByIdUser($id);

// Haal UserType op
$userType = $user->getUserType(); // Zorg dat getUserType() bestaat in User.php

// Bepaal juiste dashboard link
switch ($userType) {
    case 1:
        $dashboardLink = "../../Frontend/Bestuurder/dashboard.php";
        break;
    case 2:
        $dashboardLink = "../../Frontend/Beheerder/dashboard.php";
        break;
    case 3:
        $dashboardLink = "../../Frontend/Deelnamer/dashboard.php";
        break;
    default:
        // Ongeldig usertype, stuur naar login
        header("Location: ../../Frontend/login.php");
        exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volkstuin Vereniging Sittard</title>
    <link rel="stylesheet" href="CSS-Gedeeld/Gebruikerinfo.css">
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <img src="../../Frontend/Gedeeld/pictures/logo-volkstuinverenigingsittard.png" alt="Logo">
    <div class="Icoontjes">

        <!-- Dynamische home-knop -->
        <a href="../../Frontend/Bestuurder/dashboard.php">
            <div class="icon1">
                <img src="../Gedeeld/pictures/HomeMenuButton.svg" alt="huisknop">
            </div>
        </a>

        <!-- Gebruikerinfo -->
        <a href="../../Frontend/Gedeeld/GebruikerInfo.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="gebruikerinfo">
            </div>
        </a>

        <!-- Uitloggen -->
        <a href="../../Frontend/logout.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/ExitMenuButton.svg" alt="uitloggen">
            </div>
        </a>

    </div>
</div>

<!-- Header -->
<div class="header">
    VOLKSTUIN VERENIGING SITTARD
</div>

<!-- Je kunt hier de rest van je pagina inhoud plaatsen -->

</body>
</html>
