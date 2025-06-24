<?php
require_once __DIR__ . "/../../Backend/SessionChecker.php";
require_once __DIR__ . "/../../Backend/DatabaseContext/Database.php";
checkSession($allowedUserTypes = [3]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Volkstuin Vereniging Sittard - Complexen</title>
  <link rel="stylesheet" href="CSS-Bestuurder/Leden-beheer.css">
</head>
<body>

<!-- Sidebar -->
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
                <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="Gebruiker Info">
            </div>
        </a>
        <a href="../../Backend/logout.php">
            <div class="icon2">
                <img src="../Gedeeld/pictures/ExitMenuButton.svg" alt="Uitloggen">
            </div>
        </a>
    </div>
</div>

<!-- Header -->
<div class="header">
  VOLKSTUIN VERENIGING SITTARD
</div>

<!-- Main container -->
<div class="main-container">
  <h2>Complexen Beheer</h2>
  <div class="leden-beheer-table">
    <table id="complexenTable">
      <thead>
        <tr>
          <th>Complex</th>
          <th>m²</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $conn = Database::GetConnection();

        // Group by complex and sum m²
        $query = "SELECT Complex, SUM(Size) AS TotalSize FROM parcel_free GROUP BY Complex";
        $stmt = $conn->query($query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['Complex']) . "</td>
                    <td>" . htmlspecialchars($row['TotalSize']) . " m²</td>
                  </tr>";
        }

        $conn = null;
        ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
