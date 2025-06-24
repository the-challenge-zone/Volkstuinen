<?php
require_once __DIR__ . "/../../Backend/SessionChecker.php";
require_once __DIR__ . "/../../Backend/Models/User.php";
checkSession($allowedUserTypes = [4]);

$users = new User();
$usersResult = $users->findAllUsers();
        $counter = count($usersResult);
        // Fetch complex sizes from parcel_free
require_once __DIR__ . "/../../Backend/DatabaseContext/Database.php";
$conn = Database::GetConnection();

$query = "SELECT Complex, SUM(Size) AS TotalSize FROM parcel_free GROUP BY Complex";
$stmt = $conn->query($query);

$complexData = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $complexData[] = [
        'name' => $row['Complex'],
        'size' => (int)$row['TotalSize']
    ];
}

$conn = null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volkstuin Vereniging Sittard</title>
    <link rel="stylesheet" href="CSS-Admin/dashboard.css">
    
    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Pass PHP data to JS -->
    <script>
        const complexChartData = <?php echo json_encode($complexData); ?>;
    </script>

    <!-- Custom dashboard logic -->
    <script src="CSS-Admin\dashboard.js" defer></script>
</head>

<body>
<div class="sidebar">
    <img src="../../Frontend/Bestuurder/pictures/logo-volkstuinverenigingsittard.png" alt="Logo">
    <div class="Icoontjes">

        <a href="dashboard.php">
            <div class="icon1">
                <img src="../Gedeeld/pictures/HomeMenuButton.svg" alt="huisknop">
            </div>
        </a>
        <a href="../../Frontend/Formulier/aanvraag-parceel.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="settings">
            </div>
        </a>
        <a href="verzoek-volkstuin.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="settings">
            </div>
        </a>
        <a href="verzoek-naam.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="settings">
            </div>
        </a>
        <a href="wachtrij-beheer.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="settings">
            </div>
        </a>
        <a href="../../Backend/logout.php">
            <div class="icon3">
                
                <img src="../Gedeeld/pictures/ExitMenuButton.svg" alt="uitloggen">
            </div>
        </a>
    </div>

  </div>

<div class="header">
    VOLKSTUIN VERENING SITTARD
</div>
<div class="main-container">

    <p class="Dashtitle"> Welkom Admin</p>
    <div class="content">


        <!-- News Sectie (hier komen alle notificaties) -->
        <div class="news-sectie">
            <h2 class="newstitle">News binnen complex</h2>
            <div class="notificaties" id="notificaties">
                <!-- komen hier te staan als je een stuurt, dus als je iets wilt aanpassen moet dat met deze class -->
                <p>test</p>
            </div>
        </div>

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
            <img src="../../Frontend/Gedeeld/pictures/Slachthuis-800px.jpg" alt="tuin foto">
        </div>

        <div class="stats-sectiie">

            <div class="stats-item">
                <h3>Aantal Deelnemers In Complex</h3>
                <div class="number"><a href="Beheerder/Leden-beheer.php"><?php echo $counter?></a></div>

<div class="stats-item1">
    <h3>Verdeling per Complex</h3>
    <div class="Pie_Chart_Container">
        <canvas id="Complex_Chart" class="Animate_Pie_Chart" width="220" height="560"></canvas>
    </div>
</div>

            </div>
        </div>

    </div>

</body>
</html>
        </div>

    </div>

</body>
</html>