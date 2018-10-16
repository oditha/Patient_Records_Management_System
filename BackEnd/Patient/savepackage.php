<?php
	
	session_start();
	require_once('../../inc/connection.php');

	$packagecost = mysqli_real_escape_string($connection, $_POST['amount']);
	$packageid = mysqli_real_escape_string($connection, $_POST['selectpackage']);

	$query = "SELECT MAX(idPatient)AS max FROM Patient";

    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_array( $result );

    $largeNumber = $row['max'];

    $sessNAME = "add by - " . $_SESSION['USERNAME'];

    $date = date("d/m/y");

    $query = "INSERT INTO PackageHasPatient(CreateBy, packageDate, PackageCost, idPackage, idPatient) VALUES ('{$sessNAME}', '{$date}', '{$packagecost}', '{$packageid}', '{$largeNumber}') ";

    $result = mysqli_query($connection, $query);

    if ($result) {
    	echo "savepackage";
    }

?>

<?php mysqli_close($connection); ?>