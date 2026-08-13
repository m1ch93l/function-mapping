<?php foreach ($users as $user): ?>
    <tr>
        <td><?= htmlspecialchars($user['fullname']) ?></td>
        <td class="text-center">
            <a href="crud.php?action=edit&id=<?= (int) $user['id'] ?>" class="btn btn-sm btn-warning me-2">Edit</a>
            <a href="crud.php?action=delete&id=<?= (int) $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?');">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>
