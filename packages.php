<?php

ob_start();
session_start();

if (!isset($_SESSION['USERNAME'])){

    header("Location: index.php");

}

$PAGE_TITLE = "Add/view package";

$PAGE_DESCRIPTION = "";

include_once "header.php";
require_once('inc/connection.php');
require_once('inc/functions.php');

$userList = '';

//get list of database user table
$query = "SELECT * FROM Package WHERE isDelete = 'Active' ORDER BY PackageName ";//isDelete 0=active 1=deactive

$users = mysqli_query($connection, $query);

verify_query($users);


while ($user = mysqli_fetch_assoc($users)) { //$users == all data from databse    $user == get one by one records in $users variable


    $userList .= "<tr>"; //concat string variable is any value we use .=
    $userList .= "<td> {$user['PackageName']} </td>";  //databse column name
    $userList .= "<td> {$user['PackagePriceMember']}  </td>";
    $userList .= "<td> {$user['PackagePriceRegular']} </td>";
    $userList .= "<td> {$user['PackageDescription']}</td>";
    $userList .= "<td> <button class='btn btn-primary btnedit' id='btnedit' bt='{$user['idPackage']}'>Edit</button></td>";// use "\" ---add "" into another ""
//    $userList .= "<td> <a href=\"deleteuser.php?userId={$user['idusers']}\"
//			onclick=\"return confirm('Are you sure delete this user?');\" >Delete</a> </td>";
    $userList .= "</tr>";
}

