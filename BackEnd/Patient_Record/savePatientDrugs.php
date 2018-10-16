<?php
session_start();
require_once('../../inc/connection.php');

if (isset($_POST["json"])) {

	$json=$_POST["json"];


	$jsp=json_decode($json,TRUE);


	$query = '';
	$regdate = date("d/m/y");
	$Active="Active";
	$sessNAME = "add by - " . $_SESSION['USERNAME'];

	for ($count = 0; $count<count($jsp); $count++) { 

		$idDrug_clean = mysqli_real_escape_string($connection, $jsp[$count]['idDrug']);
		$drugName_clean = mysqli_real_escape_string($connection, $jsp[$count]['drugName']);
		$drugDose_clean = mysqli_real_escape_string($connection, $jsp[$count]['drugDose']);
		$iddoctor = mysqli_real_escape_string($connection, $jsp[$count]['iddoctor']);
		$idpatient = mysqli_real_escape_string($connection, $jsp[$count]['idpatient']);
		$drugdoctor = mysqli_real_escape_string($connection, $jsp[$count]['drugdoctor']);


		if ($idDrug_clean != '' && $drugDose_clean != '') {
			
			$query = "INSERT INTO `PRMS`.`PatientHasDrug` ( `RequestDate`, `IsDelete`, `CreateBy`, `Dose`, `idDrug`, `idDoctor`, `idPatient`, `DrugName`, `Doctor` ) 
			VALUES ( '{$regdate}', '{$Active}', '{$sessNAME}', '{$drugDose_clean}', '{$idDrug_clean}', '{$iddoctor}', '{$idpatient}', '{$drugName_clean}', '{$drugdoctor}' )";

			$result = mysqli_multi_query($connection, $query);
		}

	}

}

?>

<?php mysqli_close($connection); ?>