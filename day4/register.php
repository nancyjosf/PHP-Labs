<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old = isset($_SESSION['old']) ? $_SESSION['old'] : [];
$userName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';
unset($_SESSION['errors'], $_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Form Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4" style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">PHP Form Test</h2>
        </div>

        <div class="mb-3 d-flex flex-wrap gap-2">
            <a href="home.php" class="btn btn-outline-secondary btn-sm">Home</a>
            <a href="login.php" class="btn btn-outline-secondary btn-sm">Login</a>
            <a href="list.php" class="btn btn-outline-secondary btn-sm">Users</a>
            <a href="profile.php" class="btn btn-outline-secondary btn-sm">My Profile</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>

        <form id="registerForm" method="post" action="UserController.php" enctype="multipart/form-data" novalidate>
            <div class="mb-3">
                <label class="form-label">First name:</label>
                <input type="text" id="first_name" name="fname" class="form-control" value="<?php echo isset($old['fname']) ? htmlspecialchars($old['fname']) : ''; ?>">
                <div class="text-danger small mt-1" id="first_name_error"><?php echo isset($errors['fname']) ? htmlspecialchars($errors['fname']) : ''; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Last name:</label>
                <input type="text" id="last_name" name="lname" class="form-control" value="<?php echo isset($old['lname']) ? htmlspecialchars($old['lname']) : ''; ?>">
                <div class="text-danger small mt-1" id="last_name_error"><?php echo isset($errors['lname']) ? htmlspecialchars($errors['lname']) : ''; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Address:</label>
                <textarea id="address" name="addr" rows="4" class="form-control"><?php echo isset($old['addr']) ? htmlspecialchars($old['addr']) : ''; ?></textarea>
                <div class="text-danger small mt-1" id="address_error"><?php echo isset($errors['addr']) ? htmlspecialchars($errors['addr']) : ''; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Country:</label>
                <select id="country" name="country" class="form-select">
                    <option value="">Select Country</option>
                    <option value="Egypt" <?php echo (isset($old['country']) && $old['country'] === 'Egypt') ? 'selected' : ''; ?>>Egypt</option>
                    <option value="Saudi" <?php echo (isset($old['country']) && $old['country'] === 'Saudi') ? 'selected' : ''; ?>>Saudi Arabia</option>
                    <option value="USA" <?php echo (isset($old['country']) && $old['country'] === 'USA') ? 'selected' : ''; ?>>USA</option>
                </select>
                <div class="text-danger small mt-1" id="country_error"><?php echo isset($errors['country']) ? htmlspecialchars($errors['country']) : ''; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Gender:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="male" id="genderMale" <?php echo (isset($old['gender']) && $old['gender'] === 'male') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="genderMale">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="female" id="genderFemale" <?php echo (isset($old['gender']) && $old['gender'] === 'female') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="genderFemale">Female</label>
                </div>
                <div class="text-danger small mt-1" id="gender_error"><?php echo isset($errors['gender']) ? htmlspecialchars($errors['gender']) : ''; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Skills:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="skills[]" value="PHP" id="skillPhp" <?php echo (isset($old['skills']) && in_array('PHP', $old['skills'])) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="skillPhp">PHP</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="skills[]" value="J2SE" id="skillJ2se" <?php echo (isset($old['skills']) && in_array('J2SE', $old['skills'])) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="skillJ2se">J2SE</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="skills[]" value="MySQL" id="skillMysql" <?php echo (isset($old['skills']) && in_array('MySQL', $old['skills'])) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="skillMysql">MySQL</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="skills[]" value="PostgreSQL" id="skillPg" <?php echo (isset($old['skills']) && in_array('PostgreSQL', $old['skills'])) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="skillPg">PostgreSQL</label>
                </div>
                <div class="text-danger small mt-1" id="skills_error"><?php echo isset($errors['skills']) ? htmlspecialchars($errors['skills']) : ''; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo isset($old['username']) ? htmlspecialchars($old['username']) : ''; ?>">
                <div class="text-danger small mt-1" id="username_error"><?php echo isset($errors['username']) ? htmlspecialchars($errors['username']) : ''; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input type="password" id="password" name="pass" class="form-control" maxlength="8">
                <div class="form-text">Exactly 8 chars: lowercase letters, numbers, underscore only.</div>
                <div class="text-danger small mt-1" id="password_error"><?php echo isset($errors['pass']) ? htmlspecialchars($errors['pass']) : ''; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Department:</label>
                <input type="text" id="dep" name="dep" class="form-control" value="<?php echo isset($old['dep']) ? htmlspecialchars($old['dep']) : 'OpenSource'; ?>">
                <div class="text-danger small mt-1" id="dep_error"><?php echo isset($errors['dep']) ? htmlspecialchars($errors['dep']) : ''; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($old['email']) ? htmlspecialchars($old['email']) : ''; ?>">
                <div class="text-danger small mt-1" id="email_error"><?php echo isset($errors['email']) ? htmlspecialchars($errors['email']) : ''; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Profile Picture (JPG/PNG, max 2MB):</label>
                <input type="file" id="profile_picture" name="profile" class="form-control" accept="image/jpeg,image/png">
                <div class="text-danger small mt-1" id="profile_picture_error"><?php echo isset($errors['profile']) ? htmlspecialchars($errors['profile']) : ''; ?></div>
            </div>

            <div class="d-flex gap-2">
                <input type="submit" name="register" value="Submit" class="btn btn-primary">
                <input type="reset" value="Reset" class="btn btn-secondary">
                <a href="login.php" class="btn btn-outline-dark">Login</a>
            </div>
        </form>
    </div>

    <script>
        var form = document.getElementById('registerForm');
        var passwordInput = document.getElementById('password');
        var maxFileSize = 2 * 1024 * 1024;

        passwordInput.addEventListener('input', function() {
            passwordInput.value = passwordInput.value.toLowerCase().replace(/[^a-z0-9_]/g, '').slice(0, 8);
        });

        form.addEventListener('submit', function(event) {
            document.getElementById('first_name_error').textContent = '';
            document.getElementById('last_name_error').textContent = '';
            document.getElementById('address_error').textContent = '';
            document.getElementById('country_error').textContent = '';
            document.getElementById('gender_error').textContent = '';
            document.getElementById('skills_error').textContent = '';
            document.getElementById('username_error').textContent = '';
            document.getElementById('password_error').textContent = '';
            document.getElementById('dep_error').textContent = '';
            document.getElementById('email_error').textContent = '';
            document.getElementById('profile_picture_error').textContent = '';

            var hasError = false;
            var firstName = document.getElementById('first_name').value.trim();
            var lastName = document.getElementById('last_name').value.trim();
            var address = document.getElementById('address').value.trim();
            var country = document.getElementById('country').value;
            var gender = form.querySelector('input[name="gender"]:checked');
            var skills = form.querySelectorAll('input[name="skills[]"]:checked');
            var username = document.getElementById('username').value.trim();
            var password = document.getElementById('password').value.trim();
            var dep = document.getElementById('dep').value.trim();
            var email = document.getElementById('email').value.trim();
            var fileInput = document.getElementById('profile_picture');

            if (firstName === '') {
                document.getElementById('first_name_error').textContent = 'First name is required.';
                hasError = true;
            } else if (/\d/.test(firstName)) {
                document.getElementById('first_name_error').textContent = 'First name must not contain numbers.';
                hasError = true;
            }

            if (lastName === '') {
                document.getElementById('last_name_error').textContent = 'Last name is required.';
                hasError = true;
            } else if (/\d/.test(lastName)) {
                document.getElementById('last_name_error').textContent = 'Last name must not contain numbers.';
                hasError = true;
            }

            if (address === '') {
                document.getElementById('address_error').textContent = 'Address is required.';
                hasError = true;
            }

            if (country === '') {
                document.getElementById('country_error').textContent = 'Country is required.';
                hasError = true;
            }

            if (!gender) {
                document.getElementById('gender_error').textContent = 'Gender is required.';
                hasError = true;
            }

            if (skills.length === 0) {
                document.getElementById('skills_error').textContent = 'Please select at least one skill.';
                hasError = true;
            }

            if (username === '') {
                document.getElementById('username_error').textContent = 'Username is required.';
                hasError = true;
            }

            if (password === '') {
                document.getElementById('password_error').textContent = 'Password is required.';
                hasError = true;
            } else if (!/^[a-z0-9_]{8}$/.test(password)) {
                document.getElementById('password_error').textContent = 'Password must be exactly 8 chars, lowercase letters/numbers, underscore only.';
                hasError = true;
            }

            if (dep === '') {
                document.getElementById('dep_error').textContent = 'Department is required.';
                hasError = true;
            }

            if (email === '') {
                document.getElementById('email_error').textContent = 'Email is required.';
                hasError = true;
            }

            if (!fileInput.files || fileInput.files.length === 0) {
                document.getElementById('profile_picture_error').textContent = 'Profile picture is required.';
                hasError = true;
            } else {
                var file = fileInput.files[0];
                if (['image/jpeg', 'image/png'].indexOf(file.type) === -1) {
                    document.getElementById('profile_picture_error').textContent = 'Only JPG and PNG files are allowed.';
                    hasError = true;
                }
                if (file.size > maxFileSize) {
                    document.getElementById('profile_picture_error').textContent = 'File size must be 2MB or less.';
                    hasError = true;
                }
            }

            if (hasError) {
                event.preventDefault();
            }
        });
    </script>
</body>

</html>