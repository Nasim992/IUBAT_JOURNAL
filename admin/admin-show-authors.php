<?php
session_start();
error_reporting(0);
include('../link/config.php'); 

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: ../adminlogin"); 
    }
    else  
    { 

     // Check that the admin is logged in or not section starts here 
     $adminemail = $_SESSION["email"];

     $sql = "SELECT admin.id,admin.username,admin.fullname,admin.password,admin.email,admin.contact from admin where email='$adminemail'"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
     
     // Check that the admin is logged in or not section ends here 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Authors</title>
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script>
   <link rel="stylesheet" href="css/admin-dashboard.css"> -->


</head>
<body>


<!-- Author showing header sections starts  --> 
<div class="sticky-top header-floating">
<?php
include 'admin-header.php';
?> 
</div> 
<!-- Author showing header sections ends   -->


<div id="mySidebar" class="sidebar mt-3">
  <?php
  include 'admin-sidebar.php';
  ?>

</div> 

<div id="main">   

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

  <h4>AUTHOR</h4>
  <hr class="bg-secondary" >
  <div class="table-responsive p-4"> 

<table  id="dtBasicExample" class="table table-striped table-bordered table-hover"  cellspacing="0">

<thead>
        <tr>
            <th >#</th>
            <th >id</th>
            <th >UserName</th>
            <th >Title</th>
            <th >First Name</th>
            <th >Middle Name</th>
            <th >Last Name</th>
            <th >Primary Email</th>
            <th >Primary Email cc</th>
            <th >Secondary Email</th>
            <th >Secondary Email cc</th>
            <th >Contact</th>
            <th >Address</th>
            <th >Registration Time</th>
            <th >Reviewer Selection</th>
            <th >Editor Selection</th>
            <th >Action</th>
        </tr>
</thead>

<tbody id="myTable-admin">
<?php $sql = "SELECT author.id,author.username,author.title,author.firstname,author.middlename,author.lastname,author.primaryemail,author.primaryemailcc,author.secondaryemail,author.secondaryemailcc,author.contact,author.address,author.registrationtime,author.reviewerselection,author.editorselection from author";
$query = $dbh->prepare($sql); 
$query->execute(); 
$results=$query->fetchAll(PDO::FETCH_OBJ);  
$cnt=1;
if($query->rowCount() > 0) 
{
foreach($results as $result) 
{   ?>
<tr>
<td><?php echo htmlentities($cnt);?></td><td class="result-color1"><?php echo htmlentities($result->id);?></td> 
            <td ><?php echo htmlentities($result->username);?></td>
            <td ><?php echo htmlentities($result->title);?></td>
            <td ><?php echo htmlentities($result->firstname);?></td>
            <td ><?php echo htmlentities($result->middlename);?></td>
            <td ><?php echo htmlentities($result->lastname);?></td> 
            <td ><?php echo htmlentities($result->primaryemail);?></td>
            <td ><?php echo htmlentities($result->primaryemailcc);?></td>
            <td ><?php echo htmlentities($result->secondaryemail);?></td>
            <td ><?php echo htmlentities($result->secondaryemailcc);?></td>
            <td ><?php echo htmlentities($result->contact);?></td>
            <td ><?php echo htmlentities($result->address);?></td>
            <td ><?php echo htmlentities($result->registrationtime);?></td>
            <td ><?php echo htmlentities($result->reviewerselection);?></td>
            <td ><?php echo htmlentities($result->editorselection);?></td>

<td>
<!-- <a href="edit_author.php?stid=<?php echo htmlentities($result->id);?>"><i class="far fa-edit" title="Edit"></i></a> -->
<a class="text-danger" href="delete-author.php?id=<?php echo htmlentities($result->id);?>"onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt" title="Delete"></i></a>

</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
       
    
    </tbody>


</table>
</div>

<div class="mb-5"></div>
</div>
</div>

 

<!-- Authors showing section ends here  -->


</div>

<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });

            // DataTables section starts here 
            $(document).ready(function () {
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
  echo "<script>alert('You are not an Admin.Try to log in as an Admin');</script>";
  header("refresh:0;url=../adminlogin");
}

}

?>