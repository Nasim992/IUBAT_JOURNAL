<?php 
session_start();
error_reporting(0);
include('link/config.php');
include('link/functionsql.php');
    $email = $_GET['email'];
    $password_token =$_GET['token'];
    // Reset-Password section starts here 
    if(isset($_POST['change-submit']))  
    {
        $pemail = $_POST['remail'];
        $password = md5($_POST['rpassword']);
        $passwordconf = md5($_POST['rpasswordconf']);
 
        if($password !== $passwordconf) {
            echo "<script>alert('Password does not match properly.);</script>";
        }
        else {

    // Change Password Section Starts Here 
    $sql="update author set password='".escape($password)."',validation_code='0' where primaryemail='$pemail' and validation_code='$password_token'";

    if(query($sql)) {
        echo "<script>alert('Password Changed Successfully');</script>";
        echo "<script type='text/javascript'> document.location = 'login'; </script>";

    }else
    {
        echo "<script>alert('Something went wrong!');</script>";
    }
        }
    }

    // Reset-Password section ends here 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESET PASSWORD</title>
    <?php include('link/csslinks.php') ?>
</head>
<body>
    <div style="font-size:14px; font-weight:bold;" class="container form-control-login">
        <div class="row pt-5">
            <div id="logreg-forms">
                <form class="form-signin marginbtm" method="post">
                    <div class="logo-container">
                        <img src="images/forgotpass.png" alt="">
                    </div>
                    <input style="font-size:13px;" type="hidden" id="inputEmail" class="form-control" name="remail"
                        placeholder="" value="<?php echo $email;  ?>">

                    <input style="font-size:13px;" type="password" id="inputPassword"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="rpassword" class="form-control"
                        placeholder="Enter New password" required>

                    <input style="font-size:13px;" type="password" id="inputPassword"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="rpasswordconf" class="form-control"
                        placeholder="Enter New password again" required>

                    <button class="btn btn-success btn-sm btn-block" name="change-submit" type="submit"> Change
                        password</button>
                    <div class="pb-5"></div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>