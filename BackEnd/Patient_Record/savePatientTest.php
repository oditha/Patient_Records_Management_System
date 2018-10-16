<?php
session_start();
require_once('../../inc/connection.php');

if (isset($_POST["json1"])) {


	$json=$_POST["json1"];


	$jsp=json_decode($json,TRUE);


	$query = '';
	$regdate = date("d/m/y");
	$Active="Active";
	$sessNAME = "add by - " . $_SESSION['USERNAME'];

	$amount = $_POST['amount'];


	$query2 = "INSERT INTO Payments (PaymentDay, PaymentAmount,	PaymentType, Isdelete, CreateBy) VALUES ('{$regdate}', '{$amount}', 'Cash', '{$Active}', '{$sessNAME}') ";

	$result2 = mysqli_query($connection, $query2);



	$query3 = "SELECT MAX(idPayments)AS max FROM Payments";

	$result3 = mysqli_query($connection, $query3);

	$row1 = mysqli_fetch_array( $result3 );
	$largestNumber1 = $row1['max'];


	for ($count = 0; $count<count($jsp); $count++) { 

		$idtest_clean = mysqli_real_escape_string($connection, $jsp[$count]['idtest']);
		$test_clean = mysqli_real_escape_string($connection, $jsp[$count]['test']);
		$price_clean = mysqli_real_escape_string($connection, $jsp[$count]['price']);
		$idpatient = mysqli_real_escape_string($connection, $jsp[$count]['idpatient']);
		$iddoctor = mysqli_real_escape_string($connection, $jsp[$count]['iddoctor']);
		$drugdoctor = mysqli_real_escape_string($connection, $jsp[$count]['drugdoctor']);
		


		if ($idtest_clean != '' && $price_clean != '') {

			$query1 = "INSERT INTO `PRMS`.`PatientHasTest` ( `TestDate`, `IsDelete`, `CreateBy`, `TestCost`, `IdTest`, `idPatient`, idDoctor, TestName, `Doctor`) 
			VALUES ( '{$regdate}', '{$Active}', '{$sessNAME}', '{$price_clean}', '{$idtest_clean}', '{$idpatient}', '{$iddoctor}', '{$test_clean}', '{$drugdoctor}' )";

			$result1 = mysqli_query($connection, $query1);



			$query4 = "SELECT MAX(idPatientHasTest)AS max FROM PatientHasTest";

			$result4 = mysqli_query($connection, $query4);

			$row2 = mysqli_fetch_array( $result4 );
			$largestNumber2 = $row2['max'];



			$query5 = "INSERT INTO `TestPayment` (Amount, PaymentDate, Isdelete, idPayments, IdTest, idPatientHasTest) VALUES ('{$price_clean}', '{$regdate}', '{$Active}', '{$largestNumber1}', '{$idtest_clean}', '{$largestNumber2}') ";

			$result5 = mysqli_query($connection, $query5);

		}

	}

}

?>

<?php mysqli_close($connection); ?>