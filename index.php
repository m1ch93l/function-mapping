<?php
require_once __DIR__ . '/config/database.php';

// First, read all students from the database.
// Then we display them in a table on this page.
$result = $conn->query('SELECT * FROM user ORDER BY id ASC');
$users = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Mapping</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a class="navbar-brand" href="index.php">Function Mapping</a>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="page-title">Student Friendly CRUD Demo</h1>
        <p class="subtitle">This project shows how a function can be mapped to an action in PHP.</p>

        <div class="card">
            <div class="card-body">
                <h2>Add a student</h2>
                <form action="crud.php?action=create" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fullname">Full name</label>
                            <input type="text" name="fullname" id="fullname" placeholder="Enter student name" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Student</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h2>Student list</h2>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full name</th>
                            <th class="table-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="3" class="empty-row">No students found yet.</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars((string) $user['id']) ?></td>
                            <td><?= htmlspecialchars($user['fullname']) ?></td>
                            <td class="table-actions">
                                <button type="button" class="btn btn-warning edit-btn" data-id="<?= (int) $user['id'] ?>">Edit</button>
                                <a href="crud.php?action=delete&id=<?= (int) $user['id'] ?>" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="editModalTitle">Edit student</h3>
                    <button type="button" class="close-btn" data-close-modal="true" aria-label="Close modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form action="crud.php?action=update" method="post">
                        <input type="hidden" name="id" id="edit-id">

                        <div class="form-group">
                            <label for="edit-fullname">Full name</label>
                            <input type="text" name="fullname" id="edit-fullname" required>
                        </div>

                        <div class="inline-actions">
                            <button type="button" class="btn btn-secondary" data-close-modal="true">Cancel</button>
                            <button type="submit" class="btn btn-success">Update Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('editModal');
            const studentIdInput = document.getElementById('edit-id');
            const studentNameInput = document.getElementById('edit-fullname');

            document.querySelectorAll('.edit-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    const studentId = this.dataset.id;

                    fetch('crud.php?action=getUser&id=' + encodeURIComponent(studentId))
                        .then(function (response) {
                            if (!response.ok) {
                                throw new Error('Request failed');
                            }
                            return response.json();
                        })
                        .then(function (data) {
                            if (!data.success) {
                                alert(data.message || 'Student not found.');
                                return;
                            }

                            studentIdInput.value = data.user.id;
                            studentNameInput.value = data.user.fullname;
                            modal.classList.add('show');
                        })
                        .catch(function () {
                            alert('Unable to load student data.');
                        });
                });
            });

            document.querySelectorAll('[data-close-modal="true"]').forEach(function (button) {
                button.addEventListener('click', function () {
                    modal.classList.remove('show');
                });
            });

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.remove('show');
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    modal.classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>