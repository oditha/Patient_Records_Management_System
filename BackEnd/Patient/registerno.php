<?php

require_once('../../inc/connection.php');

$regno = $_POST['regno'];


$query = "SELECT * FROM Patient WHERE RegNo = '{$regno}' LIMIT 1 ";

$resultSet = mysqli_query($connection, $query);

if ($resultSet) {
    if (mysqli_num_rows($resultSet) > 0) {
        echo "already";
    }

?>

<?php mysqli_close($connection); ?>