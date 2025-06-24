<?php
require_once __DIR__ . "/../../Backend/SessionChecker.php";
require_once __DIR__ . "/../../Backend/DatabaseContext/Database.php";
checkSession($allowedUserTypes = [4]);

$conn = Database::GetConnection();

// Sorting logic
$allowedSortFields = ['Name', 'RequestDate', 'Complex'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $allowedSortFields) ? $_GET['sort'] : 'Request_Date';
$orderBy = "ORDER BY $sort ASC";

// Fetch data
$stmt = $conn->query("SELECT Name, Parcel, motive, requested_meters, request_date FROM waiting_list $orderBy");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Wachtlijstbeheer - Volkstuin Vereniging Sittard</title>
    <link rel="stylesheet" href="CSS-Admin/dashboard.css">
</head>
<body>

<div class="sidebar">
    <img src="../../Frontend/Bestuurder/pictures/logo-volkstuinverenigingsittard.png" alt="Logo">
    <div class="Icoontjes">
        <a href="dashboard.php">
            <div class="icon1">
                <img src="../Gedeeld/pictures/HomeMenuButton.svg" alt="Dashboard">
            </div>
        </a>
        <a href="../../Backend/logout.php">
            <div class="icon3">
                <img src="../Gedeeld/pictures/ExitMenuButton.svg" alt="Uitloggen">
            </div>
        </a>
    </div>
</div>

<div class="header">VOLKSTUIN VERENIGING SITTARD</div>

<div class="main-container">
    <p class="Dashtitle">Wachtlijst Beheer</p>

    <div class="content">
        <form method="GET" style="margin-bottom: 20px;">
    <label for="sort">Sorteer op:</label>
    <select name="sort" id="sort" onchange="this.form.submit()">
        <option value="Name" <?php if($sort == 'Name') echo 'selected'; ?>>Naam</option>
        <option value="Parcel" <?php if($sort == 'Parcel') echo 'selected'; ?>>Complex</option>
        <option value="Request_Date" <?php if($sort == 'Request_Date') echo 'selected'; ?>>Datum</option>
    </select>
</form>
        <table border="1" cellpadding="10" cellspacing="0" class="data-table">
            <thead>
                <tr>
                    <th>Naam</a></th>
                    
                    <th>Complex</a></th>
                    <th>Meters Aangevraagd</th>
                    <th>Reden</th>
                    <th>Datum</a></th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($rows) > 0): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['Name']) ?></td>
                            
                            <td><?= htmlspecialchars($row['Parcel']) ?></td>
                            <td><?= htmlspecialchars($row['requested_meters']) ?></td>
                            <td><?= htmlspecialchars($row['motive']) ?></td>
                            <td><?= htmlspecialchars(date("d-m-Y", strtotime($row['request_date']))) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">Geen resultaten gevonden.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
