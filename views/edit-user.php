<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <nav>
        <a href="index.php">Back to Home</a>
    </nav>

    <form action="crud.php?action=update" method="post">
        <input type="hidden" name="id" value="<?= (int) $user['id'] ?>">

        <label for="fullname">Full name</label>
        <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>
        <br><br>

        <button type="submit">Update Student</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
