<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "volkstuinen";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $reason = $_POST['reason'];
    $parcel = $_POST['parcel'];
    $metres = $_POST['M2'];

    // Check available meters from the 'parcel_free' table
    $checkSql = "SELECT `Size` FROM parcel_free WHERE Complex = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("s", $parcel);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $available = $row['Size'];

        if ($available >= $metres) {
            // ✅ Enough meters available — insert into 'parcel-requests' table
            $insertSql = "INSERT INTO `parcel-requests` (Motive, Parcel, M2) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insertSql);
            $stmt->bind_param("ssi", $reason, $parcel, $metres);
            $stmt->execute();

            // Update available meters in 'parcel_free'
            $newAvailable = $available - $metres;
            $updateSql = "UPDATE parcel_free SET `Size` = ? WHERE Complex = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("is", $newAvailable, $parcel);
            $stmt->execute();

            echo "<p>Uw aanvraag voor $metres m² is succesvol verstuurd.</p>";
        } else {
            // ❌ Not enough meters — insert into 'waiting_list' table
            $waitSql = "INSERT INTO waiting_list (Parcel, requested_meters, Motive) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($waitSql);
            $stmt->bind_param("sis", $parcel, $metres, $reason);
            $stmt->execute();

            echo "<p>Niet genoeg ruimte op dit perceel. U bent op de wachtlijst geplaatst.</p>";
        }
    } else {
        echo "<p>Perceel niet gevonden.</p>";
    }

    $stmt->close();
    $conn->close();

    // Redirect to thank you page
    header("Location: http://localhost/volkstuinen/Frontend/Formulier/Bedankt.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grond Aanvragen - Volkstuin Vereniging Sittard</title>
  <link rel="stylesheet" href="aanvraag-parceel.css">
</head>
<body>
  
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
      <a href="../../Frontend/logout.php">
        <div class="icon3">
          <img src="../Gedeeld/pictures/ExitMenuButton.svg" alt="Uitloggen">
        </div>
      </a>
    </div>
  </div>

  <div class="header">VOLKSTUIN VERENIGING SITTARD</div>

  <div class="content">
    <h1>Grond aanvragen</h1>
    <div class="form-container">
      <form action="" method="POST">
        <label for="parcel">Parceel:</label>
        <select id="parcel" name="parcel" required>
          <option value="" disabled selected>Selecteer een Perceel</option>
          <?php
            // Connect to the database
            $conn = new mysqli("localhost", "root", "", "volkstuinen");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch Complex data from 'parcel_free' table
            $sql = "SELECT * FROM parcel_free";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['Complex'] . '">' . $row['Complex'] . '</option>';
                }
            } else {
                echo '<option value="">Geen beschikbare percelen</option>';
            }

            $conn->close();
          ?>
        </select>

        <label for="M2">Aantal meters (meter(s)):</label>
        <input type="number" id="M2" name="M2" min="1" required>

        <label for="reason">Reden voor aanvraag:</label>
        <textarea id="reason" name="reason" rows="4" placeholder="Beschrijf uw reden voor deze aanvraag" required></textarea>

        <button type="submit">Verstuur aanvraag</button>
      </form>
    </div>
  </div>
</body>
</html>