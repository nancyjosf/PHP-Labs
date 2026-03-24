<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Users List</h2>
        </div>

        <div class="mb-3 d-flex gap-2">
            <a href="index.php?action=home" class="btn btn-outline-secondary btn-sm">Home</a>
            <a href="index.php?action=register" class="btn btn-outline-secondary btn-sm">Register</a>
            <a href="index.php?action=profile" class="btn btn-outline-secondary btn-sm">My Profile</a>
            <a href="index.php?action=logout" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Country</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $row): ?>
                        <tr>
                            <td><?php echo (int)$row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['country']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td>
                                <a href="index.php?action=view&id=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-secondary">View</a>
                                <a href="index.php?action=edit&id=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="index.php?action=deleteUser&delete=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>