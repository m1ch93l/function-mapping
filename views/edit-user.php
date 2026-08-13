<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a class="navbar-brand" href="index.php">Function Mapping</a>
        </div>
    </nav>

    <div class="container">
        <div class="page-box">
            <div class="form-box">
                <h1>Edit student</h1>
                <form action="crud.php?action=update" method="post">
                    <input type="hidden" name="id" value="<?= (int) $user['id'] ?>">

                    <div class="form-group">
                        <label for="fullname">Full name</label>
                        <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>
                    </div>

                    <div class="inline-actions">
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
