<?php
session_start();
error_reporting(0);
include('../link/config.php');
include('../functions.php');
checkLoggedInOrNot();
$editoremail = $_SESSION["email"];
IsChiefEditorLoggedIn($editoremail);

    //  Remove as a Editor section starts Here 
    if(isset($_POST['editor-remove'])) {
      $paperid = $_POST['paperid'];
      $username = $_POST['username'];

      $action = 1;
      $actionz= 0;
      $sqlremovereview="update editortable set action=$action where paperid='$paperid' and username='$username'";

      if(mysqli_query($link, $sqlremovereview))
      {
      echo "<script>alert('Editor of this paper removed.');</script>";
        header("refresh:0;url=editordetails");
        exit;
      }
      else {
          echo "<script>alert('Something went wrong');</script>";
          header("refresh:0;url=editordetails");
          exit;
      }

        }
         // Remove as  a Editor Section Ends Here 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviewer Details</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="../css/admin-dashboard.css">
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>


    <!-- Author showing header sections starts  -->
    <div class="sticky-top header-floating">
        <?php include 'header.php'; ?>
    </div>
    <!-- Author showing header sections ends   -->


    <div id="mySidebar" class="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>

    <div id="main">
        <a href="#"><span class="openbtn" onclick="openNav()" id="closesign">☰</span></a>
        <a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
        <div class="container">

            <!-- Associate Editor showing section starts here  -->
            <h6>ASSOCIATE EDITOR DETAILS</h6>
            <hr class="bg-secondary">
            <div class="table-responsive table-responsive-lg table-responsize-xl table-responsive-sm p-4">
                <table id="dtBasicExample" class="table table-striped table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paper id</th>
                            <th>Editor Name</th>
                            <th>Email</th>
                            <th>Assign Date</th>
                            <th>Ending date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable-admin">
                        <?php $sql = "SELECT editortable.id,editortable.paperid,editortable.username,editortable.primaryemail,editortable.assigndate,editortable.endingdate,editortable.action,editortable.associateeditor from editortable where action IS NULL and associateeditor IS NOT NULL";
                                $query = $dbh->prepare($sql); 
                                $query->execute(); 
                                $results=$query->fetchAll(PDO::FETCH_OBJ); 
                                $cnt=1;
                                if($query->rowCount() > 0) 
                                {
                                foreach($results as $result) 
                                {   ?>
                        <tr>
                            <td><?php echo htmlentities($cnt);?></td>
                            <td class="result-color1"><?php echo htmlentities($result->paperid);?></td>

                            <?php 
                                $username = htmlentities($result->username);
                                $sql1 = "SELECT * FROM author WHERE  username='$username' ";

                                $result1 = mysqli_query($link,$sql1); 

                                $file1 = mysqli_fetch_assoc($result1);
                                
                                $title = $file1['title'];
                                $fname= $file1['firstname'];
                                $middlename= $file1['middlename'];
                                $lastname= $file1['lastname'];

                                $authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

                                $datedatabase = htmlentities($result->assigndate);
                                $date = date("d-M-Y",strtotime($datedatabase)); 
                                $endingdate = htmlentities($result->endingdate);
                                $edate = date("d-M-Y",strtotime($endingdate)); 
                                    ?>

                            <td><?php echo $authorname;?></td>
                            <td><?php echo htmlentities($result->primaryemail);?></td>
                            <td><?php echo $date;?></td>
                            <td><?php echo $edate;?></td>

                            <td>
                                <form method="post">
                                    <input type="hidden" name="paperid"
                                        value="<?php echo htmlentities($result->paperid);?>">
                                    <input type="hidden" name="username" value="<?php echo $username?>">
                                    <input class="text-danger"
                                        onclick="return confirm('Are you sure you want to remove reviewer for this paper?');"
                                        style="font-size:18px;border:none;font-weight:600;background-color:transparent;"
                                        type="submit" name="editor-remove" value="x">
                                </form>

                            </td>
                        </tr>
                        <?php $cnt=$cnt+1;}} ?>
                    </tbody>
                </table>
            </div>
            <!-- Associate Editor Showing section ends here  -->

            <!-- Academic Editor Showing Section starts here  -->
            <h6>ACADEMIC EDITOR DETAILS</h6>
            <hr class="bg-secondary">
            <div class="table-responsive table-responsive-lg table-responsize-xl table-responsive-sm p-4">
                <table id="dtBasicExample1" class="table table-striped table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paper id</th>
                            <th>Editor Name</th>
                            <th>Email</th>
                            <th>Assign Date</th>
                            <th>Ending date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable-admin1">
                        <?php $sql = "SELECT editortable.id,editortable.paperid,editortable.username,editortable.primaryemail,editortable.assigndate,editortable.endingdate,editortable.action,editortable.associateeditor,editortable.academiceditor from editortable where action IS NULL and academiceditor IS NOT NULL"; 
                                $query = $dbh->prepare($sql); 
                                $query->execute(); 
                                $results=$query->fetchAll(PDO::FETCH_OBJ); 
                                $cnt=1;
                                if($query->rowCount() > 0) 
                                {
                                foreach($results as $result) 
                                {   ?>
                        <tr>
                            <td><?php echo htmlentities($cnt);?></td>
                            <td class="result-color1"><?php echo htmlentities($result->paperid);?></td>

                            <?php 
                                $username = htmlentities($result->username);
                                $sql1 = "SELECT * FROM author WHERE  username='$username' ";

                                $result1 = mysqli_query($link,$sql1); 

                                $file1 = mysqli_fetch_assoc($result1);
                                
                                $title = $file1['title'];
                                $fname= $file1['firstname'];
                                $middlename= $file1['middlename'];
                                $lastname= $file1['lastname'];

                                $authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

                                $datedatabase = htmlentities($result->assigndate);
                                $date = date("d-M-Y",strtotime($datedatabase)); 
                                $endingdate = htmlentities($result->endingdate);
                                $edate = date("d-M-Y",strtotime($endingdate)); 
                                    ?>

                            <td><?php echo $authorname;?></td>
                            <td><?php echo htmlentities($result->primaryemail);?></td>
                            <td><?php echo $date;?></td>
                            <td><?php echo $edate;?></td>

                            <td>
                                <form method="post">
                                    <input type="hidden" name="paperid"
                                        value="<?php echo htmlentities($result->paperid);?>">
                                    <input type="hidden" name="username" value="<?php echo $username?>">
                                    <input class="text-danger"
                                        onclick="return confirm('Are you sure you want to remove reviewer for this paper?');"
                                        style="font-size:18px;border:none;font-weight:600;background-color:transparent;"
                                        type="submit" name="editor-remove" value="x">
                                </form>

                            </td>
                        </tr>
                        <?php $cnt=$cnt+1;}} ?>
                    </tbody>
                </table>
            </div>
            <!-- Academic Editor Showing Section Ends Here  -->
            <div class="mb-5"></div>
        </div>
    </div>
    <!-- Authors showing section ends here  -->
    </div>
    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script>
    $(function($) {
        $('#example').DataTable();

        $('#example2').DataTable({
            "scrollY": "300px",
            "scrollCollapse": true,
            "paging": false
        });

        $('#example3').DataTable();
    });
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    $(document).ready(function() {
        $('#dtBasicExample1').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    </script>

    <!-- Essential Js,Jquery  section ends  -->
</body>
</html>
