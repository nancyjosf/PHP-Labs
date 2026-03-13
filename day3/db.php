<?php
    $connection = new mysqli("localhost", "root", "root", "company");
if ( $connection ->connect_errno) {
    echo "Failed to connect";
}
?>