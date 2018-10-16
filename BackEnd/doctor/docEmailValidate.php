<?php

require_once('../../inc/connection.php');

$email = $_POST['email'];

//check nic is already exists
// $email = mysqli_real_escape_string($connection, $_POST['email']);

$query = "SELECT * FROM Doctor WHERE Email = '{$email }' LIMIT 1 ";

$resultSet = mysqli_query($connection, $query);

if ($resultSet) {
    if (mysqli_num_rows($resultSet) > 0) {
        echo "alreadyemail";
    }
}

?>

<?php mysqli_close($connection); ?>