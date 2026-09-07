<?php
    require_once __DIR__ . '/config/database.php';

    $result = $conn->query('SELECT * FROM user ORDER BY id ASC');
    $users  = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Mapping</title>
</head>

<body>
    <h1>Function Mapping</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
    </nav>

    <h2>Add Student</h2>
    <form action="crud.php?action=create" method="post">
        <label for="fullname">Full name</label>
        <input type="text" name="fullname" id="fullname" required>
        <button type="submit">Add Student</button>
    </form>

    <h2>Students</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Full name</th>
            <th>Action</th>
        </tr>

        <?php if (empty($users)): ?>
        <tr>
            <td colspan="3">No students found.</td>
        </tr>
        <?php else: ?>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo (string) $user['id'] ?></td>
            <td><?php echo $user['fullname'] ?></td>
            <td>
                <a href="crud.php?action=edit&id=<?php echo (int) $user['id'] ?>">Edit</a>
                |
                <a href="crud.php?action=delete&id=<?php echo (int) $user['id'] ?>"
                    onclick="return confirm('Delete this student?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>

</html>