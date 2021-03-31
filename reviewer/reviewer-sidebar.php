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
    <a href="dashboard" class="sidebars"> <i class="fas fa-tachometer-alt"></i>&nbsp Dashboard</a>
    <a href="reviewedpaper" class="sidebars"> <i class="far fa-newspaper" class="sidebars"></i>&nbsp Reviewed paper</a>
    <a href="reviewerpaper" class="sidebars"><i class="far fa-newspaper"></i>&nbsp As Reviewer</a>

    <a href="#"></a>

</body>

</html>