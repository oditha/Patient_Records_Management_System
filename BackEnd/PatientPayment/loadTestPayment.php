

<?php
session_start();
require_once('../../inc/connection.php');

$pid = $_POST['id'];
//$regDate = $_POST['regDate'];

$query = "SELECT t.*,pht.* FROM TestPayment t INNER JOIN PatientHasTest pht ON t.idPatientHasTest = pht.idPatientHasTest  WHERE  idPatient = '{$pid}' AND t.IsDelete = 'Active' ORDER BY TestDate DESC ";

$result = mysqli_query($connection, $query);

//verify_query($users);
$json_array = array();

while ($row = mysqli_fetch_assoc($result)){
    $json_array[] = $row;
}

echo json_encode($json_array);

?>

<?php mysqli_close($connection); ?>
