<?php
require "db.php";

$id = $_GET['id'];

$stm = $connection->prepare("SELECT * FROM employees WHERE id=?");
$stm->execute([$id]);

$emp = $stm->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4">
        <h2 class="mb-3">Employee Details</h2>

        <table class="table table-bordered">
            <tbody>
                <?php foreach ($emp as $key => $val): ?>
                    <?php if (!is_numeric($key)): ?> 
                    <tr>
                        <th style="width: 180px;"><?= ucfirst($key) ?></th>
                        <td><?= $val ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="list.php" class="btn btn-secondary btn-sm">Back to List</a>
        <a href="edit.php?id=<?= $emp['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
    </div>
</body>
</html>
