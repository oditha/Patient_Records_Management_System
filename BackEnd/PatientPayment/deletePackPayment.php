<?php

session_start();
require_once('../../inc/connection.php');

$id = $_POST['id'];

// $id = mysqli_real_escape_string($connection, $_POST['PatientID']);

$query = "UPDATE PackagePayment  SET IsDelete = 'Deactive' WHERE idPackagePayment = '{$id}' ";

$result = mysqli_query($connection, $query);

if ($result) {
        echo "delete";
}

?>

<?php mysqli_close($connection); ?>