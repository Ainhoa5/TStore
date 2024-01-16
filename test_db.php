<?php
// test_db.php
require_once 'config/app.php';

$db = Database::connect();

if ($db) {
    echo "Connection successful!";
} else {
    echo "Connection failed!";
}
