<?php


function verify_query($result_set){

    global $connection;

    if (!$result_set) {
        die("Database query faild" .mysqli_error($connection) );
    }
}

//function checkReqFileds($reqFields){
//    //check requard fileds
//
//    $errors = array();
//
//    foreach ($reqFields as $field) {
//
//        if (empty(trim($_POST[$field]))) {//trim fucntion use avoid space in input
//            $errors[] = $field.' is requerd';
//        }
//    }
//
//    return $errors;
//}
//
//
//function checkMaxLenth($maxLenthFields){
//    //check max lenth in fileds
//
//    $errors = array();
//
//    foreach ($maxLenthFields as $field => $maxLenth) {
//
//        if (strlen(trim($_POST[$field])) > $maxLenth) {//trim fucntion use avoid space in input
//            $errors[] = $field.' must be less than '.$maxLenth.' characters';
//        }
//    }
//
//    return $errors;
//}

//function displayErrors($errors){
//    //display form errors
//    echo '<div class="errmsg">';
//    echo '<b>Something error your form !</b><br>';
//    foreach ($errors as $error) {;
//        echo $error. '<br>';
//    }
//    echo '</div>';
//}



function dateformat($date1){

   $date= new DateTime($date1);


  return  $date->format('d/m/Y');



}


?>