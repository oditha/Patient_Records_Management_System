<?php
ob_start();
session_start();

if (!isset($_SESSION['USERNAME'])){

    header("Location: index.php");

}

$PAGE_TITLE = "Add/view users";

$PAGE_DESCRIPTION = "";

include_once "header.php";
require_once('inc/connection.php');
require_once('inc/functions.php');

$userList = '';

$query = "SELECT * FROM User WHERE isDelete = 'Active' ORDER BY Name ASC ";//isDelete 0=active 1=deactive

$users = mysqli_query($connection, $query);

verify_query($users);


while ($user = mysqli_fetch_assoc($users)) { //$users == all data from databse    $user == get one by one records in $users variable


    $userList .= "<tr>"; //concat string variable is any value we use .=
    $userList .= "<td> {$user['NIC']} </td>";  //databse column name
    $userList .= "<td> {$user['Name']}  </td>";
    $userList .= "<td> {$user['ContactNo']} </td>";
    $userList .= "<td> {$user['Email']} </td>";
    $userList .= "<td> <button class='btn btn-primary btnedit' id='btnedit' bt='{$user['idUser']}'>Edit</button></td>";// use "\" ---add "" into another ""
//    $userList .= "<td> <a href=\"deleteuser.php?userId={$user['idusers']}\"
//			onclick=\"return confirm('Are you sure delete this user?');\" >Delete</a> </td>";
    $userList .= "</tr>";
}

//insert data into database
//$errors = array();
$nic = '';
$name = '';
$contact = '';
$username = '';
$password = '';
$email = '';
$usertype = '';

