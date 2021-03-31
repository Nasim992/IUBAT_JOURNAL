<?php include('../mailmessage/url.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <style>
      .sidebars i{ 
     font-size:16px !important;  
     color:#2ca32f;
      }
    </style> 
</head>
<body> 
<a href="<?php echo $url;?>" class="sidebars" title="Main Home page"><i class="fas fa-home"></i>&nbsp Home</a>
<a href="dashboard" class="sidebars"><i class="fas fa-tachometer-alt"></i>&nbsp Dashboard</a>
<a href="publishedpaper" class="sidebars"><i class="far fa-newspaper"></i>&nbsp Published Paper</a>
  <a href="unpublishedpaper" class="sidebars"><i class="far fa-newspaper"></i>&nbsp Unpublished Paper</a>
  <a href="updateprofile" class="sidebars"><i class="fas fa-user-shield"></i>&nbsp Update Profile</a>
  <a href="changepassword" class="sidebars"><i class="fas fa-unlock-alt"></i>&nbsp Change password</a>
  <a href="admin" class="sidebars"><i class="fas fa-users-cog"></i>&nbsp Admin Pannel</a>
  <a href="authors" class="sidebars"><i class="fas fa-users-cog"></i>&nbsp Author States</a>
  <a href="reviewerdetails" class="sidebars"><i class="fas fa-users-cog"></i>&nbsp Reviewer</a>
  <a href="selecteditor" class="sidebars"><i class="fas fa-users-cog"></i>&nbsp Select Editor</a>
  <a href="editordetails" class="sidebars"><i class="fas fa-users-cog"></i>&nbsp Editor</a>
  <a href="rfeedback" class="sidebars"><i class="fas fa-comments"></i>&nbsp Reviewer Feedback</a>
  <a href="efeedback" class="sidebars"><i class="fas fa-comments"></i>&nbsp Editor Feedback</a>
  <a href="archive" class="sidebars"><i class="far fa-newspaper"></i>&nbsp Archive</a>
  <a href="#" class="sidebars"></a>
    
</body>
</html>