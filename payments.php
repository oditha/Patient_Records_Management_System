<?php
ob_start();
session_start();

if (!isset($_SESSION['USERNAME'])){

    header("Location: index.php");

}

$PAGE_TITLE = "Payment history";

$PAGE_DESCRIPTION = "";

include_once "header.php";
require_once('inc/connection.php');
require_once('inc/functions.php');


?>


<div class="row">

    <div class="col-md-12">

        <div class="box box-danger">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
              <label for="exampleFormControlSelect1">Select Patient</label>
              <select class="selectpicker" id="selectpatient" name="selectpatient" data-show-subtext="true" data-live-search="true" style="width: 350px;">
                <?php
                $query = "SELECT * FROM Patient WHERE isDelete = 'Active'";
                $result1 = mysqli_query($connection, $query); ?>

                <option></option>

                <?php while ($row1 = mysqli_fetch_array($result1)):; ?>

                    <option value="<?php echo $row1[0]; ?>" getprice ="<?php echo $row1[3]; ?>"><?php echo "$row1[2]"." ("."$row1[1]"." )"; ?></option>

                <?php endwhile; ?>

                ?>


            </select>





        </div><br>
        <!-- /.box-body -->
    </div>

</div>

</div>


    <div class="box box-primary collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title" style="font-weight:bold; color: blue;">Test Payment History</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="tabletest" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">

                <thead>
                    <tr role="row">
                         <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style="width: 100px;" aria-sort="ascending"
                        aria-label="Rendering engine: activate to sort column descending">id
                    </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style="width: 100px;" aria-sort="ascending"
                        aria-label="Rendering engine: activate to sort column descending">Date
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                    style="width: 231px;" aria-label="Browser: activate to sort column ascending">Test name
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                style="width: 150px;" aria-label="Platform(s): activate to sort column ascending">Test amount
            </th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
            style="width: 150px;" aria-label="Platform(s): activate to sort column ascending">Doctor
        </th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
        style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">Action
    </th>
</tr>
</thead>
<tbody id="testtbl">
</tbody>

</table>
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->


<div class="box box-success collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title" style="font-weight:bold; color: green;">Package Payment History</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="tabledrug" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">

            <thead>
                <tr role="row">
                     <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style="width: 100px;" aria-sort="ascending"
                        aria-label="Rendering engine: activate to sort column descending">id
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                    style="width: 100px;" aria-sort="ascending"
                    aria-label="Rendering engine: activate to sort column descending">Date
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                style="width: 231px;" aria-label="Browser: activate to sort column ascending">Package name
            </th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
            style="width: 150px;" aria-label="Platform(s): activate to sort column ascending">Package amount
        </th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
        style="width: 150px;" aria-label="Platform(s): activate to sort column ascending">Doctor
    </th>
    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
    style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">Action
</th>
</tr>
</thead>
<tbody id="drugstbl">

</tbody>

</table>
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->


<script>

    $(document).ready(function () {

        // $('#table_id').DataTable({
        //     'paging': true,
        //     'lengthChange': true,
        //     'searching': true,
        //     'ordering': false,
        //     'info': true,
        //     'autoWidth': true
        // });

        // $('#table_id2').DataTable({
        //     'paging': true,
        //     'lengthChange': true,
        //     'searching': true,
        //     'ordering': false,
        //     'info': true,
        //     'autoWidth': true
        // });


        $("#tabletest").on('click', '.btnRemoveTest', function () {

            var currentRow = $(this).closest('tr');
            var id = currentRow.find('td:eq(0)').text();

            swal({
                title: "",
                text: "Are you sure delete recorde?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $(this).closest('tr').remove();
                $.ajax({
                    method: "POST",
                    url: "BackEnd/PatientPayment/deleteTestPayment.php",
                    data: {id: id},

                    success: function (res){
                        if ($.trim(res)=== "delete") {

                            swal("Successfully deleted!", {
                              icon: "success",
                          });
                        }

                    }
                });
            }
        });


        });

        $("#tabledrug").on('click', '.btnRemovePack', function () {

            var currentRow = $(this).closest('tr');
            var id = currentRow.find('td:eq(0)').text();

            swal({
                title: "",
                text: "Are you sure delete recorde?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $(this).closest('tr').remove();
                $.ajax({
                    method: "POST",
                    url: "BackEnd/PatientPayment/deletePackPayment.php",
                    data: {id: id},

                    success: function (res){
                        if ($.trim(res)=== "delete") {

                            swal("Successfully deleted!", {
                              icon: "success",
                          });
                        }

                    }
                });
            }
        });

        });




        // $(".btnremove").click(function (){
        //     var id = $(this).attr("bt");

        //     swal({
        //         title: "",
        //         text: "Are you sure delete recorde?",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //     .then((willDelete) => {
        //       if (willDelete) {

        //         $.ajax({
        //             method: "POST",
        //             url: "BackEnd/Patient_Record/deletePatientRec.php",
        //             data: {id: id},

        //             success: function (res){
        //                 if ($.trim(res)=== "delete") {

        //                     swal("Successfully deleted!", {
        //                       icon: "success",
        //                   });
        //                     window.location = 'patientTestHistory.php';
        //                 }
        //             }
        //         });
        //     }
        // });

        // });

    }); 


    $("#selectpatient").change(function (){
        var i = $('#selectpatient option:selected').index();
            //alert(i);
            if (i != 0) {
                var id = $('#selectpatient option:selected').val();
            //alert(id);

            $.ajax({
                method: "POST",
                url: "BackEnd/PatientPayment/loadPackagePayment.php",
                data: {id: id},

                success: function(res){
                    var js = $.parseJSON(res);
                    //alert(js);
                    for(i = 0; i < js.length; i++){
                        var idpackpay = js[i].idPackagePayment;
                        var date = js[i].PaymentDate;
                        var packname = js[i].PackName;
                        var packamount = js[i].Amount;
                        var drgdoctor = js[i].Doctor;
                        //alert(date);
                        

                        $('#drugstbl').append("<tr><td>"+idpackpay+"</td><td>"+date+"</td><td>"+packname+"</td><td>"+packamount+"</td><td>"+drgdoctor+"</td> <td><button class='btn btn-primary btnRemovePack' id='btnRemovePack'>Delete</button></td> </tr>");
                    }
                }

            });   


            $.ajax({
                method: "POST",
                url: "BackEnd/PatientPayment/loadTestPayment.php",
                data: {id: id},

                success: function(res){
                    var js = $.parseJSON(res);
                    //alert(js);
                    for(i = 0; i < js.length; i++){
                        var idtestpay = js[i].idTestPayment;
                        var date = js[i].PaymentDate;
                        var testname = js[i].TestName;
                        var testcost = js[i].Amount;
                        var drgdoctor = js[i].Doctor;
                        //alert(date);

                        $('#testtbl').append("<tr><td>"+idtestpay+"</td><td>"+date+"</td><td>"+testname+"</td><td>"+testcost+"</td><td>"+drgdoctor+"</td> <td><button class='btn btn-primary btnRemoveTest' id='btnRemoveTest'>Delete</button></td> </tr>");
                    }
                }

            });               
        }
    });


</script>
<?php include_once "footer.php"; ?>

<?php mysqli_close($connection); ?>
