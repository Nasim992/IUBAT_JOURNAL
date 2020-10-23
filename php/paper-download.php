<?php 

$link = mysqli_connect("localhost", "root", "", "iubat");


 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$id=intval($_GET['id']);

$sql = "SELECT * FROM paper WHERE id = '$id' ";

$result = mysqli_query($link,$sql);

$file = mysqli_fetch_assoc($result);

$filepath = '../documents/'.$file['name'];

echo $filepath;

// if(file_exists($filepath)) {
//     header("Content-type:application/pdf");
//     header ('Content-Description:File Transfer');
//     header ('Content-Disposition:attachment;filename='.basename($filepath));
//     header('Expires : 0');
//     header('Cache-Control : must-revalidate');
//     header('Pragma : public'); 
//     header('Content-Length:'.filesize('../documents/'.file['name']));
//     readfile('../documents/'.$file['name']);
//     exit;

// }

?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href ="<?php echo $filepath ?>">Downloads</a>
</body>
</html> -->