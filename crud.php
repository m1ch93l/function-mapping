<?php
require_once __DIR__ . '/config/database.php';

// This file is the main controller for the app.
// It receives the action from the browser and calls the matching function.

// CREATE: add a new student to the database.
function createUser($conn)
{
    $fullname = trim($_POST['fullname'] ?? '');

    if ($fullname === '') {
        header('Location: index.php');
        exit;
    }

    $sql = 'INSERT INTO user (fullname) VALUES (:fullname)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->execute();

    header('Location: index.php');
    exit;
}

// READ: get all students so we can show them on the page.
function readUser($conn)
{
    $sql = 'SELECT * FROM user ORDER BY id ASC';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require_once __DIR__ . '/views/read-user.php';
    return $users;
}

// EDIT: get one student by id so we can show the old value before updating.
function editUser($conn)
{
    $id = (int) ($_GET['id'] ?? 0);

    $sql = 'SELECT * FROM user WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header('Location: index.php');
        exit;
    }

    require_once __DIR__ . '/views/edit-user.php';
    return $user;
}

// UPDATE: save the new name for the selected student.
function updateUser($conn)
{
    $id = (int) ($_POST['id'] ?? 0);
    $fullname = trim($_POST['fullname'] ?? '');

    if ($id <= 0 || $fullname === '') {
        header('Location: index.php');
        exit;
    }

    $sql = 'UPDATE user SET fullname = :fullname WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: index.php');
    exit;
}

// DELETE: remove a student from the database.
function deleteUser($conn)
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id > 0) {
        $sql = 'DELETE FROM user WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    header('Location: index.php');
    exit;
}

// This is the core idea of function mapping.
// The action from the URL/form tells us which function to call.
$actions = [
    'create' => 'createUser',
    'read'   => 'readUser',
    'edit'   => 'editUser',
    'update' => 'updateUser',
    'delete' => 'deleteUser',
];

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$action = htmlspecialchars($action, ENT_QUOTES, 'UTF-8');

if (array_key_exists($action, $actions)) {
    $functionName = $actions[$action];

    if (function_exists($functionName)) {
        $functionName($conn);
    }
}

header('Location: index.php');
exit;
