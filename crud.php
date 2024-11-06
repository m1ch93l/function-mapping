<?php

require_once __DIR__ . "/db/database.php";

// Define CRUD functions
function createUser($conn)
{
    $sql  = "INSERT INTO user (fullname) VALUES (:fullname)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fullname', $_POST['fullname']);
    $stmt->execute();
}
function readUser($conn)
{
    $sql  = "SELECT * FROM user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) : ?>
        <tr>
            <td><?= htmlspecialchars($user['fullname']) ?>
                <button hx-get="crud.php?action=delete&id=<?= $user['id'] ?>&inline=1">x
                </button>
            </td>
        </tr>
    <?php endforeach;
}
function deleteUser($conn)
{
    $sql  = "DELETE FROM user WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
}

// Mapping actions to functions
$actions = [
    'create' => 'createUser',
    'read'   => 'readUser',
    'delete' => 'deleteUser',
];

// Initialize $action as an empty string by default
$action = '';

// Check the request method and get the appropriate parameter
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
}

// Optionally sanitize the action
$action = htmlspecialchars($action, ENT_QUOTES, 'UTF-8');

// Checks if a function with that name exists
if (array_key_exists($action, $actions)) {
    $function = $actions[$action];
    if (function_exists($function)) {
        $function($conn);
    }
}