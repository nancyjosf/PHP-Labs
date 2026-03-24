<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4" style="max-width: 700px;">
        <h2 class="mb-3">Home</h2>
        <div class="alert alert-info">Welcome, <strong><?php echo htmlspecialchars($userName); ?></strong></div>
        <div class="d-flex flex-wrap gap-2">
            <a href="index.php?action=register" class="btn btn-outline-primary btn-sm">Register</a>
            <a href="index.php?action=list" class="btn btn-outline-secondary btn-sm">Users List</a>
            <a href="index.php?action=profile" class="btn btn-outline-success btn-sm">My Profile</a>
            <a href="index.php?action=logout" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </div>
</body>

</html>