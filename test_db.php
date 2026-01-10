<?php
// Load your existing Database class
require_once 'db_connect.php';

echo "<h1>44:11 // MAINFRAME CONNECTION TEST</h1>";

try {
    $db = new Database();
    $conn = $db->connect();

    if ($conn instanceof PDO) {
        echo "<p style='color: green; font-weight: bold;'>[SUCCESS] Mainframe Linked: Connection to 'vivi_prime' established.</p>";
        
        // Internal Stress-Test: Check if the 'products' table exists
        $testQuery = $conn->query("SHOW TABLES LIKE 'products'");
        if ($testQuery->rowCount() > 0) {
            echo "<p style='color: green;'>[SYNC] Products table detected. Data flow is active.</p>";
        } else {
            echo "<p style='color: orange;'>[WARNING] Connection successful, but 'products' table is missing from 'vivi_prime'.</p>";
        }
    } else {
        echo "<p style='color: red;'>[FAILURE] Connection failed: Object is not a valid PDO instance.</p>";
    }

} catch (Exception $e) {
    echo "<p style='color: red; font-weight: bold;'>[CRITICAL ERROR] Connection Blocked: " . $e->getMessage() . "</p>";
}
?>