if (isset($_POST['submit'])) {

    $nic = $_POST['nic'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $usertype = $_POST['usertype'];

    $nic = mysqli_real_escape_string($connection, $_POST['nic']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $usertype = mysqli_real_escape_string($connection, $_POST['usertype']);
    //username already sanitized
    //$hashedPassword = sha1($password);

    $sessNAME = "add by - ".$_SESSION['USERNAME'];

    $query = "INSERT INTO User (NIC, Name, ContactNo, Email, Type, AddBy, IsDelete) VALUES ('{$nic}', '{$name}', '{$contact}', '{$email}', '{$usertype}', '{$sessNAME}', 'Active' ) ";

    $result = mysqli_query($connection, $query);

    if ($result) {
        //query successful...redirect users.php
        header('Location: users.php');
    } else {
        $errors[] = 'failed new record added';
    }


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

            <form action="users.php" method="post">

                <div class="box-body">
                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="exampleInputEmail1">NIC</label>
                                <input class="form-control" id="nic" name="nic" placeholder="Enter nic" type="text"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <input class="form-control" id="exampleInputPassword1" name="name"
                                       placeholder="Enter Name" type="text" required>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact No</label>
                                <input class="form-control" id="exampleInputEmail1" name="contact"
                                       placeholder="Enter Contact No" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input class="form-control" id="email" name="email"
                                       placeholder="Enter Email" type="text" required>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>User Type</label>
                                <select class="form-control" name="usertype">
                                    <option>Admin</option>
                                    <option>cashier</option>

                                </select>
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
                            aria-label="Rendering engine: activate to sort column descending">NIC
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 231px;" aria-label="Browser: activate to sort column ascending">Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 196.5px;" aria-label="Platform(s): activate to sort column ascending">Contact
                            No
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 156px;" aria-label="Engine version: activate to sort column ascending">Email
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

                <h4 class="modal-title">Edit user</h4>

            </div>

            <div class="modal-body">

                <form action="users.php" method="post">

                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">NIC</label>
                                    <input class="form-control" id="modalnic" name="modalnic" placeholder="Enter nic"
                                           type="text"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Name</label>
                                    <input class="form-control" id="modalname" name="modalname"
                                           placeholder="Enter Name" type="text" required>
                                </div>

                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>User Type</label>
                                    <select class="form-control" name="modalusertype" id="modeltype">
                                        <option>Admin</option>
                                        <option>cashier</option>

                                    </select>
                                </div>


                            </div>


                        </div>


                    </div>
                    <!-- /.box-body -->


            </div>

            <div class="modal-footer">

                <button type="submit" class="btn btn-default"  name="btndelete" style="color: red">Delete</button>

                <button type="submit" class="btn btn-primary" name="btnupdate">Update</button>

                <input type="text" id="uID" name="uID" hidden>
            </div>

            </form>

        </div>

    </div>

</div>

<!--boostrap modal added-->

<!--update and delete user details-->
<?php

if (isset($_POST['btnupdate'])) {

    $modalID = mysqli_real_escape_string($connection, $_POST['uID']);
    $modalnic = mysqli_real_escape_string($connection, $_POST['modalnic']);
    $modalname = mysqli_real_escape_string($connection, $_POST['modalname']);
    $modalcontact = mysqli_real_escape_string($connection, $_POST['modalcontact']);
    $modalemail = mysqli_real_escape_string($connection, $_POST['modalemail']);
    $modalusertype = mysqli_real_escape_string($connection, $_POST['modalusertype']);

    $sessNAME = "update by - ".$_SESSION['USERNAME'];

    $query = "UPDATE User SET NIC = '{$modalnic}', Name = '{$modalname}', ContactNo = '{$modalcontact}', Email = '{$modalemail}', Type = '{$modalusertype}', AddBy = '{$sessNAME}' WHERE idUser = '{$modalID}' ";

    $modalresult1 = mysqli_query($connection, $query);

    if ($modalresult1) {
        //query successful...redirect users.php
        header('Location: users.php ');
    }
}


?>

<?php

    if (isset($_POST['btndelete'])) {

        $modalID = mysqli_real_escape_string($connection, $_POST['uID']);

        if ($_SESSION['USERID'] != $modalID) {

            $query = "UPDATE User SET IsDelete = 'Deactive' WHERE idUser = '{$modalID}' ";

            $modalresult2 = mysqli_query($connection, $query);

            if ($modalresult2) {
                header('Location: users.php');
             }

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

            $("#uID").val(id);

            $.ajax({

                method: "POST",
                url: "BackEnd/user/userEditajax.php",
                data: {id: id},

                success: function (res) {
                    var js = JSON.parse(res);

                    for (i = 0; i < js.length; i++) {
                        var nic = js[i].NIC;
                        var name = js[i].Name;
                        var con = js[i].ContactNo;
                        var email = js[i].Email;
                        var utype = js[i].Type;


                    }

                    $('#modalnic').val(nic);
                    $('#modalname').val(name);
                    $('#modalcontact').val(con);
                    $('#modalemail').val(email);
                    $('#modeltype').val(utype);


                    $('#myModal').modal();
                }

            });

        });


        $("#nic").keyup(function () {

        var nic = $('#nic').val();

        if (nic.length > 9) {

            $.ajax({

                method: "POST",
                url: "BackEnd/user/usernicvalidate.php",
                data: {nic: nic},

                success: function (res) {

                    if ($.trim(res) == "alreadynic") {
                        swal("Nic is already exists");

                    }
                }

            });

        }

    });


    $("#email").keyup(function () {

        var email = $('#email').val();


        $.ajax({

            method: "POST",
            url: "BackEnd/user/useremailvalidate.php",
            data: {email: email},

            success: function (res) {

                if ($.trim(res) === "alreadyemail") {
                    swal("Email address is already exists");

                }
            }

        });

    });


        $("#modalnic").keyup(function () {

        var nic = $('#modalnic').val();

        if (nic.length > 9) {

            $.ajax({

                method: "POST",
                url: "BackEnd/user/usernicvalidate.php",
                data: {nic: nic},

                success: function (res) {

                    if ($.trim(res) == "alreadynic") {
                        swal("Nic is already exists");

                    }
                }

            });

        }

    });


    $("#modalemail").keyup(function () {

        var email = $('#modalemail').val();


        $.ajax({

            method: "POST",
            url: "BackEnd/user/useremailvalidate.php",
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
