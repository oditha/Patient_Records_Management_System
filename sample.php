<?php

ob_start();
session_start();

$PAGE_TITLE = "SAMPLE";

$PAGE_DESCRIPTION = "This is DEc";

include_once "header.php";

?>

<div class="row">

    <div class="col-md-12">


        <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Expandable</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                    <option value="AL">Alabama</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->


    </div>


</div>

<script>

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

</script>

<?php include_once "footer.php"; ?>
