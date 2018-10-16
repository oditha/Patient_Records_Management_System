<?php

ob_start();
session_start();

if (!isset($_SESSION['USERNAME'])){

    header("Location: index.php");

}

$PAGE_TITLE = "Patient records";

$PAGE_DESCRIPTION = "";

include_once "header.php";
require_once('inc/connection.php');
require_once('inc/functions.php');

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

        <div class="box box-warning">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <div class="box-body" style=" height: 1000px;">

                <div class="row">

                    <div class="col-md-4"> <!-- patient select div -->

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Patient</label><br>
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
                            <br><br>
                            <input type="text" id="patientID" style="width: 100px; float: right;" placeholder="patient id" hidden="">

                        </div>
                        <br>


                        <!-- <div class="col-md-4">  --><!-- test select div --> 
                            <div class="form-group">
                                <label>Select test</label><br>

                                <select class="selectpicker" id="framework" name="framework[]" data-show-subtext="true" data-live-search="true">

                                   <?php
                                   $query = "SELECT * FROM Test WHERE isDelete = 'Active'";
                                   $result1 = mysqli_query($connection, $query); ?>

                                   <option></option>

                                   <?php while ($row1 = mysqli_fetch_array($result1)):; ?>

                                    <option value="<?php echo $row1[0]; ?>" getprice ="<?php echo $row1[4]; ?>"><?php echo "$row1[2]"; ?></option>

                                <?php endwhile; ?>

                                ?>


                            </select>
                            <br>

                            

                        </div>   

                        <table id="tabletest" class="table table-bordered table-striped dataTable" role="grid"
                        aria-describedby="example1_info">
                        <thead>
                            <tr role="row1">
                                <th contenteditable="" class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 10px;" aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending" hidden="">id
                            </th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 200px;" aria-sort="ascending"
                            aria-label="Rendering engine: activate to sort column descending">Test Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        style="width: 100px;" aria-label="Browser: activate to sort column ascending">
                        Amount
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                    style="width: 120px;" aria-label="Browser: activate to sort column ascending" hidden="">
                    idpatient
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                style="width: 120px;" aria-label="Browser: activate to sort column ascending" hidden="">
                iddoctor
            </th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
            style="width: 120px;" aria-label="Browser: activate to sort column ascending" hidden="">
            docname
        </th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
        style="width: 80px;" aria-label="Browser: activate to sort column ascending">
        Action
    </th>
</thead>
<tbody id="testtbl">
</tbody>

</table>

<!-- </div>  --><!-- test select div -->




</div> <!-- patient select div -->

<div class="col-md-4"> <!-- doctor select div -->

    <div class="form-group">
        <label for="exampleFormControlSelect1">Select Doctor</label><br>
        <select class="selectpicker" id="selectdoctor" name="selectdoctor" data-show-subtext="true" data-live-search="true">

            <?php
            $query = "SELECT * FROM Doctor WHERE isDelete = 'Active'";
            $result1 = mysqli_query($connection, $query); ?>

            <option></option>

            <?php while ($row1 = mysqli_fetch_array($result1)):; ?>

                <option value="<?php echo $row1[0]; ?>"><?php echo "Dr. "."$row1[1]"." ("."$row1[2]"." )"; ?></option>
                ?>
            <?php endwhile; ?>

        </select>

        <br><br>

        <!-- <button type="button" class="btn btn-primary" style="float: left;">Add new</button> -->
        <input type="text" id="doctorID" style="width: 100px; float: right;" placeholder="doctor id" hidden="">

    </div><br>


    <!-- <div style="height: 86px;">  </div> -->

    <div class="form-group"> <!-- add drug table -->

        <label>Select drugs</label><br>

        <select class="selectpicker" id="selectdrug" name="selectdrug" data-show-subtext="true" data-live-search="true" style="width: 300px; float: left;"> 
            <option value=""></option>
            <?php
            $query = "SELECT * FROM Drug WHERE isDelete = 'Active' ORDER BY DrugName ";
            $result1 = mysqli_query($connection, $query); ?>

            <?php while ($row1 = mysqli_fetch_array($result1)):; ?>

                <option value="<?php echo $row1[0]; ?>" ><?php echo $row1[1]; ?></option>

            <?php endwhile; ?>

            ?>


        </select>
        <!-- <div class="form-group"> -->
            <input class="form-control" type="text" id="drugdose" placeholder="Enter drug dose" style="width: 115px; float: right;">

            <!-- </div> -->
        </div>


        <table id="table_id" class="table table-bordered table-striped dataTable" role="grid"
        aria-describedby="example1_info">
        <thead>
            <tr role="row">
                <th contenteditable="" class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                style="width: 10px;" aria-sort="ascending"
                aria-label="Rendering engine: activate to sort column descending" hidden="">id
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
            style="width: 200px;" aria-sort="ascending"
            aria-label="Rendering engine: activate to sort column descending">Drug Name
        </th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
        style="width: 100px;" aria-label="Browser: activate to sort column ascending">
        Dose
    </th>
    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
    style="width: 120px;" aria-label="Browser: activate to sort column ascending" hidden="">
    idpatient
