

<?php
session_start();
require_once('../../inc/connection.php');

$pid = $_POST['id'];
//$regDate = $_POST['regDate'];

$query = "SELECT php.*,pp.* FROM PackageHasPatient php INNER JOIN PackagePayment pp ON pp.idRecords = php.idRecords WHERE  idPatient = '{$pid}' AND pp.IsDelete = 'Active' ORDER BY PaymentDate DESC ";

$result = mysqli_query($connection, $query);

//verify_query($users);
$json_array = array();

while ($row = mysqli_fetch_assoc($result)){
    $json_array[] = $row;
}

echo json_encode($json_array);

?>

<?php mysqli_close($connection); ?>
