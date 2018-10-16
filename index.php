<?php session_start(); ?>

<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>

<?php

$username = '';
$password = '';

//check form submission
if (isset($_POST['submit'])) {
    $errors = array();

    //check username and password enterd
    if (!isset($_POST['username'])) {

        $errors [] = 'Invalid Username';
    }

    if (!isset($_POST['password'])) {

        $errors [] = 'Invalid password';
    }

    //check any errors in the form
    if (empty($errors)) {

        if ($_POST['username']=='admin' && $_POST['password']=='*222*odk*' ){

            header('Location: users.php');
            $_SESSION['USERID'] = "00001"; //idusers == database column name
            $_SESSION['USERNAME'] = "AdminMS";
            $_SESSION['TYPE'] = "Super Admin";



        }else{

            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);

            //create database query
            $query = "SELECT * FROM User WHERE UserName = '{$username}' AND Password = '{$password}' LIMIT 1 ";

            $resultSet = mysqli_query($connection, $query);

            //check username and password valid
            verify_query($resultSet);
            if (mysqli_num_rows($resultSet) == 1) { //if there have one record
                //valid user found
                $user = mysqli_fetch_assoc($resultSet);//store get result in associative array

                $_SESSION['USERID'] = $user['idUser']; //idusers == database column name
                $_SESSION['USERNAME'] = $user['UserName'];
                $_SESSION['TYPE'] = $user['Type'];
                $query = "INSERT INTO LoggingHistory (logTime, UserName, Type, IsStaff) VALUES ( NOW(), '{$username}', '{$user['Type']}', 'YES')";

                $resultSet = mysqli_query($connection, $query);

                header('Location: patient.php');

            } else {
                //invalid user
                $errors[] = 'Invalid username or password';
            }


        }




    }

}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>PRMS</b>++
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body box-success">
        <!--        <p class="login-box-msg">Sign in to start your session</p>-->

        <form action="index.php" method="post">

            <?php if (isset($errors) && !empty($errors)) {

                echo '<p class="error">Invalid username or password</p>';
            }


            ?>

            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="username"
                       name="username" <?php echo 'value ="' . $username . '"'; ?> >
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password"
                       name="password" <?php echo 'value ="' . $password . '"'; ?> >
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->
        <br>
        <a href="#">I forgot my password</a><br>
        <a hidden href="users.php" class="text-center">Register a new membership</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>

<?php mysqli_close($connection); ?>
