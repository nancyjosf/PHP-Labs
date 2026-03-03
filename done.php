<html>

<body>
    <?php
    $gender = $_POST['gender'] ?? '';
    $first_name = $_POST['name'] ?? ($_POST['first_name'] ?? '');
    $last_name = $_POST['lastname'] ?? ($_POST['last_name'] ?? '');

    $title = ($gender == 'male') ? 'Mr.' : 'Miss';

    echo "<h2>Thanks " . htmlspecialchars($title . ' ' . $first_name . ' ' . $last_name) . "</h2>";
    ?>

    <h3>Form Result</h3>

    <?php

    foreach ($_POST as $key => $value) {
        if (
            $key == 'last_name' ||
            $key == 'address'   ||
            $key == 'country'   ||
            $key == 'gender'    ||
            $key == 'skills'    ||
            $key == 'username'  ||
            $key == 'password'  ||
            $key == 'captcha'   ||
            $key == 'submit'
        ) {
            continue;
        }

        if (is_array($value)) {
            echo "<p>$key : $value</p>";
        } else {
            echo "<p>$key : $value</p>";
        }
    }
    ?>
</body>

</html>