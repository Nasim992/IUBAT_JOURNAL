<?php include('../mailmessage/url.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <style>
    .sidebars i {
        font-size: 16px !important;
        color: #2ca32f !important;
    }
    </style>  
</head>
<body>
    <a href="<?php echo $url;?>" class="sidebars" title="Main Home page"><i class="fas fa-home"></i>&nbsp Home</a>
    <a href="dashboard" class="sidebars" title="Author Dashboard"><i class="fas fa-tachometer-alt"></i>&nbsp Dashboard</a>
    <a href="uploadpaper" class="sidebars" title="Upload paper here"><i class="fas fa-upload"></i>&nbsp Upload Paper</a>
    <a href="paperstatus" class="sidebars" title="Chech your paper status"><i class="fas fa-exclamation-circle"></i>&nbsp Paper Status</a>
    <a href="updateprofile" class="sidebars" title="Update your profile"><i class="fas fa-sync"></i>&nbsp Update profile</a>
    <a href="changepassword" class="sidebars" title="Change your password"><i class="fas fa-unlock-alt"></i>&nbsp Change password</a>
    <a href="reviewerstatus" class="sidebars" title="See your Reviewed paper"><i class="far fa-newspaper"></i>&nbsp Reviewed paper</a>
    <a href="#"></a>
</body>
</html>