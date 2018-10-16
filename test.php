<?php

ob_start();
session_start();

if (!isset($_SESSION['USERNAME'])){

    header("Location: index.php");

}

$PAGE_TITLE = "Add/view test";

$PAGE_DESCRIPTION = "";

include_once "header.php";
require_once('inc/connection.php');
require_once('inc/functions.php');

$userList = '';

//get list of database user table
$query = "SELECT * FROM Test WHERE isDelete = 'Active' ORDER BY TestName ";//isDelete 0=active 1=deactive

$users = mysqli_query($connection, $query);

verify_query($users);


while ($user = mysqli_fetch_assoc($users)) { //$users == all data from databse    $user == get one by one records in $users variable


    $userList .= "<tr>"; //concat string variable is any value we use .=
    $userList .= "<td> {$user['TestName']} </td>";  //databse column name
    $userList .= "<td> {$user['TestPriceMember']}  </td>";
    $userList .= "<td> {$user['TestPriceRegular']} </td>";
    $userList .= "<td> {$user['TestDescription']}</td>";
    $userList .= "<td> <button class='btn btn-primary btnedit' id='btnedit' bt='{$user['IdTest']}'>Edit</button></td>";

    $userList .= "</tr>";
}



if (isset($_POST['submit'])) {



    $name = mysqli_real_escape_string($connection, $_POST['testname']);
    $descrip = mysqli_real_escape_string($connection, $_POST['description']);
    $regprice = mysqli_real_escape_string($connection, $_POST['regprice']);
    $nonregprice = mysqli_real_escape_string($connection, $_POST['nonregprice']);

    $sessNAME = "add by - " . $_SESSION['USERNAME'];

    $query = "INSERT INTO Test (TestName, TestDescription, TestPriceMember, TestPriceRegular, Createby, IsDelete) VALUES ('{$name}', '{$descrip}', '{$regprice}', '{$nonregprice}', '{$sessNAME}', 'Active' ) ";

    $result = mysqli_query($connection, $query);

    if ($result) {
        //query successful...redirect users.php
        header('Location: test.php');
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

            <form action="test.php" method="post">

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-2"></div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Test name</label>
                                <input class="form-control" id="exampleInputEmail1" name="testname"
                                       placeholder="Enter test name"
                                       type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="form-control" rows="3" cols="50" name="description">
                            </textarea>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Test price (register members)</label>
                                <input class="form-control" id="exampleInputEmail1" placeholder="Enter price"
                                       type="text" name="regprice" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Test price (non-register members)</label>
                                <input class="form-control" id="exampleInputPassword1" placeholder="Enter price"
                                       type="text" name="nonregprice" required>
                                <br><br>
                                <button type="submit" name="submit" class="btn btn-primary" style="float: right;">Save
                                </button>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                </div>

            </form>

        </div>
        <!-- /.box -->


    </div>


    <div class="col-md-12">

        <div class="box box-warning">
            <!-- <div class="box-header with-border">
                <h3 class="box-title">Collapsable</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                
            </div> --> <br>
            <!-- /.box-header -->
            <div class="box-body" style="">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                       aria-describedby="example1_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 181.5px;" aria-sort="ascending"
                            aria-label="Rendering engine: activate to sort column descending">Test Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 231px;" aria-label="Browser: activate to sort column ascending">
                            price (register members)
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 196.5px;" aria-label="Platform(s): activate to sort column ascending">
                            price (non-register members)
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 156px;" aria-label="Engine version: activate to sort column ascending">
                            Test Description
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

                <h4 class="modal-title">Edit test</h4>

            </div>

            <div class="modal-body">

                <form action="test.php" method="post">

                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Test name</label>
                                    <input class="form-control" id="modaltestname" name="modaltestname"
                                           placeholder="Enter test name"
                                           type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea class="form-control" rows="3" cols="50" id="modaldescription" name="modaldescription">
                            </textarea>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Test price (register members)</label>
                                    <input class="form-control" id="modalregprice" placeholder="Enter price"
                                           type="text" name="modalregprice" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Test price (non-register members)</label>
                                    <input class="form-control" id="modalnonregprice" placeholder="Enter price"
                                           type="text" name="modalnonregprice" required>

                                </div>


                            </div>


                        </div>


                    </div>
                    <!-- /.box-body -->


            </div>

            <div class="modal-footer">

                <button type="submit" class="btn btn-default" name="btndelete" style="color: red">Delete</button>

                <button type="submit" class="btn btn-primary" name="btnupdate">Update</button>

                <input type="text" id="testID" name="testID" hidden>
            </div>

            </form>

        </div>

    </div>

</div>

<!--boostrap modal added-->

<!--update and delete user details-->
<?php

if (isset($_POST['btnupdate'])) {

    $modalID = mysqli_real_escape_string($connection, $_POST['testID']);
    $modalname = mysqli_real_escape_string($connection, $_POST['modaltestname']);
    $modaldes = mysqli_real_escape_string($connection, $_POST['modaldescription']);
    $modalregprice = mysqli_real_escape_string($connection, $_POST['modalregprice']);
    $modalnonregprice = mysqli_real_escape_string($connection, $_POST['modalnonregprice']);

    $sessNAME = "update by - " . $_SESSION['USERNAME'];

    $query = "UPDATE Test SET TestName = '{$modalname}', TestDescription = '{$modaldes}', TestPriceMember = '{$modalregprice}', TestPriceRegular = '{$modalnonregprice}', Createby = '{$sessNAME}' WHERE IdTest = '{$modalID}' ";

    $modalresult1 = mysqli_query($connection, $query);

    if ($modalresult1) {
        //query successful...redirect users.php
        header('Location: test.php ');
    }
}


?>

<?php

if (isset($_POST['btndelete'])) {

    $modalID = mysqli_real_escape_string($connection, $_POST['testID']);


    $query = "UPDATE Test SET IsDelete = 'Deactive' WHERE IdTest = '{$modalID}' ";

    $modalresult2 = mysqli_query($connection, $query);

    if ($modalresult2) {
        header('Location: test.php');
    }

}

?>

<script>

    $(document).ready(function () {

        $('table').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        });


        $(".btnedit").click(function () {

            var id = $(this).attr("bt");

            $("#testID").val(id);

            $.ajax({

                method: "POST",
                url: "BackEnd/test/testEdit.php",
                data: {id: id},

                success: function (res) {
                    var js = JSON.parse(res);

                    for (i = 0; i < js.length; i++) {
                        var name = js[i].TestName;
                        var descrip = js[i].TestDescription;
                        var regprice = js[i].TestPriceMember;
                        var nonregprice = js[i].TestPriceRegular;

                    }

                    $('#modaltestname').val(name);
                    $('#modaldescription').val(descrip);
                    $('#modalregprice').val(regprice);
                    $('#modalnonregprice').val(nonregprice);


                    $('#myModal').modal();
                }

            });

        });


        ;
    })


//    $("#contact").keyup(function () {
//
//        var contact = $('#contact').val();
//
//        if (contact.length > 9) {
//
//            $.ajax({
//
//                method: "POST",
//                url: "BackEnd/doctor/doctorConValidate.php",
//                data: {contact: contact},
//
//                success: function (res) {
//
//                    if (res == "alreadycontact") {
//                        swal("Contact is already exists");
//
//
//                    }
//                }
//
//            });
//
//        }
//
//    });


//    $("#email").keyup(function () {
//
//        var email = $('#email').val();
//
//
//        $.ajax({
//
//            method: "POST",
//            url: "BackEnd/doctor/docEmailValidate.php",
//            data: {email: email},
//
//            success: function (res) {
//
//                if (res == "alreadyemail") {
//                    swal("Email address is already exists");
//
//                }
//            }
//
//        });
//
//    });


</script>
<?php include_once "footer.php"; ?>

<?php mysqli_close($connection); ?>
