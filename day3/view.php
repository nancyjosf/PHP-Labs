<?php
require "db.php";

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger text-center'>Employee ID not provided</div>";
    exit;
}

$id = $_GET['id'];

try {
    $connection = new PDO("mysql:host=localhost;dbname=company", "root", "root");

    $stm = $connection->prepare("SELECT * FROM employees WHERE id=?");
    $stm->execute([$id]);

    $emp = $stm->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger text-center'>" . $e->getMessage() . "</div>";
    exit;
}
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

        <h2 class="mb-3 text-center">Employee Details</h2>

        <?php if ($emp): ?>
            <table class="table table-bordered">
                <tbody>
                    <?php foreach ($emp as $key => $val): ?>
                        <tr>
                            <th style="width:200px"><?= $key ?></th>
                            <td><?= $val ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="text-center mt-3">
                <a href="list.php" class="btn btn-secondary btn-sm">Back to List</a>
                <a href="edit.php?id=<?= $emp['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
            </div>
        <?php else: ?>
            <div class="alert alert-danger text-center">
                Employee Not Found
            </div>
        <?php endif; ?>

    </div>
</body>

</html>