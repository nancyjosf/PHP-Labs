<?php
// Redirect /views/index.php to the real front controller to keep URL base correct.
$query = isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== ''
    ? ('?' . $_SERVER['QUERY_STRING'])
    : '';

header('Location: ../index.php' . $query);
exit;
