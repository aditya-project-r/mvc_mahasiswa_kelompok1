<?php
require_once '../config/database.php';

echo "<h1>Test Koneksi Database</h1>";

try {
    $conn = getConnection();
    if ($conn) {
        echo "<p style='color: green;'>✓ Koneksi berhasil!</p>";
        echo "<p>Database: " . $conn->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "</p>";
        
        // Test query
        $stmt = $conn->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        echo "<h2>Daftar Tabel:</h2>";
        if (count($tables) > 0) {
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li>$table</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Belum ada tabel. Silahkan import SQL di atas.</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ Koneksi gagal!</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}
?>