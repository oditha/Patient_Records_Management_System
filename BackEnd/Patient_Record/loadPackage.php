<?php

require_once('../../inc/connection.php');
require_once('../../inc/functions.php');

$id = $_POST['id'];

$query = "SELECT p.*,pp.* FROM Package p INNER JOIN PackageHasPatient pp ON p.idPackage = pp.idPackage WHERE idPatient = '{$id}' ";

$users = mysqli_query($connection, $query);

verify_query($users);

while ($user = mysqli_fetch_assoc($users)){
    $js[] = $user;
}

$getID = json_encode($js);

echo $getID;

?>


<?php mysqli_close($connection); ?>