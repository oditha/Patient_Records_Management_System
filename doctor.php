<?php

ob_start();
session_start();


if (!isset($_SESSION['USERNAME'])){

    header("Location: index.php");

}


$PAGE_TITLE = "Add/view doctors";

$PAGE_DESCRIPTION = "";

include_once "header.php";
require_once('inc/connection.php');
require_once('inc/functions.php');

$userList = '';

//get list of database user table
$query = "SELECT * FROM Doctor WHERE isDelete = 'Active' ORDER BY DoctorName ";//isDelete 0=active 1=deactive

$users = mysqli_query($connection, $query);

verify_query($users);

while ($user = mysqli_fetch_assoc($users)) { //$users == all data from databse    $user == get one by one records in $users variable


    $userList .= "<tr>"; //concat string variable is any value we use .=
    $userList .= "<td>Dr. {$user['DoctorName']} </td>";  //databse column name
    $userList .= "<td> {$user['DoctorContactNo']}  </td>";
    $userList .= "<td> {$user['Email']} </td>";
    $userList .= "<td> {$user['DocterAddress1']},{$user['DoctorAddress2']},{$user['DocterAddressCity']} </td>";
    $userList .= "<td> <button class='btn btn-primary btnedit' id='btnedit' bt='{$user['idDoctor']}'>Edit</button></td>";// use "\" ---add "" into another ""
//    $userList .= "<td> <a href=\"deleteuser.php?userId={$user['idusers']}\"
//			onclick=\"return confirm('Are you sure delete this user?');\" >Delete</a> </td>";
    $userList .= "</tr>";
}

//insert data into database
//$errors = array();

// $nic = '';
// $name = '';
// $contact = '';
// $username = '';
// $password = '';
// $email = '';
// $usertype = '';

if (isset($_POST['submit'])) {


    // $name = $_POST['name'];
    // $contact = $_POST['contact'];
    // $email = $_POST['email'];
    // $add1 = $_POST['address1'];
    // $add2 = $_POST['address2'];
    // $city = $_POST['city'];

    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $add1 = mysqli_real_escape_string($connection, $_POST['address1']);
    $add2 = mysqli_real_escape_string($connection, $_POST['address2']);
    $city = mysqli_real_escape_string($connection, $_POST['city']);
    //username already sanitized
    //$hashedPassword = sha1($password);

    $sessNAME = "add by - ".$_SESSION['USERNAME'];
    $active="Active";

    $query = "INSERT INTO Doctor (DoctorName, DoctorContactNo, Email, DocterAddress1, DoctorAddress2, DocterAddressCity, Createby, IsDelete) VALUES ('{$name}', '{$contact}', '{$email}', '{$add1}', '{$add2}', '{$city}', '{$sessNAME}', '{$active}' ) ";

    $result = mysqli_query($connection, $query);

    if ($result) {

        //query successful...redirect users.php
        header('Location: doctor.php?save=done');

    } else {
    
        echo mysqli_error($connection);
    }

   // mysqli_error($name);

}

?>

<div class="row">

    <div class="col-md-12">


        <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">+Add New</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->

            <form action="doctor.php" method="post">

                <div class="box-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <input class="form-control" id="exampleInputPassword1" name="name"
                                       placeholder="Enter Name" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact No</label>
                                <input class="form-control" id="contact" name="contact"
                                       placeholder="Enter Contact No" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input class="form-control" id="email" name="email"
                                       placeholder="Enter Email" type="text" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address 1</label>
                                <input class="form-control" id="exampleInputEmail1" name="address1"
                                       placeholder="Enter Address 1" type="text">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address 2</label>
                                <input class="form-control" id="exampleInputEmail1" name="address2"
                                       placeholder="Enter Address 2" type="text">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City</label>
                                <input class="form-control" id="exampleInputEmail1" name="city"
                                       placeholder="Enter City" type="text">
                            </div>


                        </div>
                    </div>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                    <button type="submit" name="submit" class="btn btn-primary" style="float: right">Save</button>

                </div>

            </form>

        </div>
        <!-- /.box -->


    </div>


    <div class="col-md-12">

        <div class="box box-warning">
            <div class="box-header with-border">
                <!-- <h3 class="box-title">Collapsable</h3> -->

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div><br>
            <!-- /.box-header -->
            <div class="box-body" style="">

                <table id="table_id" class="table table-bordered table-striped dataTable" role="grid"
                       aria-describedby="example1_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 181.5px;" aria-sort="ascending"
                            aria-label="Rendering engine: activate to sort column descending">Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 231px;" aria-label="Browser: activate to sort column ascending">Contact No
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 196.5px;" aria-label="Platform(s): activate to sort column ascending">Email
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 156px;" aria-label="Engine version: activate to sort column ascending">Address
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">Edit
                        </th>
                    </tr>
                    </thead>

                    <?php
                    echo $userList;
                    ?>

                </table>
            </div>
            <!-- /.box-body -->
        </div>

    </div>

</div>


<!--boostrap modal added-->

