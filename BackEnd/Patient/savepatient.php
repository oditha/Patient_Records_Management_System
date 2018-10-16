<?php 
	session_start();

	require_once('../../inc/connection.php');

    $RegNo = mysqli_real_escape_string($connection, $_POST['RegNo']);
    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $dob = mysqli_real_escape_string($connection, $_POST['dob']);
    $bloodgroup = mysqli_real_escape_string($connection, $_POST['bloodgroup']);
    $add1home = mysqli_real_escape_string($connection, $_POST['ad1home']);
    $add2home = mysqli_real_escape_string($connection, $_POST['ad2home']);
    $cityhome = mysqli_real_escape_string($connection, $_POST['cityhome']);
    $add1off = mysqli_real_escape_string($connection, $_POST['ad1off']);
    $add2off = mysqli_real_escape_string($connection, $_POST['ad2off']);
    $cityoff = mysqli_real_escape_string($connection, $_POST['cityoff']);

    $ContactMobile = mysqli_real_escape_string($connection, $_POST['cmob']);
    $ContactHome = mysqli_real_escape_string($connection, $_POST['chome']);
    $ContactOffice = mysqli_real_escape_string($connection, $_POST['coff']);


    $sessNAME = "add by - " . $_SESSION['USERNAME'];

    $regdate = date("d/m/y");

    $query = "INSERT INTO Patient (RegNo, FullName, isDelete, DOB, AddressHome1, AddressHome2, AddressHomeCity, AddressOffice1, AddressOffice2, AddressOfficeCity, ContactMobile, ContactHome, ContactOffice, Createby, RegisterDate, BloodGroup) VALUES ('{$RegNo}', '{$fullname}', 'Active', '{$dob}', '{$add1home}', '{$add2home}', '{$cityhome}', '{$add1off}', '{$add2off}', '{$cityoff}', '{$ContactMobile}', '{$ContactHome}', '{$ContactOffice}', '{$sessNAME}', '{$regdate}', '{$bloodgroup}' ) ";
    
    $result = mysqli_query($connection, $query);

    if ($result) {
    	 echo "save";
    	
    }

?>

<?php mysqli_close($connection); ?>