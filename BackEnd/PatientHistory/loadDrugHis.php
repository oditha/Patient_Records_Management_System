
<?php
session_start();
require_once('../../inc/connection.php');

$pid = $_POST['id'];
//$regDate = $_POST['regDate'];

$query = "SELECT * FROM PatientHasDrug WHERE  idPatient = '{$pid}' AND IsDelete = 'Active' ORDER BY RequestDate DESC ";

$result = mysqli_query($connection, $query);

//verify_query($users);
$json_array = array();

while ($row = mysqli_fetch_assoc($result)){
    $json_array[] = $row;
}

echo json_encode($json_array);

?>

<?php mysqli_close($connection); ?>
