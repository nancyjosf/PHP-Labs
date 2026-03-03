<table border="1" cellpadding="5">
<tr>
    <th>First name</th>
    <th>Last name</th>
    <th>Address</th>
    <th>Country</th>
    <th>Gender</th>
    <th>Skills</th>
    <th>Username</th>
    <th>Password</th>
    <th>Department</th>
    <th>Code</th>
    <th>View</th>
    <th>Delete</th>

</tr>

<?php
$result = file("data.txt");

foreach ($result as $index => $row) {

    $row_data = explode(",", $row);
    echo "<tr>";

    foreach ($row_data as $value) {
        echo "<td>$value</td>";
    }

    echo "<td><a href='view.php?id=$index'>View</a></td>";
    echo "<td><a href='delete.php?id=$index'>Delete</a></td>";



    echo "</tr>";
}
?>
</table>