</th>
<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
style="width: 120px;" aria-label="Browser: activate to sort column ascending" hidden="">
iddoctor
</th>
<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
style="width: 120px;" aria-label="Browser: activate to sort column ascending" hidden="">
docname
</th>
<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
style="width: 80px;" aria-label="Browser: activate to sort column ascending">
Action
</th>
</tr>
</thead>
<tbody id="drugstbl">
</tbody>

</table> <!-- add drug table -->


</div>  <!-- doctor select div -->


<div class="col-md-4"> 

    <div class="form-group">
        <label for="exampleFormControlSelect1">Current Package</label>
        <input type="text" class="form-control" id="packageName">

        <input type="text" id="packageid" placeholder="packeage id" style="width: 100px; " hidden="">
        <input type="text" id="packagecost" placeholder="package price" style="width: 100px; " hidden="">
        <input type="text" id="idrecorde" placeholder="pack payment id" style="width: 120px; " hidden="">
        <!-- <div class="checkbox"> --> 
            <label><input type="checkbox" id="check" name="check" value="">Add package this record</label>
            <!-- </div> -->
            <br>

        </div>
            
            <input type="text" id="amount" placeholder="Total amount">
        <!-- <button type="button" class="btn btn-default" id="cancel" style="width: 120px; color: red">Cancel</button> -->

        <button type="button" class="btn btn-primary" id="save" name="save" style="width: 120px; float: right; ">Save</button>
    </div>

</div>

</div>
<!-- /.box-body -->
</div>

</div>

</div>


<script>

    $(document).ready(function (e) {

        $('#example1').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': false,
            'ordering': false,
            'info': false,
            'autoWidth': false
        });


        $("#tabletest").on('click', '.btnRemoveTest', function () {
            $(this).closest('tr').remove();

            var table = document.getElementById("tabletest"), sumVal = 0;

            for(var i = 1; i < table.rows.length; i++)
            {
                sumVal = sumVal + parseInt(table.rows[i].cells[2].innerHTML);
            }

            var getcurrentPrice = $("#amount").val();
            currentPrice = parseInt(getcurrentPrice);

            if (currentPrice == '') {
                $('#amount').val(sumVal);

            }else{
                if ($("#check").is(':checked')) {
                    var getpackValue = $("#packagecost").val();
                    packValue = parseInt(getpackValue);

                    $('#amount').val(sumVal + packValue);
                }else{
                    $('#amount').val(sumVal);
                }
            }


        });

        $("#table_id").on('click', '.btnRemoveDrug', function () {
            $(this).closest('tr').remove();
        });


// set patient id after select patient 

$("#selectpatient").change(function (){

    $("#check").prop('checked', false); 
    var i = $('#selectpatient option:selected').index();
            // alert('Selected Index is: ' +i);
            if (i != 0) {
                var id = $('#selectpatient option:selected').val();
                // alert(value);
                $('#patientID').val(id);

                $.ajax({

                    method: "POST",
                    url: "BackEnd/Patient_Record/loadPackage.php",
                    data: {id: id},

                    success: function (res) {
                        var js = JSON.parse(res);

                        for (i = 0; i < js.length; i++) {
                            var idrecorde = js[i].idRecords;
                            var packageid = js[i].idPackage;
                            var packagename = js[i].PackageName;
                            var packagecost = js[i].PackagePriceMember;

                        }

                        $('#packageid').val(packageid);
                        $('#packageName').val(packagename);
                        $('#packagecost').val(packagecost);
                        $('#idrecorde').val(idrecorde);
                        $('#amount').val(0);
                    }

                });

            }else{
                $('#patientID').val("");
                $('#packageid').val("");
                $('#packageName').val("");
                $('#packagecost').val("");
                $('#amount').val(0);
                $("#check").prop('checked', false); 
            }
        });

