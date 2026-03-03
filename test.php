<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Form Test</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }

        .container {
            width: 450px;
            margin: 40px auto;
            background: #fff;
            padding: 20px 25px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 120px;
            vertical-align: top;
            margin-top: 6px;
        }

        input[type="text"],
        input[type="password"],
        textarea,
        select {
            width: 250px;
            padding: 6px;
            margin-bottom: 12px;
        }

        textarea {
            resize: none;
        }

        .group {
            margin-bottom: 12px;
        }

        .group input {
            width: auto;
            margin-right: 5px;
        }

        .actions {
            text-align: center;
            margin-top: 15px;
        }

        .actions input {
            padding: 6px 15px;
            margin: 0 5px;
            cursor: pointer;
        }

        .captcha-box {
            font-weight: bold;
            background: #eee;
            padding: 5px 10px;
            display: inline-block;
            margin-bottom: 5px;
        }

        p {
            margin: 5px 0 10px 120px;
            font-size: 13px;
            color: #555;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>PHP Form Test</h2>

    <form method="post" action="done.php">
        <label>First name:</label>
        <input type="text" name="name"><br>

        <label>Last name:</label>
        <input type="text" name="lastname"><br>

        <label>Address:</label>
        <textarea name="address" rows="4"></textarea><br>

        <label>Country:</label>
        <select name="country">
            <option value="">Select Country</option>
            <option value="Egypt">Egypt</option>
            <option value="Saudi">Saudi Arabia</option>
        </select><br>

        <div class="group">
            <label>Gender:</label>
            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="female"> Female
        </div>

        <div class="group">
            <label>Skills:</label>
            <input type="checkbox" name="skills[]" value="PHP"> PHP
            <input type="checkbox" name="skills[]" value="J2SE"> J2SE<br>
            <label></label>
            <input type="checkbox" name="skills[]" value="MySQL"> MySQL
            <input type="checkbox" name="skills[]" value="PostgreSQL"> PostgreSQL
        </div>

        <label>Username:</label>
        <input type="text" name="username"><br>

        <label>Password:</label>
        <input type="password" name="password"><br>

        <label>Department:</label>
        <input type="text" name="department" value="OpenSource" readonly><br>

        <label></label>
        <span class="captcha-box"><?php echo $correct_captcha ?? '12345'; ?></span>
        <p>Please insert the code in the box below</p>

        <label></label>
        <input type="text" name="captcha"><br>

        <div class="actions">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>
    </form>
</div>

</body>
</html>