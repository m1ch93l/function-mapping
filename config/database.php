<?php

$config = [
    'host'   => 'localhost',
    'user'   => 'root',
    'pass'   => '',
    'dbname' => 'function_mapping',
];

$conn = new mysqli(
    $config['host'],
    $config['user'],
    $config['pass'],
    $config['dbname']
);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');
