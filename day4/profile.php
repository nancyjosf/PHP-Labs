<?php
include "db.php";
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$username = mysqli_real_escape_string($connection, $_SESSION['user']);
$result = mysqli_query($connection, "SELECT * FROM users WHERE username='$username' LIMIT 1");
$row = $result ? mysqli_fetch_assoc($result) : null;

if (!$row) {
    header('Location: login.php?error=1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4" style="max-width: 850px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">My Profile</h2>
        </div>

        <div class="mb-3 d-flex gap-2">
            <a href="home.php" class="btn btn-outline-secondary btn-sm">Home</a>
            <a href="list.php" class="btn btn-outline-secondary btn-sm">Users</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>

        <?php if (!empty($row['profile_picture']) && file_exists(__DIR__ . '/' . $row['profile_picture'])): ?>
            <div class="mb-3">
                <img src="<?php echo htmlspecialchars($row['profile_picture']); ?>" alt="Profile Picture" width="180" class="rounded border">
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <tr>
                <th>First Name</th>
                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo htmlspecialchars($row['address']); ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo htmlspecialchars($row['country']); ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo htmlspecialchars($row['gender']); ?></td>
            </tr>
            <tr>
                <th>Skills</th>
                <td><?php echo htmlspecialchars($row['skills']); ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
            </tr>
        </table>

        <a href="edit.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
    </div>
</body>

</html>