<?php
/* Sets up the connection to the SQLite database. */
function getDBConnection() {
    $db = new PDO('sqlite:tasks.db'); // SQLite database file
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

// Create the table if it doesn't exist
$db = getDBConnection();
$db->exec(file_get_contents('tasks.sql'));
?>