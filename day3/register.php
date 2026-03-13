<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP Form Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container py-4" style="max-width: 700px;">
        <h2 class="mb-4">PHP Form Test</h2>

        <form method="post" action="EmployeeController.php">
            <div class="mb-3">
                <label class="form-label">First name:</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Last name:</label>
                <input type="text" name="lastname" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Address:</label>
                <textarea name="address" rows="4" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Country:</label>
                <select name="country" class="form-select">
                    <option value="">Select Country</option>
                    <option value="Egypt">Egypt</option>
                    <option value="Saudi">Saudi Arabia</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Gender:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="male" id="genderMale">
                    <label class="form-check-label" for="genderMale">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="female" id="genderFemale">
                    <label class="form-check-label" for="genderFemale">Female</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Skills:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="skills[]" value="PHP" id="skillPhp">
                    <label class="form-check-label" for="skillPhp">PHP</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="skills[]" value="J2SE" id="skillJ2se">
                    <label class="form-check-label" for="skillJ2se">J2SE</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="skills[]" value="MySQL" id="skillMysql">
                    <label class="form-check-label" for="skillMysql">MySQL</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="skills[]" value="PostgreSQL" id="skillPg">
                    <label class="form-check-label" for="skillPg">PostgreSQL</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Username:</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Department:</label>
                <input type="text" name="department" value="OpenSource" readonly class="form-control">
            </div>

            <div class="mb-3">
                <span class="badge text-bg-secondary fs-6"><?php echo $correct_captcha ?? '12345'; ?></span>
                <div class="form-text">Please insert the code in the box below</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Captcha:</label>
                <input type="text" name="captcha" class="form-control">
            </div>

            <div class="d-flex gap-2">
                <input type="submit" name="register" value="Submit" class="btn btn-primary">
                <input type="reset" value="Reset" class="btn btn-secondary">
            </div>
        </form>
    </div>

</body>

</html>