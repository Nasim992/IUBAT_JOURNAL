<?php
include('../mailmessage/url.php');
if(strlen($_SESSION['alogin'])=="") 
    {    
    echo "<script type='text/javascript'> document.location = '../login'; </script>";  
    } else {

      // Check that the admin is logged in or not section starts here 
      $chiefeditoremail = $_SESSION["email"];

       $sql = "SELECT chiefeditor.id,chiefeditor.fullname,chiefeditor.password,chiefeditor.contact FROM chiefeditor WHERE email='$chiefeditoremail'"; 
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1;
      if($query->rowCount() > 0) 
      { 
        foreach($results as $result) {
      // Check that the admin is logged in or not section ends here   
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/heading.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   <style>
     @media screen and (max-width: 990px) { 
      .hidden{
       display: block !important;
     }
      }
     .hidden{
       display: none;
     }
   </style>

</head> 
<body>  
<nav class="navbar nav-class navbar-expand-xl navbar-expand{-sm|-md|-lg|-xl}  navbar-light">
  <a class="navbar-brand" href="dashboard"><img src="../images/Iubat-logo.png">IUBAT Review</a>
  <h6 style="font-size:12px;">Welcome,<?php  echo htmlentities($result->fullname);  } ?></h6>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
 
    <ul class="navbar-nav ml-auto ul-nav">
    <li class="nav-item hidden active" title="Dashboard">
    <span class="navbar-text"><a href="<?php echo $url;?>" class="sidebars" title="Main Home page"><i class="fas fa-home"></i>&nbsp Home</a></span>
    </li>
    <li class="nav-item hidden active" title="Dashboard">
    <span class="navbar-text"><a href="dashboard" class="sidebars nav-link"><i class="fas fa-tachometer-alt"></i>&nbsp Dashboard</a></span>
    </li>

    <li class="nav-item hidden active" title="Published paper">
    <span class="navbar-text"><a href="publishedpaper" class="sidebars nav-link"><i class="far fa-newspaper"></i>&nbsp Published Paper</a></span>
    </li>

    <li class="nav-item hidden active" title="Unpublished paper">
    <span class="navbar-text"><a href="unpublishedpaper" class="sidebars nav-link"><i class="far fa-newspaper"></i>&nbsp Unpublished Paper</a></span>
    </li>
    <li class="nav-item hidden active" title="Changed password">
    <span class="navbar-text"><a href="updateprofile" class="sidebars nav-link"><i class="fas fa-unlock-alt"></i>&nbsp Update Profile</a></span>
    </li>
    <li class="nav-item hidden active" title="Changed password">
    <span class="navbar-text"><a href="changepassword" class="sidebars nav-link"><i class="fas fa-unlock-alt"></i>&nbsp Change password</a></span>
    </li>
    <li class="nav-item hidden active" title="Author states">
    <span class="navbar-text"><a href="admin" class="sidebars nav-link"><i class="fas fa-users-cog"></i>&nbsp Admin States</a></span>
    </li>
    <li class="nav-item hidden active" title="Author states">
    <span class="navbar-text"><a href="authors" class="sidebars nav-link"><i class="fas fa-users-cog"></i>&nbsp Author States</a></span>
    </li>
    <li class="nav-item hidden active" title="reviewer">
    <span class="navbar-text"><a href="reviewerdetails" class="sidebars nav-link"><i class="fas fa-users-cog"></i>&nbsp Reviewer</a></span>
    </li>
    <li class="nav-item hidden active" title="Editor">
    <span class="navbar-text"><a href="selecteditor" class="sidebars nav-link"><i class="fas fa-users-cog"></i>&nbsp Select Editor</a></span>
    </li>
    <li class="nav-item hidden active" title="Editor">
    <span class="navbar-text"><a href="editordetails" class="sidebars nav-link"><i class="fas fa-users-cog"></i>&nbsp Editor</a></span>
    </li>
    <li class="nav-item hidden active" title="Feedback">
    <span class="navbar-text"><a href="rfeedback" class="sidebars nav-link"><i class="fas fa-comments"></i>&nbsp Reviewer Feedback</a></span>
    </li>
    <li class="nav-item hidden active" title="Feedback">
    <span class="navbar-text"><a href="efeedback" class="sidebars nav-link"><i class="fas fa-comments"></i>&nbsp Editor Feedback</a></span>
    </li>
    <li class="nav-item hidden active" title="Feedback">
    <span class="navbar-text"><a href="archive" class="sidebars nav-link"><i class="far fa-newspaper"></i>&nbsp Archive</a></span>
    </li>

        <li class="nav-item active" >
        <span class="navbar-text"> <a class="nav-link" href="logout" onclick="return confirm('Are you sure you want Logging out the system?');" title = "Sign Out"><small>(Sign Out)</small><i class="fas fa-sign-out-alt"></i></a></span>
        </li>

        </ul>
  
  </div>
</nav>
</body>
</html>
    <?php }
    else {
      echo "<script>alert('You are not an Editor.Try to log in as an Editor');</script>";
      echo "<script type='text/javascript'> document.location = '../login'; </script>";
    }
   }?>