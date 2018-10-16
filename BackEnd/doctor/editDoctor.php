<?php

require_once('../../inc/connection.php');
require_once('../../inc/functions.php');

$id = $_POST['id'];

$query = "SELECT * FROM Doctor WHERE idDoctor = '{$id}' ";

$users = mysqli_query($connection, $query);

verify_query($users);

while ($user = mysqli_fetch_assoc($users)){
    $js[] = $user;
}


$getID = json_encode($js);

echo $getID;

?>

<?php mysqli_close($connection); ?>
