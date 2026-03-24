<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4" style="max-width: 700px;">
        <h2 class="mb-3">Edit User</h2>
        <form action="index.php?action=updateUser" method="POST">
            <input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">

            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="fname" value="<?php echo htmlspecialchars($row['first_name']); ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lname" value="<?php echo htmlspecialchars($row['last_name']); ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="text" name="country" value="<?php echo htmlspecialchars($row['country']); ?>" class="form-control">
            </div>

            <div class="d-flex gap-2">
                <input type="submit" value="Update" class="btn btn-primary">
                <a href="index.php?action=list" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>