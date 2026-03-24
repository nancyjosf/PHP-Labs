<?php
$error = isset($error) ? $error : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4" style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Login</h2>
        </div>

        <?php if ($error !== ''): ?>
            <div class="alert alert-danger">Invalid email or password.</div>
        <?php endif; ?>

        <form action="index.php?action=loginStore" method="post">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" maxlength="8" required>
                <div class="form-text">Use the same 8-char password you used in register.</div>
            </div>

            <div class="d-flex gap-2">
                <input type="submit" value="Login" class="btn btn-primary">
                <a href="index.php?action=register" class="btn btn-secondary">Register</a>
            </div>
        </form>
    </div>

    <script>
        var loginPassword = document.getElementById('password');
        if (loginPassword) {
            loginPassword.addEventListener('input', function() {
                loginPassword.value = loginPassword.value.toLowerCase().replace(/[^a-z0-9_]/g, '').slice(0, 8);
            });
        }
    </script>
</body>

</html>