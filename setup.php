<?php
// setup.php
require_once 'includes/db.php';

$sql = file_get_contents(__DIR__ . '/sql/schema.sql');

try {
    // For MySQL, we might need to execute statements one by one if the driver doesn't support multi-query
    $pdo->exec($sql);
    echo "<div style='font-family: sans-serif; padding: 20px; background: #d4edda; color: #155724; border-radius: 8px;'>
            <h2>Success!</h2>
            <p>Database tables created and dummy data inserted successfully.</p>
            <a href='index.php' style='display: inline-block; margin-top: 10px; padding: 10px 20px; background: #28a745; color: white; text-decoration: none; border-radius: 4px;'>Go to Homepage</a>
          </div>";
} catch (Exception $e) {
    echo "<div style='font-family: sans-serif; padding: 20px; background: #f8d7da; color: #721c24; border-radius: 8px;'>
            <h2>Setup Failed</h2>
            <p>Error: " . $e->getMessage() . "</p>
            <p>Please check if the database exists and the credentials in <code>includes/db.php</code> are correct.</p>
          </div>";
}
?>