//insert data into database
//$errors = array();
//$nic = '';
//$name = '';
//$contact = '';
//$username = '';
//$password = '';
//$email = '';
//$usertype = '';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($connection, $_POST['packagename']);
    $descrip = mysqli_real_escape_string($connection, $_POST['description']);
    $regprice = mysqli_real_escape_string($connection, $_POST['regprice']);
    $nonregprice = mysqli_real_escape_string($connection, $_POST['nonregprice']);

    $sessNAME = "add by - " . $_SESSION['USERNAME'];

    $query = "INSERT INTO Package (PackageName, PackageDescription, PackagePriceMember, PackagePriceRegular, Createby, IsDelete) VALUES ('{$name}', '{$descrip}', '{$regprice}', '{$nonregprice}', '{$sessNAME}', 'Active' ) ";

    $result = mysqli_query($connection, $query);

    if ($result) {

        $query = "SELECT MAX(idPackage)AS max FROM Package";

        $result = mysqli_query($connection, $query);

        $row = mysqli_fetch_array( $result );
        $largestNumber = $row['max'];

        foreach ($_POST['framework'] as $selectedOption){

            $query = "INSERT INTO PackageHasTest(idPackage, IdTest, IsDelete) VALUES ('{$largestNumber}', '{$selectedOption}', 'Active')";
            $result = mysqli_query($connection, $query);
        }
    }

    if ($result) {
        //query successful...redirect users.php
        header('Location: packages.php');
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

            <form action="packages.php" method="post" id="framework_form">

                <div class="box-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Package name</label>
                                <input class="form-control" id="exampleInputEmail1" name="packagename"
                                       placeholder="Enter test name"
                                       type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Package Description</label>
                                <textarea class="form-control" rows="3" cols="50" name="description">
                            </textarea>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Package price (register members)</label>
                                <input class="form-control" id="exampleInputEmail1" placeholder="Enter price"
                                       type="text" name="regprice" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Package price (non-register members)</label>
                                <input class="form-control" id="exampleInputPassword1" placeholder="Enter price"
                                       type="text" name="nonregprice" required>

                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <div class="form-group">
                                    <label>Select test</label>
                                    <select id="framework" name="framework[]" multiple class="form-control">

                                        <?php

                                        $query = "SELECT * FROM Test WHERE isDelete = 'Active'";
                                        $result1 = mysqli_query($connection, $query); ?>

                                        <?php while ($row1 = mysqli_fetch_array($result1)):; ?>

                                            <option value="<?php echo $row1[0]; ?>"><?php echo $row1[2]; ?></option>

                                        <?php endwhile; ?>


                                    </select>
                                </div>
                                <br><br><br><br>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary"
                                        style="float: right;">Save
                                </button>
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


<!--    <div class="col-md-12">-->

        <div class="box box-warning">
            <!-- <div class="box-header with-border">
                <h3 class="box-title">Collapsable</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                
            </div><br> --><br>
            <!-- /.box-header -->
            <div class="box-body" style="">
                <table id="table_id" class="table table-bordered table-striped dataTable" role="grid"
                       aria-describedby="example1_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 181.5px;" aria-sort="ascending"
                            aria-label="Rendering engine: activate to sort column descending">Package Name
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
                            Package Description
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

<!--    </div>-->

</div>


<!--boostrap modal added-->

<div id="myModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Edit package</h4>

            </div>

            <div class="modal-body">

                <form action="packages.php" method="post" id="framework1">

                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Package name</label>
                                    <input class="form-control" id="modalpackagename" name="modalpackagename"
                                           placeholder="Enter test name"
                                           type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Package Description</label>
                                    <textarea class="form-control" rows="3" cols="50" id="modaldescription" name="modaldescription">
                            </textarea>
                                </div>

                            </div>
                            <div class="col-md-5">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Package price (registed)</label>
                                    <input class="form-control" id="modalregprice" placeholder="Enter price"
                                           type="text" name="modalregprice" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Package price (non-registed)</label>
                                    <input class="form-control" id="modalnonregprice" placeholder="Enter price"
                                           type="text" name="modalnonregprice" required>

                                </div>

                            </div>
<!--                            <div class="col-md-5">-->
<!---->
<!--                                <div class="form-group">-->
<!--                                    <div class="form-group">-->
<!--                                        <label>Select test</label>-->
<!--                                        <select id="modalframework" name="modalframework1[]" multiple class="form-control">-->
<!---->
<!--                                            --><?php
//
//                                            $query = "SELECT * FROM Test";
//                                            $result1 = mysqli_query($connection, $query); ?>
<!---->
<!--                                            --><?php //while ($row1 = mysqli_fetch_array($result1)):; ?>
<!---->
<!--                                                <option value="--><?php //echo $row1[0]; ?><!--">--><?php //echo $row1[2]; ?><!--</option>-->
<!---->
<!--                                            --><?php //endwhile; ?>
<!---->
<!---->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                            </div>-->


                        </div>


                    </div>
                    <!-- /.box-body -->


            </div>

            <div class="modal-footer">

                <button type="submit" class="btn btn-default" name="btndelete" style="color: red">Delete</button>

                <button type="submit" class="btn btn-primary" name="btnupdate">Update</button>

                <input type="text" id="packID" name="packID" hidden>
            </div>

            </form>

        </div>

    </div>

</div>

<!--boostrap modal added-->

<!--update and delete user details-->
<?php

if (isset($_POST['btnupdate'])) {

    $modalID = mysqli_real_escape_string($connection, $_POST['packID']);
    $modalname = mysqli_real_escape_string($connection, $_POST['modalpackagename']);
    $modaldes = mysqli_real_escape_string($connection, $_POST['modaldescription']);
    $modalregprice = mysqli_real_escape_string($connection, $_POST['modalregprice']);
    $modalnonregprice = mysqli_real_escape_string($connection, $_POST['modalnonregprice']);

    $sessNAME = "update by - " . $_SESSION['USERNAME'];

    $query = "UPDATE Package SET PackageName = '{$modalname}', PackageDescription = '{$modaldes}', PackagePriceMember = '{$modalregprice}', PackagePriceRegular = '{$modalnonregprice}', Createby = '{$sessNAME}' WHERE idPackage = '{$modalID}' ";

    $modalresult1 = mysqli_query($connection, $query);

    if ($modalresult1) {
        //query successful...redirect users.php
        header('Location: packages.php ');
    }
}


?>

<?php

if (isset($_POST['btndelete'])) {

    $modalID = mysqli_real_escape_string($connection, $_POST['packID']);


    $query = "UPDATE Package SET IsDelete = 'Deactive' WHERE idPackage = '{$modalID}' ";

    $modalresult2 = mysqli_query($connection, $query);

    if ($modalresult2) {
        header('Location: packages.php');
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


        $('#framework').multiselect({
            nonSelectedText: 'Select test',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '300px'
        });


        $(".btnedit").click(function () {

            var id = $(this).attr("bt");

            $("#packID").val(id);

            $.ajax({

                method: "POST",
                url: "BackEnd/package/packageEdit.php",
                data: {id: id},

                success: function (res) {
                    var js = JSON.parse(res);

                    for (i = 0; i < js.length; i++) {
                        var name = js[i].PackageName;
                        var descrip = js[i].PackageDescription;
                        var regprice = js[i].PackagePriceMember;
                        var nonregprice = js[i].PackagePriceRegular;

                    }

                    $('#modalpackagename').val(name);
                    $('#modaldescription').val(descrip);
                    $('#modalregprice').val(regprice);
                    $('#modalnonregprice').val(nonregprice);


                    $('#myModal').modal();
                }

            });

        });


    });


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
