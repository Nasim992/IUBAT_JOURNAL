<?php
session_start();
error_reporting(0);
include('../link/config.php');
include('../functions.php');
if(strlen($_SESSION['alogin'])=="") 
    {    
    header("Location: ../login"); 
    }
    else
    {  
        $authoremail = $_SESSION["email"];

        // Check that the Author is logged in or not section starts here 
        
        $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$authoremail' and reviewerselection IS NOT NULL"; 
        $query = $dbh->prepare($sql); 
        $query->execute(); 
        $results=$query->fetchAll(PDO::FETCH_OBJ); 
        $cnt=1;
        if($query->rowCount() > 0) 
        {
        // Check that the Author is logged in or not section ends here 

        // Select paper id from reviewertable section starts here

        $sql = "SELECT reviewertable.id,reviewertable.paperid,reviewertable.username,reviewertable.feedback from reviewertable Where primaryemail='$authoremail' and feedback IS NOT NULL";
        $query = $dbh->prepare($sql); 
        $query->execute(); 
        $results=$query->fetchAll(PDO::FETCH_OBJ); 
        $cnt=1; 
        if($query->rowCount() > 0) 
        {
        $arraypaperidreviewer = array();
        foreach($results as $result) 
        { 
            $paperid = htmlentities($result->paperid);
            array_push($arraypaperidreviewer,$paperid);
        }
    }
  
        // Select Paper id From reviewertable section ends here

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviewed paper</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
    <style>
    .fontSize14px {
        font-size: 14px !important;
    }

    .fontSize16px {
        font-size: 16px !important;
    }

    .fontSize13px {
        font-size: 13px !important;
    }
    </style>

</head>

<body>

    <!-- Author showing header sections starts  -->
    <div class="sticky-top header-floating">
        <?php include 'reviewer-header.php';?>
    </div>
    <!-- Author showing header sections ends   -->
    <div id="mySidebar" class="sidebar">
        <?php include 'reviewer-sidebar.php'; ?>
    </div>

    <div id="main">
        <a href="#"><span class="openbtn" onclick="openNav()" id="closesign">☰</span></a>
        <a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
        <div class="container">

            <!-- --------------------------------Reviewed paper -------------------------------- -->
            <h6>REVIEWED PAPER</h6>
            <hr class="bg-secondary">
            <div class="table-responsive">
                <table id="dtBasicExample" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="myTable">
                        <?php 
                    foreach ($arraypaperidreviewer  as $pid) {
                        $sqlreviewerselection = "SELECT paper.id,paper.paperid,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action,paper.numberofcoauthor,paper.pdate,paper.uploaddate,paper.coauthorname,paper.name1,paper.name2,paper.resubmitpaper from paper WHERE  paperid='$pid'";

                        $resultreviewerselection = mysqli_query($link,$sqlreviewerselection);
                        
                        $filereviewerselection = mysqli_fetch_assoc($resultreviewerselection);

                        $id =  $filereviewerselection['paperid'];
                        $papername = $filereviewerselection['papername'];
                        $numberofcoauthor = $filereviewerselection['numberofcoauthor']; 
                        $abstract = $filereviewerselection['abstract'];
                        $authoremailpaper = $filereviewerselection['authoremail'];
                        $name = $filereviewerselection['name'];
                        $filepathdoc = '../documents/file1/'.$filereviewerselection['name1']; 
                        $filepathpdf = '../documents/file2/'.$filereviewerselection['name2']; 
                        $filepathresubmit = '../documents/resubmit/'.$filereviewerselection['resubmitpaper']; 
                        $type = $filereviewerselection['type'];
                        $action = $filereviewerselection['action']; 

                        $mainuploaddate = $filereviewerselection['uploaddate'];

                        $uploaddate =  date("d-M-Y",strtotime($mainuploaddate));

                        $type = $filereviewerselection['type'];
                        
                        $pdatestring = $filereviewerselection['pdate'];
                        $pdate = date("d-M-Y",strtotime( $pdatestring));
                        ?>
                        <?php 
                            ?>
                        <!-- Select user  name section ends here  -->

                        <!-- Dashboard section starts  -->
                        <tr>
                            <td>
                                <div class="jumbotron">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fontSize14px">Paper ID : <?php echo $id;?></p>
                                        </div>
                                        <div>
                                            <p class="fontSize14px"><b> Status: <?php

                                                if ($action!=1) { ?>
                                                    <span style="color:goldenrod;">
                                                        <?php  echo "Pending";
                                                        } else {   ?>
                                                    </span>
                                                    <span style="color:green;">
                                                        <?php
                                                echo "Published on ".$pdate;  }  ?>
                                                    </span></b></p>
                                        </div>
                                    </div>

                                    <h5 class="display-4 fontSize16px"><?php echo $papername;?></h5>
                                    <p style="font-size:12px"><b>Uploaded On : </b><?php echo $uploaddate; ?></p>

                                </div>

                                <p class="fontSize14px"><span style="font-weight:bold">Abstract:</span>
                                    <?php echo $abstract;?></p>

                                <div class=" d-flex justify-content-between col-sm-12">
                                    <div>
                                        <a style="font-size:14px;" class="" href="<?php echo $filepathdoc ?> "
                                            target="_blank" role="button">Download as doc</a>
                                    </div>
                                    <div>
                                        <a style="font-size:14px;" class="" href="<?php echo $filepathpdf ?> "
                                            target="_blank" role="button">Download as pdf</a>
                                    </div>
                                    <?php if(!empty($filereviewerselection['resubmitpaper']))  { ?>
                                    <div>
                                        <a style="font-size:14px;" class="" href="<?php echo $filepathresubmit ?> "
                                            target="_blank" role="button">Resubmitted paper</a>
                                    </div>
                                    <?php  } ?>
                                    <div>
                                        <p><?php echo $type;?></p>
                                    </div>
                                    <div>
                                        <form action='reviewereditor' method='post'>
                                            <input type="hidden" name="paperid" value="<?php echo $id;?>">

                                            <input class="text-danger"
                                                style="font-size:15px;border:none;font-weight:600;background-color:white;"
                                                type="submit" name="reviewer-feedbacks" value="Edit your Feedback">
                                        </form>
                                    </div>
                                </div>
            </div>
            <hr>
            </td>
        </div>
        </tr>

        <!-- DashBoard Section ends  -->

        <?php } ?>
        </tbody>
        </table>

        <!-- --------------------------------Reviewed paper ----------------------------------  -->

        <div class="pb-4"></div>
    </div>
    </div>
    </div>
    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>

    <script>
    // DataTables section starts here 
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    // Datables section ends here 
    </script>

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