<?php

session_start();
require_once('../../inc/connection.php');

// $id = $_POST['id'];

$id = mysqli_real_escape_string($connection, $_POST['PatientID']);

$query = "UPDATE Patient SET isDelete = 'Deactive' WHERE idPatient = '{$id}' ";

$modalresult2 = mysqli_query($connection, $query);

if ($modalresult2) {
        echo "patientdelete";
}


?>

<?php mysqli_close($connection); ?>