// end patient id after select patient 


// set doctor id after select doctor 

$("#selectdoctor").change(function (){
    var i = $('#selectdoctor option:selected').index();
            // alert('Selected Index is: ' +i);
            if (i != 0) {
                var value = $('#selectdoctor option:selected').val();
                // alert(value);
                $('#doctorID').val(value);                
            }else{
                $('#doctorID').val("");
            }
        });

// end doctor id after select doctor 


});



//////---------------------------add table rows



$( document ).ready(function() {

    document.getElementById("packageName").readOnly = true; 

    $("#save").click(function (){

        var patient=$("#selectpatient option:selected").text();
        var doctor=$("#selectdoctor option:selected").text();
        var getcurrentPrice = $("#amount").val();


        if (patient == "" ) {
            swal("Select Patient First");
        }else if (doctor == "") {
            swal("Select Doctor First");
        }else if (getcurrentPrice == 0) {
            swal("Select Package or Test First");
        }else{
            var table=$('#drugstbl'); // add drug to patient

            jsonObject=[];

            table.find('tr').each(function (i){

                var $tds=$(this).find("td");
                iddrug=$tds.eq(0).text();
                drugName=$tds.eq(1).text();
                drugDose=$tds.eq(2).text();
                idpatient=$tds.eq(3).text();
                iddoctor=$tds.eq(4).text();
                drugdoctor=$tds.eq(5).text();


                item={};
                item['idDrug']=iddrug;
                item['drugName']=drugName;
                item['drugDose']=drugDose;
                item['idpatient']=idpatient;
                item['iddoctor']=iddoctor;
                item['drugdoctor']=drugdoctor;
                jsonObject.push(item);

            });

            var json =JSON.stringify(jsonObject);

            //alert(json);
            $.ajax({
                method: "POST",
                url: "BackEnd/Patient_Record/savePatientDrugs.php",
                data: {json:json },

                success:function(data){

                    swal("Drug record Added");


                }

            });// add drug to patient


            var amount=$("#amount").val();

                       var table1=$('#testtbl'); // add test to patient
                       jsonObject1=[];

                       table1.find('tr').each(function (i){

                        var $tds1=$(this).find("td");
                        idtest=$tds1.eq(0).text();
                        test=$tds1.eq(1).text();
                        price=$tds1.eq(2).text();
                        idpatient=$tds1.eq(3).text();
                        iddoctor=$tds1.eq(4).text();
                        drugdoctor=$tds1.eq(5).text();


                        item1={};
                        item1['idtest']=idtest;
                        item1['test']=test;
                        item1['price']=price;
                        item1['idpatient']=idpatient;
                        item1['iddoctor']=iddoctor;
                        item1['drugdoctor']=drugdoctor;
                        jsonObject1.push(item1);

                    });

                       var json1 =JSON.stringify(jsonObject1);
                        //alert(json1);

                        $.ajax({
                            method: "POST",
                            url: "BackEnd/Patient_Record/savePatientTest.php",
                            data: {json1:json1,amount:amount },

                            success:function(res){

                                swal("Test record Added");


                            }

            });// add test to patient



                        // insert package payment

                        if ($('#check').is(':checked')) {

                            var idrecorde=$("#idrecorde").val();
                            var amount=$("#amount").val();
                            var packagecost=$("#packagecost").val();
                            var packagename=$("#packageName").val();
                            var doctor = $('#selectdoctor option:selected').text();
                            //alert(idrecorde);
                            $.ajax({
                                method: "POST",
                                url: "BackEnd/Patient_Record/insertPackPayment.php",
                                data: {idrecorde:idrecorde,amount:amount,packagecost:packagecost,doctor:doctor,packagename:packagename},

                                success:function(res){

                                    swal("Payment Recoded record Added");


                                }

                            });
                        }

                    }


                });



    $("#selectdrug").change(function (){
        $("#drugdose").focus();
    });



    $( "#drugdose" ).keypress(function( event ) {
      if ( event.which == 13 ) {
        var drug=$("#selectdrug option:selected").text();
        var drugdoctor=$("#selectdoctor option:selected").text();
        var iddrug=$("#selectdrug option:selected").val();
        var dose=$("#drugdose").val();
        var idpatient=$('#patientID').val();
        var iddoctor=$('#doctorID').val();

        if (idpatient == "") {
            swal("Select Patient First");
            $("#drugdose").val("");
        }else if (iddoctor == "") {
            swal("Select Doctor First");
            $("#drugdose").val("");
        }else if ($("#selectdrug option:selected").text() == "") {
            swal("Select Drugs First");
            $("#drugdose").val("");
        }else if (dose == "") {
            swal("Select Drug Dose First");
        }else{
            $('#drugstbl').append("<tr><td class=\"idDrug\" hidden>"+iddrug+"</td><td class=\"drugName\">"+drug+"</td><td class=\"drugDose\">"+dose+"</td><td hidden>"+idpatient+"</td><td hidden>"+iddoctor+"</td><td hidden>"+drugdoctor+"</td><td> <button class='btn btn-primary btnRemoveDrug' id='btneditDrug' >Remove</button> </td></tr>");
            //$("#selectdrug").attr('selectedIndex', -1);
            $("#selectdrug option:selected").val("");
            $("#drugdose").val("");

        }
    }
});

    $("#framework").change(function (){
        var i = $('#framework option:selected').index();
            // alert('Selected Index is: ' +i);
            if (i != 0) {
                var idtest = $('#framework option:selected').val();
                var test=$("#framework option:selected").text();
                var drugdoctor=$("#selectdoctor option:selected").text();
                var price = $('#framework option:selected').attr("getprice");
                var idpatient=$('#patientID').val();
                var iddoctor=$('#doctorID').val();

                if (idpatient == "") {
                    $("#check").prop('checked', false); 
                    swal("Select Patient First");
                }else if (iddoctor == "") {
                    $("#check").prop('checked', false); 
                    swal("Select Doctor First");
                }else{
                   $('#testtbl').append("<tr><td class=\"idtest\" hidden>"+idtest+"</td><td class=\"test\">"+test+"</td><td class=\"price\">"+price+"</td><td hidden>"+idpatient+"</td><td hidden>"+iddoctor+"</td><td hidden>"+drugdoctor+"</td> <td><button class='btn btn-primary btnRemoveTest' id='btneditTest'>Remove</button></td> </tr>");



               }

           }

           var table = document.getElementById("tabletest"), sumVal = 0;

           for(var i = 1; i < table.rows.length; i++)
           {
            sumVal = sumVal + parseInt(table.rows[i].cells[2].innerHTML);
        }
        
        var getcurrentPrice = $("#amount").val();
        currentPrice = parseInt(getcurrentPrice);

        if (currentPrice == '') {
            $('#amount').val(sumVal);

        }else{
            if ($("#check").is(':checked')) {
                var getpackValue = $("#packagecost").val();
                packValue = parseInt(getpackValue);

                $('#amount').val(sumVal + packValue);
            }else{
                $('#amount').val(sumVal);
            }
        }




    });

    $("#check").click(function() {

        var getcurrentPrice = $("#amount").val();
        currentPrice = parseInt(getcurrentPrice);

        var getpackValue = $("#packagecost").val();
        packValue = parseInt(getpackValue);

        if (getpackValue == "") {
            swal("Select PatientFirst");
            $("#check").prop('checked', false); 
        }else{
            if(this.checked){
                if (getcurrentPrice != '') {
                    var total = currentPrice + packValue;
                    $('#amount').val(total);               
                }else{
                    $('#amount').val(getpackValue);
                }
            }
            if(!this.checked){
                if (getcurrentPrice != '') {
                    var total = currentPrice - packValue;
                    $('#amount').val(total);
                }
            }
        }

    });



});


</script>
<?php include_once "footer.php"; ?>

<?php mysqli_close($connection); ?>
