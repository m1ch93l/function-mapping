<form hx-post="crud.php?action=update">
    <div class="input-group input-group-sm">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <input type="text" class="form-control" name="fullname" value="<?= $user['fullname'] ?>">
    </div>
    <button class="btn btn-sm btn-danger mt-2" data-bs-dismiss="modal">Close</button>
</form>