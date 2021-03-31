<?php
session_start();
error_reporting(0);
include('../link/config.php'); 
if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: ../login");   
    }
    else
    { 
        $email =  $_SESSION['alogin'];

        // Check that the Author is logged in or not section starts here 

        $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$email' and reviewerselection IS NOT NULL"; 
        $query = $dbh->prepare($sql); 
        $query->execute(); 
        $results=$query->fetchAll(PDO::FETCH_OBJ); 
        $cnt=1;
        if($query->rowCount() > 0) 
        {
      // Check that the Author is logged in or not section ends here 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviewer Header</title>
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/heading.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->
</head>

<body>
    <!-- Select User Name tile section starts Here  -->
    <?php  
    $authoremail = $_SESSION["email"];

    $sql1 = "SELECT * FROM author WHERE  primaryemail= '$email' ";

    $result1 = mysqli_query($link,$sql1); 

    $file1 = mysqli_fetch_assoc($result1);

    $username = $file1['username'];

    $title = $file1['title'];
    $fname= $file1['firstname'];
    $middlename= $file1['middlename'];
    $lastname= $file1['lastname'];

    $authorname = $title.' '.$middlename;

    ?>
    <!-- Select User Name title section ends here -->

    <nav class="navbar nav-class navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="dashboard"><img src="../images/Iubat-logo.png">JOURNAL</a>
        <h6 style="font-size:12px;">Welcome,<?php  echo $authorname; ?></h6>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto ul-nav">

                <ul>
                    <li class="nav-item active" title="total paper">
                        <a class="nav-link" href="reviewedpaper">Reviewed Paper</a>
                    </li>
                </ul>

                <ul>
                    <li class="nav-item active" title="total paper">
                        <a class="nav-link" href="reviewerpaper">Assigned Paper</a>
                    </li>
                </ul>

                <ul>

                    <?php  
                        $authoremail = $_SESSION["email"];

                        $sql1 = "SELECT * FROM author WHERE  primaryemail= '$authoremail' ";

                        $result1 = mysqli_query($link,$sql1); 

                        $file1 = mysqli_fetch_assoc($result1);

                        $username = $file1['username'];

                        $title = $file1['title'];
                        $fname= $file1['firstname'];
                        $middlename= $file1['middlename'];
                        $lastname= $file1['lastname'];

                        $authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

                            ?>
                    <!-- Select user  name section ends here  -->


                    <li class="nav-item active">
                        <a class="nav-link " href="../logout.php"
                            onclick="return confirm('Are you sure you want Logging out the system?');" title="Sign Out">
                            <small>(Sign Out)</small> <i class="fas fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            </ul>
        </div>
    </nav>
    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <!-- Essential Js,Jquery  section ends  -->
</body>

</html>

<?php
 }
 else {
   echo "<script>alert('You are not selected as a Reviewer.');</script>";
   echo "<script type='text/javascript'> document.location = '../login'; </script>";
 }
}
    ?>