<?php 
session_start();
error_reporting(0);
include('../link/config.php');
include('../functions.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location:../login"); 
    } 
    else
    {  
      $email =  $_SESSION['alogin'];
     // Check that the Associate Editor is logged in or not section starts here 
     $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact,author.academiceditor from author where primaryemail='$email' and academiceditor IS NOT NULL"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
    // Check that the Associate Editor  is logged in or not section ends here 

    // Selecting Primary email from the academiceditor section starts here 
    $primaryacademic = array();

    $sqlasso = "SELECT paperid FROM editortable WHERE primaryemail='$email' and academiceditor IS NOT NULL";
    $resultasso = mysqli_query($link,$sqlasso);
    $fileasso = mysqli_fetch_assoc($resultasso);
    foreach($resultasso as $filerev) {
        array_push($primaryacademic ,$filerev['paperid']);
    }
    // Selecting Primmaryemail from the academiceditor section starts here 


    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpublished paper</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
</head>

<body>

    <!-- Author showing header sections starts  -->
    <div class="sticky-top header-floating">
        <?php
include 'header.php';
?>
    </div>
    <!-- Author showing header sections ends   -->


    <div id="mySidebar" class="sidebar">
        <?php
  include 'sidebar.php';
  ?>

    </div>

    <div id="main">

        <a href="#"><span class="openbtn" onclick="openNav()" id="closesign">☰</span></a>
        <a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
        <div class="container">
            <h6>YOUR PAPER</h6>
            <hr class="bg-secondary">
            <div class="table-responsive table-responsive-lg table-responsize-xl table-responsive-sm p-4">

                <table id="dtBasicExample" class="table table-striped table-bordered table-hover">

                    <thead>
                        <tr class="bg-secondary text-white">
                            <th>Paper Status</th>
                            <th>Paper ID</th>
                            <th>Author Name</th>
                            <th>Paper Title</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody id="myTable-admin">
                        <?php  foreach($primaryacademic as $papid)  { ?>
                        <!-- Selecting paper section starts here  -->
                        <?php $sql = "SELECT paper.id,paper.paperid,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action,paper.numberofcoauthor,paper.pdate,paper.uploaddate,paper.coauthorname,paper.resubmitpaper,paper.resubmitdate,paper.reject,paper.rejectdate from paper WHERE paperid='$papid' ORDER BY uploaddate DESC";
            $query = $dbh->prepare($sql); 
            $query->execute(); 
            $results=$query->fetchAll(PDO::FETCH_OBJ); 
            $cnt=1; 
            if($query->rowCount() > 0)  
            {
            foreach($results as $result) 
            {  
                $paperid = htmlentities($result->paperid);
                ?>
                        <!-- Selecting paper section ends here  -->
                        <tr>
                            <!-- paper Status -->
                            <td>
                                <small>
                                    <!-- Paper Status Section starts here  -->
                                    <!-- Reviewer section starts here  -->
                                    <?php 

// Selecting Primary email from the reviewertable section starts here 
$primaryemailarray = array();

$sqlreviewer = "SELECT primaryemail FROM reviewertable WHERE paperid = '$paperid'";
$resultreviewer = mysqli_query($link,$sqlreviewer );
$file = mysqli_fetch_assoc($resultreviewer);
foreach($resultreviewer as $filerev) {
    array_push($primaryemailarray,$filerev['primaryemail']);
}
// Selecting Primary email from the reviewertable section starts here 

// Selecting Primary email from the associateeditor section starts here 
$primaryemailarrayassociateeditor = array();

$sqlassociateeditor = "SELECT primaryemail FROM editortable WHERE paperid = '$paperid' and associateeditor IS NOT NULL";
$resultassociateeditor = mysqli_query($link,$sqlassociateeditor);
$fileassociateeditor = mysqli_fetch_assoc($resultassociateeditor);
foreach($resultassociateeditor as $filerev) {
    array_push($primaryemailarrayassociateeditor,$filerev['primaryemail']);
}
// Selecting Primmaryemail from the academiceditor section starts here 

// Selecting Primary email from the associateeditor section starts here 
$primaryemailarrayacademiceditor = array();
$sqlacademiceditor = "SELECT primaryemail FROM editortable WHERE paperid = '$paperid' and academiceditor IS NOT NULL";
$resultacademiceditor = mysqli_query($link,$sqlacademiceditor);
$fileacademiceditor = mysqli_fetch_assoc($resultacademiceditor );
foreach($resultacademiceditor  as $filerev) {
    array_push($primaryemailarrayacademiceditor ,$filerev['primaryemail']);
}
// Selecting Primmaryemail from the academiceditor section starts here 



 ?>
                                    <!-- Reviewer section ends here -->

                                    <?php 

$rejected = htmlentities($result->reject);
  $rejectdatestring = htmlentities($result->rejectdate);
  $rejectdate = date("d-M-Y",strtotime($rejectdatestring)); 

  $accepted = htmlentities($result->action);
  $pdatestring = htmlentities($result->pdate);
  $pdate= date("d-M-Y",strtotime($pdatestring));

  if($accepted == 1 ) {

      echo "<p class='text-success'><b>Accepted on:<br></b> ".$pdate.'</p>';
      // Reviewer showing section
      echo "<b><span class='text-success'>Reviewed by:</span></b>".'<br>';
      $cnt1 =1; 
      foreach ($primaryemailarray as $err) {
        $sqlauthorname1 = "SELECT * FROM author WHERE  primaryemail= '$err' ";
        $resultauthorname1 = mysqli_query($link,$sqlauthorname1); 
        $fileauthorname1 = mysqli_fetch_assoc($resultauthorname1);
            $title = $fileauthorname1['title'];
            $fname= $fileauthorname1['firstname'];
            $middlename= $fileauthorname1['middlename'];
            $lastname= $fileauthorname1['lastname'];
            $authorname23 =  $title.' '.$fname.' '.$middlename.' '.$lastname;
         echo $cnt1 .'.'.$authorname23.'<br>';
         $cnt1 = $cnt1 + 1;
      }
    //   Reviewing paper selection section ends here 

          // Associate Editor showing section
          echo "<b><span class='text-info'>Associate Editor:</span></b>".'<br>';
          $cnt1 =1; 
          foreach ($primaryemailarrayassociateeditor as $err) {
            $sqlauthorname1 = "SELECT * FROM author WHERE  primaryemail= '$err' ";
            $resultauthorname1 = mysqli_query($link,$sqlauthorname1); 
            $fileauthorname1 = mysqli_fetch_assoc($resultauthorname1);
                $title = $fileauthorname1['title'];
                $fname= $fileauthorname1['firstname'];
                $middlename= $fileauthorname1['middlename'];
                $lastname= $fileauthorname1['lastname'];
                $authorname23 =  $title.' '.$fname.' '.$middlename.' '.$lastname;
             echo $cnt1 .'.'.$authorname23.'<br>';
             $cnt1 = $cnt1 + 1;
          }
        //   Associate Editor Section Ends Here 

                 // Academic  Editor showing section
                 echo "<b><span class='text-info'>Academic Editor:</span></b>".'<br>';
                 $cnt1 =1; 
                 foreach ($primaryemailarrayacademiceditor as $err) {
                   $sqlauthorname1 = "SELECT * FROM author WHERE  primaryemail= '$err' ";
                   $resultauthorname1 = mysqli_query($link,$sqlauthorname1); 
                   $fileauthorname1 = mysqli_fetch_assoc($resultauthorname1);
                       $title = $fileauthorname1['title'];
                       $fname= $fileauthorname1['firstname'];
                       $middlename= $fileauthorname1['middlename'];
                       $lastname= $fileauthorname1['lastname'];
                       $authorname23 =  $title.' '.$fname.' '.$middlename.' '.$lastname;
                    echo $cnt1 .'.'.$authorname23.'<br>';
                    $cnt1 = $cnt1 + 1;
                 }
          //   Academic Editor Section Ends Here 

      // Reviewer Showing Section Ends Here
  }
  else if ($rejected==1) {
    echo "<p class='text-danger'><b>Reject on:<br></b> ".$rejectdate.'</p>';
  }
  else  { 
      
     echo "<b><span class='text-warning'>Under Review</span> <br>Reviewer:</b>".'<br>';
      if(empty($primaryemailarray)) {
          echo "Not Selected Yet<br>"; 
      }
      else {
          $cnt = 1;
    //  Reviewer Showing Section Starts Here 
    foreach ($primaryemailarray as $es) {
        $sqlauthorname = "SELECT * FROM author WHERE  primaryemail= '$es' ";
        $resultauthorname = mysqli_query($link,$sqlauthorname); 
        $fileauthorname = mysqli_fetch_assoc($resultauthorname);
        
            $title = $fileauthorname['title'];
            $fname= $fileauthorname['firstname'];
            $middlename= $fileauthorname['middlename'];
            $lastname= $fileauthorname['lastname'];
        
            $authorname =  $title.' '.$fname.' '.$middlename.' '.$lastname;

         echo $cnt.'.'.$authorname.'<br>';
         $cnt = $cnt + 1;
    }
  }
        //  Reviewer Showing Section Ends Here 

              //    // Associate Editor showing section
                 echo "<b><span class='text-info'>Associate Editor:</span></b>".'<br>';
                 $cnt1 =1; 
                 foreach ($primaryemailarrayassociateeditor as $err) {
                   $sqlauthorname1 = "SELECT * FROM author WHERE  primaryemail= '$err' ";
                   $resultauthorname1 = mysqli_query($link,$sqlauthorname1); 
                   $fileauthorname1 = mysqli_fetch_assoc($resultauthorname1);
                       $title = $fileauthorname1['title'];
                       $fname= $fileauthorname1['firstname'];
                       $middlename= $fileauthorname1['middlename'];
                       $lastname= $fileauthorname1['lastname'];
                       $authorname23 =  $title.' '.$fname.' '.$middlename.' '.$lastname;
                    echo $cnt1 .'.'.$authorname23.'<br>';
                    $cnt1 = $cnt1 + 1;
                 }
              //  //   Associate Editor Section Ends Here 
       
              //           // Academic  Editor showing section
                        echo "<b><span class='text-info'>Academic Editor:</span></b>".'<br>';
                        $cnt1 =1; 
                        foreach ($primaryemailarrayacademiceditor as $err) {
                          $sqlauthorname1 = "SELECT * FROM author WHERE  primaryemail= '$err' ";
                          $resultauthorname1 = mysqli_query($link,$sqlauthorname1); 
                          $fileauthorname1 = mysqli_fetch_assoc($resultauthorname1);
                              $title = $fileauthorname1['title'];
                              $fname= $fileauthorname1['firstname'];
                              $middlename= $fileauthorname1['middlename'];
                              $lastname= $fileauthorname1['lastname'];
                              $authorname23 =  $title.' '.$fname.' '.$middlename.' '.$lastname;
                           echo $cnt1 .'.'.$authorname23.'<br>';
                           $cnt1 = $cnt1 + 1;
                        }
              //    //   Academic Editor Section Ends Here 


    //   Reviewing paper selection section ends here 
  }



  ?>
                                    <!-- Paper status section starts here  -->
                                </small>
                            </td>
                            <!-- Paper Status -->

                            <td class="text-dark">
                                <?php  echo htmlentities($result->paperid); ?>
                            </td>
                            <td>
                                <b>
                                    <small>
                                        <!-- Author Name Showing Section starts here  -->
                                        <?php  
$authoremail = htmlentities($result->authoremail);
include '../link/selectauthorname.php';
echo $authorname;
?>
                                        <!-- Author Name Showing Section Ends Here  -->
                                    </small>
                                </b>
                            </td>

                            <td>
                                <a
                                    href="selection.php?id=<?php echo htmlentities($result->paperid);?>"><?php  echo wordwrap(htmlentities($result->papername),70,"<br>\n"); ?></a>
                            </td>
                            <td class="text-dark">
                                <small>
                                    <b>Uploaded On :</b><br>
                                    <?php
  // Selecting Date section starts here 
  $uploaddatestring = htmlentities($result->uploaddate);
  $uploaddate = date("d-M-Y",strtotime($uploaddatestring)); 
  echo $uploaddate.'<br>';
  // Selecting Date section ends here 

  $resubmitpaper = htmlentities($result->resubmitpaper);
 $resubmitdatestring = htmlentities($result->resubmitdate);
 $resubmitdate= date("d-M-Y",strtotime($resubmitdatestring));
 if(!empty($resubmitpaper)){
   echo '<b class="text-info">Resubmit on :</b><br>';
  echo  $resubmitdate;
 }

?>
                                </small>
                            </td>

                        </tr>
                        <?php }} }?>

                    </tbody>

                </table>


            </div>


            <div class="mb-5"></div>
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
  echo "<script>alert('You are not a academiceditor.Try to log in as an academiceditor');</script>";
  header("refresh:0;url=../login");
}


}
     
?>