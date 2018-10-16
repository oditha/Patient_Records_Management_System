<?php
	session_start();
	require_once('../../inc/connection.php');

	$modalID = mysqli_real_escape_string($connection, $_POST['PatientID']);
    $modelfullname = mysqli_real_escape_string($connection, $_POST['modelfullname']);
    $modeldob = mysqli_real_escape_string($connection, $_POST['modeldob']);
    $modelbloodgroup = mysqli_real_escape_string($connection, $_POST['modelbloodgroup']);

    $modelconmob = mysqli_real_escape_string($connection, $_POST['modelconmob']);
    $modelconhome = mysqli_real_escape_string($connection, $_POST['modelconhome']);
    $modelconoff = mysqli_real_escape_string($connection, $_POST['modelconoff']);

    $modelad1home = mysqli_real_escape_string($connection, $_POST['modelad1home']);
    $modelad2home = mysqli_real_escape_string($connection, $_POST['modelad2home']);
    $modelcityhome = mysqli_real_escape_string($connection, $_POST['modelcityhome']);

    $modelad1off = mysqli_real_escape_string($connection, $_POST['modelad1off']);
    $modelad2off = mysqli_real_escape_string($connection, $_POST['modelad2off']);
    $modelcityoff = mysqli_real_escape_string($connection, $_POST['modelcityoff']);

    $sessNAME = "update by - ".$_SESSION['USERNAME'];

    $date = date("d/m/y");

    $query = "UPDATE Patient SET FullName = '{$modelfullname}', DOB = '{$modeldob}', BloodGroup = '{$modelbloodgroup}', AddressHome1 = '{$modelad1home}', AddressHome2 = '{$modelad2home}',AddressHomeCity = '{$modelcityhome}', AddressOffice1 = '{$modelad1off}', AddressOffice2 = '{$modelad2off}', AddressOfficeCity = '{$modelcityoff}', Createby = '{$sessNAME}', ContactHome = '{$modelconhome}', ContactOffice = '{$modelconoff}', ContactMobile = '{$modelconmob}', RegisterDate = '{$date}' WHERE idPatient = '{$modalID}' ";

    $modalresult = mysqli_query($connection, $query);

    if ($modalresult) {
    	echo "update";
    }

?>