<div id="myModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Edit Doctor</h4>

            </div>

            <div class="modal-body">

                <form action="doctor.php" method="post">

                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Name</label>
                                    <input class="form-control" id="modalname" name="modalname"
                                           placeholder="Enter Name" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact No</label>
                                    <input class="form-control" id="modalcontact" name="modalcontact"
                                           placeholder="Enter Contact No" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input class="form-control" id="modalemail" name="modalemail"
                                           placeholder="Enter Email" type="text" required>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address 1</label>
                                    <input class="form-control" id="modaladdress1" name="modaladdress1"
                                           placeholder="Enter Address 1" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address 2</label>
                                    <input class="form-control" id="modaladdress2" name="modaladdress2"
                                           placeholder="Enter Address 2" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">City</label>
                                    <input class="form-control" id="modalcity" name="modalcity"
                                           placeholder="Enter City" type="text">
                                </div>


                            </div>


                        </div>


                    </div>
                    <!-- /.box-body -->


            </div>

            <div class="modal-footer">

                <button type="submit" class="btn btn-default" name="btndelete" style="color: red">Delete</button>

                <button type="submit" class="btn btn-primary" name="btnupdate">Update</button>

                <input type="text" id="DocID" name="DocID" hidden="">
            </div>

            </form>

        </div>

    </div>

</div>

<!--boostrap modal added-->

<!--update and delete user details-->
<?php

if (isset($_POST['btnupdate'])) {

    $modalID = mysqli_real_escape_string($connection, $_POST['DocID']);
    $modalname = mysqli_real_escape_string($connection, $_POST['modalname']);
    $modalcontact = mysqli_real_escape_string($connection, $_POST['modalcontact']);
    $modalemail = mysqli_real_escape_string($connection, $_POST['modalemail']);
    $modaladd1 = mysqli_real_escape_string($connection, $_POST['modaladdress1']);
    $modaladd2 = mysqli_real_escape_string($connection, $_POST['modaladdress2']);
    $modalcity = mysqli_real_escape_string($connection, $_POST['modalcity']);

    $sessNAME = "update by - ".$_SESSION['USERNAME'];

    $query = "UPDATE Doctor SET DoctorName = '{$modalname}', DoctorContactNo = '{$modalcontact}', Email = '{$modalemail}', DocterAddress1 = '{$modaladd1}', DoctorAddress2 = '{$modaladd2}', DocterAddressCity = '{$modalcity}', Createby = '{$sessNAME}' WHERE idDoctor = '{$modalID}' ";

    $modalresult1 = mysqli_query($connection, $query);

    if ($modalresult1) {
        //query successful...redirect users.php
        header('Location: doctor.php ');
    }
}


?>

<?php

if (isset($_POST['btndelete'])) {

    $modalID = mysqli_real_escape_string($connection, $_POST['DocID']);


    $query = "UPDATE Doctor SET IsDelete = 'Deactive' WHERE idDoctor = '{$modalID}' ";

    $modalresult2 = mysqli_query($connection, $query);

    if ($modalresult2) {
        header('Location: doctor.php');
    }


}

?>

<script>

$(document).ready(function () {

// data table --------------------------------------------------------------------    

        // $('#table_id').DataTable();

        $('#table_id').DataTable( {
            
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        } );

// end data table -----------------------------------------------------------------


        $(".btnedit").click(function () {

            var id = $(this).attr("bt");

            $("#DocID").val(id);

            $.ajax({

                method: "POST",
                url: "BackEnd/doctor/editDoctor.php",
                data: {id: id},

                success: function (res) {
                    var js = JSON.parse(res);

                    for (i = 0; i < js.length; i++) {
                        var name = js[i].DoctorName;
                        var con = js[i].DoctorContactNo;
                        var email = js[i].Email;
                        var add1 = js[i].DocterAddress1;
                        var add2 = js[i].DoctorAddress2;
                        var city = js[i].DocterAddressCity;


                    }

                    $('#modalname').val(name);
                    $('#modalcontact').val(con);
                    $('#modalemail').val(email);
                    $('#modaladdress1').val(add1);
                    $('#modaladdress2').val(add2);
                    $('#modalcity').val(city);


                    $('#myModal').modal();
                }

            });

        });


    $("#contact").keyup(function () {

        var contact = $('#contact').val();

        if (contact.length > 9) {

            $.ajax({

                method: "POST",
                url: "BackEnd/doctor/doctorConValidate.php",
                data: {contact: contact},

                success: function (res) {
                    
                     if($.trim(res) === "already"){
                        swal("Contact is already exists");
                     }
                }

            });

        }

    });


    $("#email").keyup(function () {

        var email = $('#email').val();


        $.ajax({

            method: "POST",
            url: "BackEnd/doctor/docEmailValidate.php",
            data: {email: email},

            success: function (res) {
                
                 if ($.trim(res) === "alreadyemail") {
                    swal("Email address is already exists");

               }
            }

        });

    });


    $("#modalcontact").keyup(function () {

        var contact = $('#modalcontact').val();

        if (contact.length > 9) {

            $.ajax({

                method: "POST",
                url: "BackEnd/doctor/doctorConValidate.php",
                data: {contact: contact},

                success: function (res) {
                    
                     if($.trim(res) === "already"){
                        swal("Contact is already exists");
                     }
                }

            });

        }

    });


    $("#modalemail").keyup(function () {

        var email = $('#modalemail').val();

        $.ajax({

            method: "POST",
            url: "BackEnd/doctor/docEmailValidate.php",
            data: {email: email},

            success: function (res) {
                
                 if ($.trim(res) === "alreadyemail") {
                    swal("Email address is already exists");

               }
            }

        });

    });



});


  
</script>
<?php include_once "footer.php"; ?>

<?php mysqli_close($connection); ?>
