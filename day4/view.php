<?php
include "db.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($connection, "SELECT * FROM users WHERE id=$id");
$row = mysqli_fetch_assoc($result);
$userName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4" style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">User Details</h2>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td><?php echo (int)$row['id']; ?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
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
        </table>

        <a href="list.php" class="btn btn-secondary btn-sm">Back</a>
        <a href="edit.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
    </div>
</body>

</html>