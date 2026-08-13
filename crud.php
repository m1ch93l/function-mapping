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

    $stmt = $conn->prepare('INSERT INTO user (fullname) VALUES (?)');
    $stmt->bind_param('s', $fullname);
    $stmt->execute();
    $stmt->close();

    header('Location: index.php');
    exit;
}

// READ: get all students so we can show them on the page.
function readUser($conn)
{
    $result = $conn->query('SELECT * FROM user ORDER BY id ASC');
    $users = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

    require_once __DIR__ . '/views/read-user.php';
    return $users;
}

// EDIT: get one student by id so we can show the old value before updating.
function editUser($conn)
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id <= 0) {
        header('Location: index.php');
        exit;
    }

    $stmt = $conn->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (!$user) {
        header('Location: index.php');
        exit;
    }

    require_once __DIR__ . '/views/edit-user.php';
    return $user;
}

// getUser: return one student as JSON for the modal form.
function getUser($conn)
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id <= 0) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Invalid student ID.']);
        exit;
    }

    $stmt = $conn->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    header('Content-Type: application/json');

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Student not found.']);
        exit;
    }

    echo json_encode(['success' => true, 'user' => $user]);
    exit;
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

    $stmt = $conn->prepare('UPDATE user SET fullname = ? WHERE id = ?');
    $stmt->bind_param('si', $fullname, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: index.php');
    exit;
}

// DELETE: remove a student from the database.
function deleteUser($conn)
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id > 0) {
        $stmt = $conn->prepare('DELETE FROM user WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: index.php');
    exit;
}

// This is the core idea of function mapping.
// The action from the URL/form tells us which function to call.
$actions = [
    'create'   => 'createUser',
    'read'     => 'readUser',
    'edit'     => 'editUser',
    'getUser'  => 'getUser',
    'update'   => 'updateUser',
    'delete'   => 'deleteUser',
];

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$action = htmlspecialchars($action, ENT_QUOTES, 'UTF-8');

if (array_key_exists($action, $actions)) {
    $functionName = $actions[$action];

    if (function_exists($functionName)) {
        $functionName($conn);
        exit;
    }
}

header('Location: index.php');
exit;
