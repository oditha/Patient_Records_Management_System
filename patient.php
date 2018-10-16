<?php

ob_start();
session_start();

$PAGE_TITLE = "Patient";

$PAGE_DESCRIPTION = "Register | view Patient";

include_once "header.php";
require_once('inc/connection.php');
require_once('inc/functions.php');

?>

<div class="row">

    <div class="col-md-12">


        <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">++Add New</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <form id="form" name="form" method="post">
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Register No</label>
                                <input class="form-control" id="RegNo" name="RegNo" placeholder="Enter RegNo" type="text"  required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Full Name</label>
                                <input class="form-control" id="fullname" name="fullname" placeholder="Full name" type="text" required >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Date of birth</label>
                                <input class="form-control" id="dob" name="dob" placeholder="Enter date of birth" type="date" required>
                            </div>

                            <div class="form-group">
                                <label>Select blood group</label><br>
                                <select name="bloodgroup" style="width: 335px; height: 33px;">
                                   <option value="A+">A+</option>
                                   <option value="A-">A-</option>
                                   <option value="B+">B+</option>
                                   <option value="B-">B-</option>
                                   <option value="AB+">AB+</option>
                                   <option value="AB-">AB-</option>
                                   <option value="O+">O+</option>
                                   <option value="O-">O-</option>
                               </select> 
                           </div>
                       </div>
                       <div class="col-md-4">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Contact Mobile</label>
                            <input class="form-control"  placeholder="Enter Contact (mobile)" type="text" id="cmob" name="cmob" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Contact Home</label>
                            <input class="form-control"  placeholder="Enter Contact (home)" type="text" name="chome" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Contact Office</label>
                            <input class="form-control"  placeholder="Enter Contact (Office)" type="text" name="coff" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Address 1 (Home)</label>
                            <input class="form-control" id="exampleInputEmail1" name="ad1home" placeholder="Enter Address 1 (Home)" type="text"  >
                        </div>


                        
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Address 2 (Home)</label>
                            <input class="form-control" id="exampleInputEmail1" name="ad2home" placeholder="Enter Address 2 (Home)" type="text"  >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> City (Home)</label>
                            <input class="form-control" id="exampleInputEmail1" name="cityhome" placeholder="Enter City (Home)" type="text"  >
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1"> Address 1 (Office)</label>
                            <input class="form-control" id="exampleInputEmail1" name="ad1off" placeholder="Enter Address 1 (Office)" type="text"  >
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Address 2 (Office)</label>
                            <input class="form-control" id="exampleInputEmail1" name="ad2off" placeholder="Enter Address 2 (Office)" type="text"  >
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1"> City (Office)</label>
                            <input class="form-control" id="exampleInputEmail1" name="cityoff" placeholder="Enter City (Office)" type="text"  >
                        </div>


                    </div>


                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">

                <button type="button" class="btn btn-primary" id="id" name="submit" value="Submit">Submit</button>

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
            
            <table id="table_id" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
               
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style="width: 100px;" aria-sort="ascending"
                        aria-label="Rendering engine: activate to sort column descending">RegNo
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                    style="width: 120px;" aria-sort="ascending"
                    aria-label="Rendering engine: activate to sort column descending">Register date
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                style="width: 231px;" aria-label="Browser: activate to sort column ascending">Name
            </th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
            style="width: 150px;" aria-label="Platform(s): activate to sort column ascending">Contact No (Mobile)
        </th>
                        <!-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 196.5px;" aria-label="Platform(s): activate to sort column ascending">Contact No (Home)
                        </th> -->
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style="width: 180px;" aria-label="Engine version: activate to sort column ascending">Address (Home)
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                    style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">Action
                </th>
            </tr>
        </thead>

        <?php
                   // echo $userList;

                    // $userList = '';

//get list of database user table
$query = "SELECT * FROM Patient WHERE isDelete = 'Active' ORDER BY RegNo ";//isDelete 0=active 1=deactive

$users = mysqli_query($connection, $query);

verify_query($users);


