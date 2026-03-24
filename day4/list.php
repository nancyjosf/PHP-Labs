<?php
include "db.php";
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$userName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : $_SESSION['user'];
$result = mysqli_query($connection, "SELECT * FROM users ORDER BY id DESC");
?>
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
            <a href="home.php" class="btn btn-outline-secondary btn-sm">Home</a>
            <a href="register.php" class="btn btn-outline-secondary btn-sm">Register</a>
            <a href="profile.php" class="btn btn-outline-secondary btn-sm">My Profile</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
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
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo (int)$row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['country']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td>
                                <a href="view.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-secondary">View</a>
                                <a href="edit.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="delete.php?delete=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>