<?php 
include('link/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://iubat.edu/admission/vendor/iubat-logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Page not found</title>

    <head>
    </head>

<body>
    <div style="margin-top:100px;" class="container p-5">

        <div style="border:2px solid red;border-radius:10px;">
            <div class="row p-2">
                <div class="col-sm-12 col-lg-6 col-xl-6 col-md-6">
                    <img src="https://iubat.edu/wp-content/themes/eduma/images/image-404.jpg">
                </div>
                <div class="col-sm-12 col-lg-6 col-xl-6 col-md-6">
                    <b>
                        <h1 style="font-size:50px;font-weight:700">404 <span style="color:red;">ERROR!</span></h1>
                    </b>
                    <p>Sorry, we can't find the page you are looking for. Please go to back<button onclick="goBack()" class="btn btn-info btn-sm">Go back</button></p>
                    <script>
                    function goBack() {
                    window.history.back(); 
                    }
                    </script>
                </div>
            </div>

        </div>

    </div>

    <!-- Essential Js,jquery,section starts  -->
</body>

</html>