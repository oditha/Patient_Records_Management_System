<?php

require_once('../../inc/connection.php');
//$_POST[''];

$nic = $_POST['nic'];

//check nic is already exists
$nic = mysqli_real_escape_string($connection, $_POST['nic']);

$query = "SELECT * FROM User WHERE NIC = '{$nic}' LIMIT 1 ";

$resultSet = mysqli_query($connection, $query);

if ($resultSet) {
    if (mysqli_num_rows($resultSet) > 0) {
        echo "alreadynic";
    }
}

?>

<?php mysqli_close($connection); ?>
