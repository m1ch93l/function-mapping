<?php
require_once __DIR__ . '/config/database.php';

// First, read all students from the database.
// Then we display them in a table on this page.
$sql = 'SELECT * FROM user ORDER BY id ASC';
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Mapping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-success px-4 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Function Mapping</a>
            <div>
                <a class="text-white text-decoration-none me-3" href="index.php">Home</a>
                <a class="text-white text-decoration-none me-3" href="about.php">About</a>
                <a class="text-white text-decoration-none" href="contact.php">Contact</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="mb-3">Student Friendly CRUD Demo</h1>
        <p class="text-muted">This project shows how a function can be mapped to an action in PHP.</p>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h5">Add a student</h2>
                <!-- When this form is submitted, it sends action=create to crud.php -->
                <form action="crud.php?action=create" method="post" class="row g-2 align-items-end">
                    <div class="col-md-9">
                        <label for="fullname" class="form-label">Full name</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter student name" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success w-100">Add Student</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5">Student list</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Full name</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($users)): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">No students found yet.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars((string) $user['id']) ?></td>
                                        <td><?= htmlspecialchars($user['fullname']) ?></td>
                                        <td class="text-center">
                                            <a href="crud.php?action=edit&id=<?= (int) $user['id'] ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                                            <a href="crud.php?action=delete&id=<?= (int) $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
