<?php
require "db.php";

$result = $connection->query("SELECT * FROM employees");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employees List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4">
        <h2 class="mb-3 text-center">Employees</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>Gender</th>
                        <th>Skills</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Department</th>
                        <th>Captcha</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['lastname'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td><?= $row['country'] ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= $row['skills'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['password'] ?></td>
                            <td><?= $row['department'] ?></td>
                            <td><?= $row['captcha'] ?></td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-secondary">View</a>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="EmployeeController.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mb-3">
            <a href="register.php" class="btn btn-success">Add Employee</a>
        </div>
    </div>
</body>

</html>