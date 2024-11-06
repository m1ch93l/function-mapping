<?php

$config = [
    'host'   => 'localhost',
    'user'   => 'root',
    'pass'   => '',
    'dbname' => 'function_mapping',
];

$dsn     = "mysql:host={$config['host']};dbname={$config['dbname']}";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $conn = new PDO($dsn, $config['user'], $config['pass'], $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int) $e->getCode());
}