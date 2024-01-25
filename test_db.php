<?php
// test_db.php
require_once 'config/app.php';

$db = \Config\Database::connect();

if ($db) {
    echo "Connection successful!";
} else {
    echo "Connection failed!";
}
