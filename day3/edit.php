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
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4" style="max-width: 700px;">
        <h2 class="mb-4">Edit Employee</h2>

        <form method="post" action="EmployeeController.php">

            <input type="hidden" name="id" value="<?= $emp['id'] ?>">

            <div class="mb-3">
                <label class="form-label">First name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($emp['name']) ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Last name</label>
                <input type="text" name="lastname" value="<?= htmlspecialchars($emp['lastname']) ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control"><?= htmlspecialchars($emp['address']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Country</label>
                <select name="country" class="form-select">
                    <option value="Egypt" <?= $emp['country'] == "Egypt" ? "selected" : "" ?>>Egypt</option>
                    <option value="Saudi" <?= $emp['country'] == "Saudi" ? "selected" : "" ?>>Saudi</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Gender</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="male" id="editMale" <?= $emp['gender'] == "male" ? "checked" : "" ?>>
                    <label class="form-check-label" for="editMale">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="female" id="editFemale" <?= $emp['gender'] == "female" ? "checked" : "" ?>>
                    <label class="form-check-label" for="editFemale">Female</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Skills</label>
                <input type="text" name="skills" value="<?= htmlspecialchars($emp['skills']) ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($emp['username']) ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" name="password" value="<?= htmlspecialchars($emp['password']) ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Department</label>
                <input type="text" name="department" value="<?= htmlspecialchars($emp['department']) ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Captcha</label>
                <input type="text" name="captcha" value="<?= htmlspecialchars($emp['captcha']) ?>" class="form-control">
            </div>

            <div class="d-flex gap-2">
                <input type="submit" name="update" value="Update" class="btn btn-primary">
                <a href="list.php" class="btn btn-secondary">Cancel</a>
            </div>

        </form>
    </div>
</body>

</html>