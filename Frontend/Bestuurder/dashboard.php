<?php
require_once __DIR__ . "/../../Backend/SessionChecker.php";
require_once __DIR__ . "/../../Backend/Models/User.php";

checkSession($allowedUserTypes = [3]);

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
    <link rel="stylesheet" href="CSS-Bestuurder/dashboard.css">
<<<<<<< Updated upstream
    <!-- javascript library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- javascript link -->
=======
    
    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Pass PHP data to JS -->
    <script>
        const complexChartData = <?php echo json_encode($complexData); ?>;
    </script>

    <!-- Custom dashboard logic -->
>>>>>>> Stashed changes
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
        <a href="../../Frontend/Bestuurder/GebruikerInfo.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="settings">
            </div>
        </a>
        <a href="../../Frontend/Bestuurder/complex.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="gebruikerinfo">
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

    <p class="Dashtitle"> Welkom Bestuurder</p>
    <div class="content">


        <!-- News Sectie (hier komen alle notificaties) -->
        <div class="news-sectie">
            <h2 class="newstitle">News binnen complex</h2>
            <div class="notificaties" id="notificaties">
                <!-- komen hier te staan als je een stuurt, dus als je iets wilt aanpassen moet dat met deze class -->
                <p>test</p>
            </div>
        </div>

        

        <div class="grote-foto">
            <img src="../../Frontend/Gedeeld/pictures/Slachthuis.jpg" alt="tuin foto">
        </div>

        <div class="stats-sectiie">
            <div class="stats-item">
                <a href="Leden-beheer.php"></a>
                <h3>Aantal Deelnemers In Complex</h3>
                <div class="number"><a href="Leden-beheer.php"><?php echo $counter?></a></div>
<<<<<<< Updated upstream
            </div>
                <div class="stats-item1">
                    <h3>Grond In Gebruik</h3>
                    <div class="Pie_Chart_Container">
                        <canvas id="Pie_Chart" class="Animate_Pie_Chart" width="220" height="560"></canvas>
                        <ul id="Pie_Chart_"></ul>
                    </div>
                </div>
=======

<div class="stats-item1">
    <h3>Verdeling per Complex</h3>
    <div class="Pie_Chart_Container">
        <canvas id="Complex_Chart" class="Animate_Pie_Chart" width="220" height="560"></canvas>
    </div>
</div>
>>>>>>> Stashed changes

            </div>
        </div>

    </div>

</body>
</html>
        </div>

    </div>

</body>
</html>