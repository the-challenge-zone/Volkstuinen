<?php
session_start(); // Make sure session is started
require_once "../../Backend/DatabaseContext/Database.php"; // Include the database connection class

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo = Database::GetConnection();

    $user_id = $_SESSION['user_id'] ?? null;
    $complex_id = $_POST['complex_id'] ?? null;
    $tweede_keuze_id = $_POST['tweede_keuze_id'] ?? null;
    $motivatie = $_POST['motivatie'] ?? '';
    $datum = date("Y-m-d H:i:s");

    if (!$user_id || !$complex_id) {
        echo "<div style='text-align: center; color: red;'>Gebruiker of complex niet gespecificeerd.</div>";
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            INSERT INTO aanvragen (user_id, complex_id, tweede_keuze_id, datum, opmerking)
            VALUES (:user_id, :complex_id, :tweede_keuze_id, :datum, :opmerking)
        ");

        $stmt->execute([
            ':user_id' => $user_id,
            ':complex_id' => $complex_id,
            ':tweede_keuze_id' => $tweede_keuze_id ?: null,
            ':datum' => $datum,
            ':opmerking' => $motivatie
        ]);

        $success = true;
    } catch (PDOException $e) {
        echo "<div style='text-align: center; color: red;'>Fout bij toevoegen: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}

// Voor het laden van complexen
try {
    $pdo = Database::GetConnection();
    $complexen = $pdo->query("SELECT id, name FROM complexes")->fetchAll();
} catch (PDOException $e) {
    echo "<div style='text-align: center; color: red;'>Fout bij ophalen van complexen: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Aanvraag Volkstuin - VTV</title>
</head>

<div class="header">VOLKSTUIN VERENIGING SITTARD</div>
    <div class="form-container">
        <div class="form-box">
            <h3>Aanvraagformulier Volkstuin</h3>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Voorkeurscomplex *</label>
                    <select name="complex_id" class="form-control" required>
                        <option value="">-- Kies een complex --</option>
                        <?php while ($row = $complexen->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['naam']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tweede keuze complex (optioneel)</label>
                    <select name="tweede_keuze_id" class="form-control">
                        <option value="">-- Kies een tweede complex --</option>
                        <?php
                        $complexen->data_seek(0);
                        while ($row = $complexen->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['naam']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Motivatie</label>
                    <textarea name="motivatie" class="form-control" rows="4" placeholder="Waarom wilt u een volkstuin?"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Verzend aanvraag</button>
            </form>
            <a href="dashboard.php" class="terug-btn">← Terug naar Dashboard</a>
        </div>
    </div>
