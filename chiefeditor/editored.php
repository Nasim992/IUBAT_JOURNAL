<?php
session_start();
error_reporting(0);
include('../link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: ../login"); 
    exit;
    }
    else  
    {  
     // Check that the Editor is logged in or not section starts here  
     $editoremail = $_SESSION["email"];

     $sql = "SELECT chiefeditor.id,chiefeditor.fullname,chiefeditor.password,chiefeditor.contact FROM chiefeditor WHERE email='$editoremail'"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
     
     // Check that the Editor is logged in or not section ends here 

    //  Remove as a Reviewer section starts Here 
    if(isset($_POST['editor-remove'])) {
      $paperid = $_POST['paperid'];
      $username = $_POST['username'];

      $query = "SELECT COUNT(*) as total_rows FROM reviewertable where  username='$username' and action IS  NULL";
      $stmt = $dbh->prepare($query);
                              
       // execute query
       $stmt->execute();
                              
       // get total rows
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       $total_re = $row['total_rows'];
      $action = 1;
      $actionz= 0;
      include '../link/linklocal.php';
      $sqlremovereview="update reviewertable set action=$action where paperid='$paperid' and username='$username'";

      if(mysqli_query($link, $sqlremovereview))
      {
      echo "<script>alert('Reviewer Removed Successfully for this paper.');</script>";
        // header("refresh:0;url=reviewerdetails");
      }
      else {
          echo "<script>alert('Something went wrong');</script>";
          // header("refresh:0;url=reviewerdetails");
      }

        if ($total_re-1==0) {
          include '../link/linklocal.php';
              $sqlremovereviewauthor="update author set reviewerselection=$actionz where username='$username'";
              mysqli_query($link,$sqlremovereviewauthor);
        }

        }
         // Remove as  a Reviewer Section Ends Here 
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
    <script src="js/jquery-3.5.1.slim.min.js"></script>
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
            <h6>ASSOCIATE EDITORED PAPER</h6>
            <hr class="bg-secondary">
            <div class="table-responsive table-responsive-lg table-responsize-xl table-responsive-sm p-4">
                <table id="dtBasicExample" class="table table-striped table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paper id</th>
                            <th>Editor Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody id="myTable-admin">
                        <?php $sql = "SELECT editortable.id,editortable.paperid,editortable.username,editortable.primaryemail,editortable.assigndate,editortable.endingdate,editortable.action,editortable.associateeditor from editortable where  associateeditor IS NOT NULL";
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

                                    ?>

                            <td><?php echo $authorname;?></td>
                            <td><?php echo htmlentities($result->primaryemail);?></td>
                        </tr>
                        <?php $cnt=$cnt+1;}} ?>
                    </tbody>
                </table>
            </div>
            <!-- Associate Editor Showing section ends here  -->

            <!-- Academic Editor Showing Section starts here  -->
            <h6>ACADEMIC EDITORED PAPER</h6>
            <hr class="bg-secondary">
            <div class="table-responsive table-responsive-lg table-responsize-xl table-responsive-sm p-4">
                <table id="dtBasicExample1" class="table table-striped table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paper id</th>
                            <th>Editor Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody id="myTable-admin1">
                        <?php $sql = "SELECT editortable.id,editortable.paperid,editortable.username,editortable.primaryemail,editortable.assigndate,editortable.endingdate,editortable.action,editortable.associateeditor,editortable.academiceditor from editortable where academiceditor IS NOT NULL"; 
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
<?php 

}
else {
  echo "<script>alert('You are not a Chief Editor.Try to log in as a Chief Editor');</script>";
  echo "<script type='text/javascript'> document.location = '../login'; </script>";
}

}
    
?>