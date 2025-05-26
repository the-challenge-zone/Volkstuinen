<?php
require_once __DIR__ . "/../../Backend/SessionChecker.php";
require_once __DIR__."/../../Backend/Models/User.php";
checkSession($allowedUserTypes = [1,2,3]);
$user = new User();
$id = $_SESSION['user_id'];
$user->findByIdUser($id);

switch ($_SESSION['user_type']) 
{
    case 1:
        $dashboardurl = "../../Frontend/Deelnamer/dashboard.php";
    case 2:
        $dashboardurl = "../../Frontend/Beheerder/dashboard.php";
    case 3:
        $dashboardurl = "../../Frontend/Bestuurder/dashboard.php";
    default:
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


<div class="sidebar">
    <img src="../../Frontend/Gedeeld/pictures/logo-volkstuinverenigingsittard.png" alt="Logo">
    <div class="Icoontjes">
        <a href="<?php echo $dashboardurl; ?>">
            <div class="icon1">
                <img src="../Gedeeld/pictures/HomeMenuButton.svg" alt="huisknop">
            </div>
        </a>
        <a href="../../Frontend/Gedeeld/GebruikerInfo.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="gebruikerinfo">
            </div>
        </a>
        <a href="../../Frontend/login.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/ExitMenuButton.svg" alt="uitloggen">
            </div>
        </a>
    </div>

</div>


<div class="header">
    VOLKSTUIN VERENIGING SITTARD
</div>


    

</body>
</html>