while ($user = mysqli_fetch_assoc($users)) { //$users == all data from databse    $user == get one by one records in $users variable
    ?>

    <tr>
        <td> <?php echo $user['RegNo']; ?> </td>
        <td> <?php echo $user['RegisterDate']; ?> </td>
        <td> <?php echo $user['FullName'];  ?> </td>
        <td> <?php echo $user['ContactMobile']; ?> </td>
        <td> <?php echo $user['AddressHome1'].",".$user['AddressHome2'].",".$user['AddressHomeCity']; ?> </td>
        <td>
            <button class="btn btn-primary btnedit" id="btnedit" bt=" <?php echo $user['idPatient']; ?>">Edit</button>

        </td>
    </tr>

    <?php 
}

?>

</table>
</div>
<!-- /.box-body -->
</div>

</div>

</div>


<!--boostrap modal added (update patient details) -->

<div id="myModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Edit Patient</h4>

            </div>

            <div class="modal-body">

                <form action="patient.php" id="formupdate" method="post">

                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Register No</label>
                                    <input class="form-control" id="modelRegNo" placeholder="Enter RegNo" type="text" name="modelRegNo" disabled="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Full Name</label>
                                    <input class="form-control" id="modelfullname" placeholder="Full name" type="text" name="modelfullname" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Date of birth</label>
                                    <input class="form-control" id="modeldob" placeholder="Enter date of birth" type="date" name="modeldob" required>
                                </div>

                                <div class="form-group">
                                    <label>Select blood group</label><br>
                                    <select id="modelbloodgroup" name="modelbloodgroup" style="width: 100px; height: 35px;">
                                       <option value="A+">A+</option>
                                       <option value="A-">A-</option>
                                       <option value="B+">B+</option>
                                       <option value="B-">B-</option>
                                       <option value="AB+">AB+</option>
                                       <option value="AB-">AB-</option>
                                       <option value="O+">O+</option>
                                       <option value="O-">O-</option>
                                   </select> 
                               </div>
                           </div>
                           <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact Mobile</label>
                                <input class="form-control" id="modelconmob" placeholder="Enter Contact (mobile)" type="text" name="modelconmob" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"> Contact Home</label>
                                <input class="form-control" id="modelconhome" placeholder="Enter Contact (home)" type="text" name="modelconhome" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"> Contact Office</label>
                                <input class="form-control" id="modelconoff" placeholder="Enter Contact (Office)" type="text" name="modelconoff" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"> Address 1 (Home)</label>
                                <input class="form-control" id="modelad1home" placeholder="Enter Address 1 (Home)" type="text" name="modelad1home" >
                            </div>


                            
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Address 2 (Home)</label>
                                <input class="form-control" id="modelad2home" placeholder="Enter Address 2 (Home)" type="text" name="modelad2home" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"> City (Home)</label>
                                <input class="form-control" id="modelcityhome" placeholder="Enter City (Home)" type="text" name="modelcityhome" >
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1"> Address 1 (Office)</label>
                                <input class="form-control" id="modelad1off" placeholder="Enter Address 1 (Office)" type="text" name="modelad1off" >
                            </div> 
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Address 2 (Office)</label>
                                <input class="form-control" id="modelad2off" placeholder="Enter Address 2 (Office)" type="text" name="modelad2off" >
                            </div> 
                            <div class="form-group">
                                <label for="exampleInputEmail1"> City (Office)</label>
                                <input class="form-control" id="modelcityoff" placeholder="Enter City (Office)" type="text" name="modelcityoff" >
                            </div>


                        </div>


                    </div>


                </div>
                <!-- /.box-body -->


            </div>

            <div class="modal-footer">

                <button type="submit" class="btn btn-default" id="btndelete" name="btndelete" style="color: red">Delete</button>

                <button type="submit" class="btn btn-primary" id="btnupdate" name="btnupdate">Update</button>

                <input type="text" id="PatientID" name="PatientID"  hidden>
            </div>

        </form>

    </div>

</div>

</div>

<!--end boostrap modal (update patient details)-->


<!--boostrap modal (add package for patient)-->

