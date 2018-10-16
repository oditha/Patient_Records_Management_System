<?php

require_once('../../inc/connection.php');
//$_POST[''];

$contact = $_POST['contact'];

//check nic is already exists
//$contact = mysqli_real_escape_string($connection, $_POST['contact']);

$query = "SELECT * FROM Patient WHERE ContactMobile = '{$contact}' LIMIT 1 ";

$resultSet = mysqli_query($connection, $query);

if ($resultSet) {
    if (mysqli_num_rows($resultSet) > 0) {
        echo "already";
    }
}

?>


<?php mysqli_close($connection); ?>