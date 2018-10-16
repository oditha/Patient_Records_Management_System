<?php
session_start();
require_once('../../inc/connection.php');


$idrecorde = $_POST['idrecorde'];
$amount = $_POST['amount'];
$packagecost = $_POST['packagecost'];
$doctor = $_POST['doctor'];
$packagename = $_POST['packagename'];

$regdate = date("d/m/y");
$Active="Active";
$sessNAME = "add by - " . $_SESSION['USERNAME'];

// $query = "INSERT INTO Payments (PaymentDay, PaymentAmount,	PaymentType, Isdelete, CreateBy) VALUES ('{$regdate}', '{$amount}', 'Cash', '{$Active}', '{$sessNAME}') ";

// $result = mysqli_query($connection, $query);



$query1 = "SELECT MAX(idPayments)AS max FROM Payments";

$result1 = mysqli_query($connection, $query1);

$row = mysqli_fetch_array( $result1 );
$largestNumber = $row['max'];




$query2 = "INSERT INTO `PackagePayment` (Amount, PaymentDate, Isdelete, idPayments, idRecords, Doctor, PackName) VALUES ('{$packagecost}', '{$regdate}', '{$Active}', '{$largestNumber}', '{$idrecorde}', '{$doctor}', '{$packagename}') ";

$result2 = mysqli_query($connection, $query2);
echo "save";
?>


<?php mysqli_close($connection); ?>