<?php
session_start();
include '..\..\Backend\DatabaseContext\Database.php';

// Check for login session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'] ?? null; // Avoid undefined index warning

// Get PDO connection
$conn = Database::GetConnection();

// Haal gebruikersgegevens op met prepared statement (veilig tegen SQL injection)
$sql = "SELECT u.email, u.Usertype, l.naam 
        FROM users u 
        LEFT JOIN leden l ON u.id = l.user_id 
        WHERE u.id = :user_id";

$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch();

// Fallback to email if naam is not set
$naam = htmlspecialchars($user['naam'] ?? $user['email']);
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    
    <meta charset="UTF-8">
    <title>Dashboard - VTV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #2e2e2e; color: white; margin: 0; }
        .header { background-color: #7cb342; padding: 20px; text-align: center; font-size: 24px; font-weight: bold; }
        .container { display: flex; height: 100vh; }
        .menu {
            width: 220px;
            background-color: #3e3e3e;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .menu a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
            background-color: #7cb342;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s, transform 0.2s;
        }
        .menu a i { margin-right: 8px; }
        .menu a:hover {
            background-color: #689f38;
            transform: scale(1.05);
        }
        .content { flex-grow: 1; padding: 30px; overflow-y: auto; }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <?php var_dump($role); ?>
    <div class="header">VOLKSTUIN VERENIGING SITTARD</div>
    <div class="container">
        <div class="menu">
            <h4 style="color: #fff; text-align:center;">Menu</h4>
            <?php if ($role == 'admin' || $role == 'beheerder') { ?>
                <a href="aanvragenbeheer.php"><i class="fas fa-file-alt"></i> Aanvragenbeheer</a>
                <a href="ledenbeheer.php"><i class="fas fa-users"></i> Ledenbeheer</a>
                <a href="pending_wijzigingen_beheer.php"><i class="fas fa-user-edit"></i> Beheer Wijzigingen</a>
                <a href="mededelingen_beheer.php"><i class="fas fa-bullhorn"></i> Mededeling Toevoegen</a>
            <?php } ?><?php if ($role == 'deelnemer') { ?>
                <a href="aanvragen.php"><i class="fas fa-plus-circle"></i> Aanvraag Volkstuin</a>
                <a href="persoonsgegevens.php"><i class="fas fa-user"></i> Mijn Persoonsgegevens</a>
                <a href="dashboard_deelnemer.php"><i class="fas fa-info-circle"></i> Mijn Aanvraag Status</a>
            <?php } ?>

            <a href="logout.php" style="background-color: #d32f2f;"><i class="fas fa-sign-out-alt"></i> Uitloggen</a>
        </div>
        <div class="content">
            <h2>Welkom terug, <?php echo $naam; ?> 👋</h2>
            <p>Je bent ingelogd als: <strong><?php echo ucfirst($role); ?></strong></p>
            <p>Selecteer een menuoptie aan de linkerkant om verder te gaan.</p>

            <?php if (in_array($role, ['admin', 'beheerder', 'bestuurder'])) { ?>
                <a href="mijn_gebruikersgegevens.php" class="btn btn-warning mt-3">
                    <i class="fas fa-user-cog"></i> Mijn Gegevens Aanpassen
                </a>
            <?php } ?>

            <hr class="my-4">

            <?php
            $result = $conn->query("SELECT * FROM mededelingen ORDER BY datum DESC LIMIT 5");
            if ($result->num_rows > 0): ?>
                <h4>📢 Mededelingen</h4>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div style="background:#444; padding:15px; margin-bottom:15px; border-left: 5px solid #7cb342; border-radius:8px;">
                        <strong style="font-size: 18px;"><?php echo htmlspecialchars($row['titel']); ?></strong><br>
                        <small class="text-muted"><?php echo date("d-m-Y H:i", strtotime($row['datum'])); ?></small>
                        <p class="mt-2 mb-0"><?php echo nl2br(htmlspecialchars($row['inhoud'])); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="text-align:center; margin-top:40px;">
                    <div style="font-size:50px; animation:bounce 1s infinite;">📭</div>
                    <p style="color: #aaa; font-size: 18px; margin-top: 10px;">
                        Er zijn momenteel geen mededelingen.
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>