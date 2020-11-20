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

     $sql = "SELECT admin.id,admin.user_name,admin.full_name,admin.password,admin.email,admin.contact from admin where email='$adminemail'"; 
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
    <title>Document</title>
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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

                                <div style="margin-top:20px;float:right;width:50%;margin-bottom:20px;">
                                <input id="myInput-admin" class="form-control" type="text" placeholder="Search..">
                            </div>
<table class="table table-striped table-responsive{-sm|-md|-lg|-xl}"  cellspacing="0" width="100%">

<thead>
        <tr>
            <th  scope="col">#</th>
            <th >id</th>
            <th >Author Name</th>
            <th >Author Email</th>
            <th >Author Contact</th>
            <th >Author Address</th>
            <th >Actions</th>
        </tr>
</thead>
</table>
<table id="myTable-admin" class="table table-striped  table-hover table-responsive{-sm|-md|-lg|-xl}"  cellspacing="0" width="100%">


 
<tbody>
<?php $sql = "SELECT author.id,author.name,author.email,author.contact,author.address  from author";
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
            <td ><?php echo htmlentities($result->name);?></td>
            <td ><?php echo htmlentities($result->email);?></td>
            <td ><?php echo htmlentities($result->contact);?></td>
            <td ><?php echo htmlentities($result->address);?></td>

<td >
<a href="edit_author.php?stid=<?php echo htmlentities($result->id);?>"><i class="far fa-edit" title="Edit"></i></a>
<a href="delete-author.php?id=<?php echo htmlentities($result->id);?>&name=documents/<?php echo htmlentities($result->name);?>"onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt" title="Delete"></i></a>

</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
       
    
    </tbody>


</table>

                </div>



 

<!-- Authors showing section ends here  -->


</div>

<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
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