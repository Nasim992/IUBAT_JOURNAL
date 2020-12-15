<?php
session_start();
error_reporting(0);
include('link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: login.php"); 
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
    <title>Total Admin</title>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    
    <link rel="stylesheet" href="css/fontawesome.v5.3.1.all.css">
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
   <link rel="stylesheet" href="css/admin-dashboard.css">

</head>
<body>
<div class="container">

<div class="sticky-top">
<!-- Author showing header sections starts  -->

<?php
include 'admin-header.php';
?>

<!-- Author showing header sections ends   -->
</div>

<div class="table-responsive p-4"> 
<table id="dtBasicExample" class="table"  cellspacing="0">

<thead>
        <tr>
            <th >#</th>
            <th >id</th>
            <th >Admin Name</th>
            <th >Full Name</th>
            <th >Email</th>
            <th >Contact Address</th>
            <th >Actions</th>
        </tr>
</thead>

<tbody id="myTable-admin">
<?php $sql = "SELECT admin.id,admin.username,admin.fullname,admin.email,admin.contact  from admin";
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
            <td ><?php echo htmlentities($result->fullname);?></td>
            <td ><?php echo htmlentities($result->email);?></td>
            <td ><?php echo htmlentities($result->contact);?></td>

<td>
<a href="edit_admin.php?stid=<?php echo htmlentities($result->id);?>"><i class="far fa-edit" title="Edit"></i></a>
<a class="text-danger" href="delete-admin.php?id=<?php echo htmlentities($result->id);?>"onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt" title="Delete"></i></a>

</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
       
    
    </tbody>


</table>
</div>

                </div>



 

<!-- Authors showing section ends here  -->


</div>

<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
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

            $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
            });
            </script>

<!-- Essential Js,Jquery  section ends  -->





</body>
</html>



<?php 

}
else {
  echo "<script>alert('You are not an Admin.Try to log in as an Admin');</script>";
  header("refresh:0;url=login.php");
}

}
    
    

?>