<div class="modal" id="modalfade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add package</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>        
  <div class="modal-body">
    <form action="patient.php" id="formpackage" method="post">
        <div class="form-group">
            <label>Select package</label><br>
            <select id="selectpackage" class="combo" name="selectpackage" style="width: 400px; height: 35px;">
                <option value="">Select package</option>
                <?php

                $query = "SELECT * FROM Package";
                $result1 = mysqli_query($connection, $query); ?>

                <?php while ($row1 = mysqli_fetch_array($result1)):; ?>
                    
                    <option value="<?php echo $row1[0]; ?>" getprice ="<?php echo $row1[3]; ?>"><?php echo $row1[1]; ?></option>

                <?php endwhile; ?>

            </select> 
            <br><br>
            <div class="form-group">
                <label for="exampleInputEmail1">Amount</label>
                <input class="form-control" id="amount" placeholder="Enter price"
                type="text" name="amount"  style="width: 300px;" required>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="savepackage" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
</div>
</div>
</div>

<!--end boostrap modal (add package for patient)-->

<!-- start script -->

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


// set package amount after select package 

$("#selectpackage").change(function (){
    var i = $('#selectpackage option:selected').index();
            // alert('Selected Index is: ' +i);
            if (i != 0) {
                var value = $('#selectpackage option:selected').attr("getprice");
                // alert(value);
                $('#amount').val(value);                
            }else{
                $('#amount').val("");
            }
        });

// end set package amount after select package 


// save patient package

$("#savepackage").click(function (){
    var i = $('#selectpackage option:selected').index();

    if (i != 0) {
        $.ajax({
            method: "POST",
            url: "BackEnd/Patient/savepackage.php",
            data: $("#formpackage").serialize(),

            success: function (res) {
                        // alert(res);
                        if ($.trim(res) === "savepackage") {

                            swal({
                                title: "Package successfully saved!",
                                text: "",
                                icon: "success",
                                button: "OK",
                            });

                            window.location = 'patient.php';
                        }else{
                            window.location = 'patient.php';
                        }
                        
                    }

                });
    }else{
        window.location = 'patient.php';
    }
});

// end save patient package


// delete patient------------------------------------------


$("#btndelete").click(function () {

    $.ajax({

        method: "POST",
        url: "BackEnd/Patient/deletepatient.php",
        data: $("#formupdate").serialize(),

        success: function (res) {
            if ($.trim(res) === "patientdelete" ) {                              
                swal({
                    title: "Patient successfully delete",
                    text: "",
                    icon: "success",
                    buttons: true,
                    dangerMode: false,
                })
                    .then((willDelete) => { // delete == ok button
                        if (willDelete) {
                            swal("Successfully deleted!", {
                              icon: "success",
                          });
                            window.location = 'patient.php';
                        }else{

                         window.location = 'patient.php';
                     }


                 });
                }

            }

        });
});


// end delete patient------------------------------------------


// add new patient record --------------------------------------

// $(".btntest").click(function () {
//     var id = $(this).attr("bt");

//         // window.location = 'patientRecords.php';

//         window.location.href = "patientRecords.php?pid="+id+" ";
//     });

// end add new patient record --------------------------------------


// edit patient----------------------------------------------

$(".btnedit").click(function () {
    var id = $(this).attr("bt");

    $("#PatientID").val(id);

    $.ajax({

        method: "POST",
        url: "BackEnd/Patient/editPatient.php",
        data: {id: id},

        success: function (res) {
                    // alert(res);
                    var js = JSON.parse(res);
                    //alert(js);
                    for (i = 0; i < js.length; i++) {

                        var regno = js[i].RegNo;
                        var name = js[i].FullName;
                        var dob = js[i].DOB;
                        var blood = js[i].BloodGroup;

                        var conmobile = js[i].ContactMobile;
                        var conhome = js[i].ContactHome;
                        var conoffice = js[i].ContactOffice;

                        var add1home = js[i].AddressHome1;
                        var add2home = js[i].AddressHome2;
                        var cityhome = js[i].AddressHomeCity;

                        var add1office = js[i].AddressOffice1;
                        var add2office = js[i].AddressOffice2;
                        var cityoffice = js[i].AddressOfficeCity;

                    }

                    $('#modelRegNo').val(regno);
                    $('#modelfullname').val(name);
                    $('#modeldob').val(dob);
                    $('#modelbloodgroup').val(blood);

                    $('#modelconmob').val(conmobile);
                    $('#modelconhome').val(conhome);
                    $('#modelconoff').val(conoffice);

                    $('#modelad1home').val(add1home);
                    $('#modelad2home').val(add2home);
                    $('#modelcityhome').val(cityhome);

                    $('#modelad1off').val(add1office);
                    $('#modelad2off').val(add2office);
                    $('#modelcityoff').val(cityoffice);


                    $('#myModal').modal();

                }

            });

});


