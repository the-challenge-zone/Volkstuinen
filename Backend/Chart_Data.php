<?php
require_once __DIR__ . "/DatabaseContext/Database.php";
header('Content-Type: application/json');

try {
    $conn = Database::GetConnection();

    $query = "SELECT Complex, SUM(Size) AS TotalSize FROM parcel_free GROUP BY Complex";
    $stmt = $conn->query($query);

    $chartData = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $chartData[$row['Complex']] = (int)$row['TotalSize'];
    }

    echo json_encode($chartData);
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
    echo json_encode(['error' => 'Failed to load complex data.']);
}
