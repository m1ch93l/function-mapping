<?php

foreach ($users as $user) : ?>
    <tr>
        <td class="text-center"><?= htmlspecialchars($user['fullname']) ?></td>
        <td class="text-center"><!-- e-click para sa lumabas ang modal -->
            <button type="button" hx-get="crud.php?action=edit&id=<?= $user['id'] ?>" hx-target="#modalBody"
                hx-trigger="click" hx-swap="innerHTML" data-bs-toggle="modal" data-bs-target="#showEachCard"
                class="btn btn-sm btn-success">
                Edit
            </button>
            <button class="btn btn-sm btn-danger" hx-get="crud.php?action=delete&id=<?= $user['id'] ?>&inline=1">
                Delete
            </button>
        </td>
    </tr>
<?php endforeach;