// end edit patient---------------------------------------------------------------------


// save patient-----------------------------------------------------------

$("#id").click(function () {

    var regNo = document.getElementById("RegNo").value;
    var name = document.getElementById("fullname").value;
    var dob = document.getElementById("dob").value;
    var contactno = document.getElementById("cmob").value;

    if (regNo == '') {
        swal("Fill Register No");
    }else if (name == '') {
        swal("Fill Patient Name");
    }else if (dob == '') {
        swal("Fill Date of birth");
    }else if (contactno == '') {
        swal("Fill Mobile No");
    }else{

        $.ajax({


            method: "POST",
            url: "BackEnd/Patient/savepatient.php",
            data: $("#form").serialize(),

            success: function (res) {

                if ($.trim(res) === "save" ) {
                    
                    swal({
                        title: "Patient successfully save",
                        text: "you want to add package or test?",
                        icon: "success",
                        buttons: true,
                        dangerMode: false,
                    })
                    .then((willDelete) => { // delete == ok button
                        if (willDelete) {

                         $('#modalfade').modal();
                     }else{

                        window.location = 'patient.php';
                    }


                });

                }
            }

        });

    }

});


// end save patient---------------------------------------------------------


// update patient--------------------------------------

$("#btnupdate").click(function (){
    $.ajax({

        method: "POST",
        url: "BackEnd/Patient/updatepatient.php",
        data: $("#formupdate").serialize(),

        success: function (res) {

            if ($.trim(res) === "update" ) {
                
                swal({
                    title: "Patient successfully update",
                    text: "you want to update package or test?",
                    icon: "success",
                    buttons: true,
                    dangerMode: false,
                })
                    .then((willDelete) => { // delete == ok button
                        if (willDelete) {
                            $('#modalfade').modal();
                        }else{

                            window.location = 'patient.php';
                        }

                    });

                }
            }

        });
});


// end update patient-------------------------------------------------------------------


//////////////////////////////////////////////////////////////////////////////////////

$("#cmob").keyup(function () {

    var contact = $('#cmob').val();

    if (contact.length > 9) {

        $.ajax({

            method: "POST",
            url: "BackEnd/Patient/patientcotactvalidation.php",
            data: {contact: contact},

            success: function (res) {
                
               if($.trim(res) === "already"){
                swal("Contact is already exists");
            }
        }

    });

    }

});



/////////////////////////////////////////////////////////////////////////////////////////////////////////////

$("#modelconmob").keyup(function () {

    var contact = $('#modelconmob').val();

    if (contact.length > 9) {

        $.ajax({

            method: "POST",
            url: "BackEnd/Patient/patientcotactvalidation.php",
            data: {contact: contact},

            success: function (res) {
                
               if($.trim(res) === "already"){
                swal("Contact is already exists");
            }
        }

    });

    }

}); 


///////////////////////////////////////////////////////////////////////////////////////////////////////

$("#RegNo").keyup(function () {

    var regno = $('#RegNo').val();

    $.ajax({

        method: "POST",
        url: "BackEnd/Patient/registerno.php",
        data: {regno: regno},

        success: function (res) {;
           if($.trim(res) === "already"){
            swal("Register no already exists");
        }
    }

});        

});  



 }); // end document.ready function------------------------------------------------------------------

// check required fileds and save patient ---------------------------------------------

// function checkForm() {
//     var regNo = document.getElementById("RegNo").value;
//     // var name = document.getElementById("fullname").value;
//     // var dob = document.getElementById("dob").value;
//     // var conMobile = document.getElementById("cmob").value;

//     if (regNo != ''  ) {
    

//     }

//  }

// end check required fileds and save patient ---------------------------------------------



</script>
<?php include_once "footer.php"; ?>

<?php mysqli_close($connection); ?>
