<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-success px-4 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Function Mapping</a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="card shadow-sm mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <h1 class="h4 mb-3">Edit student</h1>
                <form action="crud.php?action=update" method="post">
                    <input type="hidden" name="id" value="<?= (int) $user['id'] ?>">

                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full name</label>
                        <input type="text" id="fullname" name="fullname" class="form-control" value="<?= htmlspecialchars($user['fullname']) ?>" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
